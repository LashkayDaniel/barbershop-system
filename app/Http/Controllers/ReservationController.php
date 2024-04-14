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
        $order->discount = 0;
        $order->save();

        $worktime->is_free = 0;
        $worktime->update();

        $master = User::find($request->master_id);
        $masterService = $master->services()->where('service_id', $service->id)->first();
        Carbon::setLocale('uk_UA');

        $data = [
            'receiver' => $customer->email,
            'service' => $service->name,
            'master' => $master->name,
            'datetime' => Carbon::parse($worktime->date)->translatedFormat('l, j F') . ' о ' .
                substr($worktime->time, 0, 5),
            'duration' => $masterService->pivot->duration,
            'cost' => $masterService->pivot->price,
        ];

        dispatch(new SendReservationEmailJob($data));

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Послугу успішно заброньовано!',
        ]);
    }
}