<?php

namespace App\Http\Controllers;

use App\Jobs\SendReservationEmailJob;
use App\Models\Client;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'master_id' => 'required|numeric',
            'service' => 'required|min:3',
            'worktime_id' => 'required|numeric',
            'name' => 'required|min:3|max:20',
            'email' => 'required|email|min:3|max:40',
            'phone' => 'required|size:14',
        ]);

        $customer = Client::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        $service = Service::query()->where('name', $request->service)->first();
        $worktime = Worktime::query()->find($request->worktime_id);

        $order = new Order();
        $order->user_id = $request->master_id;
        $order->service_id = $service->id;
        $order->client_id = $customer->id;
        $order->worktime_id = $worktime->id;
        $order->status = 'created';

        $discount = $service->discount;
        if ($discount) {
            $order->discount_id = $discount->id;
        }

        $order->save();

        $worktime->is_free = 0;
        $worktime->update();

        $master = User::find($request->master_id);
        $masterService = $master->services()->where('service_id', $service->id)->first();

        $data = [
            'receiver' => $customer->email,
            'service' => $service->name,
            'master' => $master->name,
            'datetime' => Carbon::parse($worktime->date)->translatedFormat('l, j F') . ' о ' .
                substr($worktime->time, 0, 5),
            'duration' => $masterService->pivot->duration,
            'cost' => $masterService->pivot->price,
        ];
        if ($discount) {
            $data['discount'] = $discount->percent;
            $price = $data['cost'];
            $data['cost'] = round($price * (1 - $discount->percent / 100));
        }
        dispatch(new SendReservationEmailJob($data));

        $startTime = Carbon::createFromTimeString($worktime->time);
        $endTime = $startTime->copy()->addMinutes($masterService->pivot->duration)->toTimeString();

        Worktime::query()
            ->whereDate('date', $worktime->date)
            ->whereTime('time', '>', $startTime->format('H:i:s'))
            ->whereTime('time', '<', $endTime)
            ->get()
            ->map(function ($time) {
                $time->is_free = 0;
                $time->save();
            });

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Послугу успішно заброньовано!',
        ]);
    }
}
