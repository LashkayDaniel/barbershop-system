<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Employee/Schedule/Index');
    }

    /**
     * Get orders by date.
     */
    public function getOrdersByDate(string $date)
    {
        $reservations = Order::query()
            ->with(['service', 'client', 'worktime', 'discount'])
            ->where('user_id', 21)
            ->get()
            ->filter(function ($order) use ($date) {
                return $order->worktime()->whereDate('date', $date)->exists();
            })
            ->values()
            ->map(function ($order) {
                $duration = $order->service->duration = DB::table('service_user')
                    ->where('user_id', $order->user_id)
                    ->where('service_id', $order->service_id)
                    ->value('duration');
                $order->start_time = Carbon::parse($order->worktime->time)->format('H:i');
                $order->end_time = Carbon::parse($order->worktime->time)->addMinutes($duration)->format('H:i');
                return $order;
            });

        return response()->json($reservations);
    }
}
