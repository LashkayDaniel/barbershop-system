<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeId = Auth::id();
        $allEmployeeOrdersCount = User::query()->find($employeeId)->orders()->count();
        $popularServicesData = Order::with('service')
            ->select('service_id', DB::raw('count(*) as total_orders'))
            ->where('user_id', $employeeId)
            ->groupBy('service_id')
            ->get();

        $popularServices = $popularServicesData->map(function ($item) use ($allEmployeeOrdersCount) {
            return [
                'name' => $item->service->name,
                'percent' => round(($item->total_orders / $allEmployeeOrdersCount) * 100),
            ];
        });

        $employeesData = Order::query()
            ->where('orders.user_id', $employeeId)
            ->selectRaw(
                'COUNT(*) as orders, SUM(service_user.price * (1-IFNULL(discounts.percent,0)/100)) as profit'
            )
            ->join('service_user', function ($join) {
                $join->on('orders.user_id', '=', 'service_user.user_id')
                    ->on('orders.service_id', '=', 'service_user.service_id');
            })
            ->leftJoin('discounts', 'discounts.id', '=', 'orders.discount_id')
            ->orderByDesc('profit')
            ->get();

        return Inertia::render(
            'Employee/Dashboard/Index',
            [
                'statistics' => [
                    'popular_services' => $popularServices,
                    'employee_data' => [
                        'orders' => $employeesData->value('orders'),
                        'profit' => number_format($employeesData->value('profit')),
                    ],
                ],
            ]
        );
    }

}
