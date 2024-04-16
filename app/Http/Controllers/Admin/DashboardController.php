<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $income = Order::query()
            ->selectRaw(
                'YEAR(orders.created_at) as year, MONTHNAME(orders.created_at) as month, COUNT(*) as orders, SUM(service_user.price) as income'
            )
            ->join('service_user', function ($join) {
                $join->on('orders.user_id', '=', 'service_user.user_id')
                    ->on('orders.service_id', '=', 'service_user.service_id');
            })
            ->groupBy('month', 'year')
            ->get();

        $totalIncome = $income->sum('income');

        return Inertia::render(
            'Admin/Dashboard/Index',
            [
                'statistics' => [
                    'totalIncome' => $totalIncome,
                    'income' => $income,
                ],
            ]
        );
    }

}
