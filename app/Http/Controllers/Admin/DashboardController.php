<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $incomeByYearsMonths = Order::query()
            ->selectRaw(
                'YEAR(orders.created_at) as year, MONTHNAME(orders.created_at) as month, COUNT(*) as orders, SUM(service_user.price * (1-IFNULL(discounts.percent,0)/100)) as income'
            )
            ->join('service_user', function ($join) {
                $join->on('orders.user_id', '=', 'service_user.user_id')
                    ->on('orders.service_id', '=', 'service_user.service_id');
            })
            ->leftJoin('discounts', 'discounts.id', '=', 'orders.discount_id')
            ->groupBy('month', 'year')
            ->get();

        $totalIncome = number_format(round($incomeByYearsMonths->sum('income')));

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;
        $incomeByPrevMonth = $this->calcIncomeByMonth($currentYear, $currentMonth - 1);
        $incomeByCurrentMonth = $this->calcIncomeByMonth($currentYear, $currentMonth);
        $incomePercentDiff = $this->calcPercentDiff($incomeByCurrentMonth, $incomeByPrevMonth);

        $totalOrders = Order::all()->count();
        $ordersByPrevMonth = $this->calcCountByMonth(Order::class, $currentYear, $currentMonth - 1);
        $ordersByCurrentMonth = $this->calcCountByMonth(Order::class, $currentYear, $currentMonth);
        $ordersPercentDiff = $this->calcPercentDiff($ordersByCurrentMonth, $ordersByPrevMonth);

        $totalCustomers = Client::all()->count();
        $customersByPrevMonth = $this->calcCountByMonth(Client::class, $currentYear, $currentMonth - 1);
        $customersByCurrentMonth = $this->calcCountByMonth(Client::class, $currentYear, $currentMonth);
        $customersPercentDiff = $this->calcPercentDiff($customersByCurrentMonth, $customersByPrevMonth);

        $positiveReviews = Response::query()->where('rating', 5)->count();
        $reviewsByPrevMonth = $this->calcReviewsByMonth($currentYear, $currentMonth - 1);
        $reviewsByCurrentMonth = $this->calcReviewsByMonth($currentYear, $currentMonth);
        $reviewsPercentDiff = $this->calcPercentDiff($reviewsByCurrentMonth, $reviewsByPrevMonth);

        $popularServicesData = Order::with('service')
            ->select('service_id', DB::raw('count(*) as total_orders'))
            ->groupBy('service_id')
            ->get();

        $popularServices = $popularServicesData->map(function ($item) use ($totalOrders) {
            return [
                'name' => $item->service->name,
                'percent' => round(($item->total_orders / $totalOrders) * 100, 1),
            ];
        });

        $employeesStatistic = Order::query()
            ->selectRaw(
                'users.name as employee, COUNT(*) as orders, SUM(service_user.price * (1-IFNULL(discounts.percent,0)/100)) as income'
            )
            ->join('service_user', function ($join) {
                $join->on('orders.user_id', '=', 'service_user.user_id')
                    ->on('orders.service_id', '=', 'service_user.service_id');
            })
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('discounts', 'discounts.id', '=', 'orders.discount_id')
            ->groupBy('employee')
            ->orderByDesc('income')
            ->get();

        return Inertia::render(
            'Admin/Dashboard/Index',
            [
                'statistics' => [
                    'income' => [
                        'total' => $totalIncome,
                        'income' => $incomeByYearsMonths,
                        'last_month' => $incomePercentDiff,
                    ],
                    'reservation' => [
                        'total' => number_format($totalOrders),
                        'last_week' => $ordersPercentDiff,
                    ],
                    'customers' => [
                        'total' => number_format($totalCustomers),
                        'last_week' => $customersPercentDiff,
                    ],
                    'reviews' => [
                        'total' => number_format($positiveReviews),
                        'last_week' => $reviewsPercentDiff,
                    ],
                    'popular_services' => $popularServices,
                    'employees_data' => $employeesStatistic,
                ],
            ]
        );
    }

    private function calcIncomeByMonth(int $year, int $month): int
    {
        return round(
            Order::query()
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get()
                ->map(function ($order) {
                    $discount = $order?->discount;
                    $price = DB::table('service_user')->where('user_id', $order->user_id)
                        ->where('service_id', $order->service_id)->value('price');
                    $order->price = $price;
                    if ($discount) {
                        $order->price = $price * (1 - $discount->percent / 100);
                    }
                    return $order;
                })
                ->sum('price')
        );
    }

    private function calcPercentDiff(float $num1, float $num2): float
    {
        $incomeDiff = $num1 - $num2;
        return round(($incomeDiff / max($num1, $num2)) * 100, 2);
    }

    private function calcCountByMonth($model, int $year, int $month): int
    {
        return $model::query()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
    }

    private function calcReviewsByMonth(int $year, int $month): int
    {
        return Response::query()
            ->where('rating', 5)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();
    }
}

