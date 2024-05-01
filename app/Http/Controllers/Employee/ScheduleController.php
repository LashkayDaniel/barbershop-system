<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Employee/Schedule/Index', [
            'user' => Auth::user(),
        ]);
    }

    public function getOrdersByDate(string $date)
    {
//        $request->validate([
//            'date' => 'required|date_format:Y-m-d',
//        ]);

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
