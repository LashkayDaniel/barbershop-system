<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCustomers = Client::with('orders')->paginate(5)
            ->through(function ($customer) {
                $customer->orders
                    ->map(function ($order) {
                        $order->service->price = DB::table('service_user')
                            ->where('user_id', $order->user_id)
                            ->where('service_id', $order->service_id)
                            ->value('price');
                        return $order;
                    });

                $customer->reservations_count = count($customer->orders);
                $customer->profit = round(
                    $customer->orders->sum(function ($order) {
                        $discount = $order?->discount?->percent;
                        if ($discount) {
                            $price = $order->service->price;
                            return $price * (1 - $discount / 100);
                        }
                        return $order->service->price;
                    })
                );

                return $customer;
            });
        return Inertia::render('Admin/Billing/Index', ['allCustomers' => $allCustomers]);
    }
}
