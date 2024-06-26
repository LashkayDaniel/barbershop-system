<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorktimeResource;
use App\Models\PageData;
use App\Models\Response;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $pageData = PageData::query()->first();
        $services = DB::table('service_user as su')
            ->join('services as s', 's.id', '=', 'su.service_id')
            ->select(
                's.name',
                's.description',
                DB::raw('ROUND(AVG(su.duration)) as avg_duration'),
                DB::raw('MIN(su.price) as min_price'),
            )
            ->where('s.is_available', true)
            ->groupBy('su.service_id')
            ->get()
            ->map(function ($service) {
                $foundedService = Service::query()->where('name', $service->name)->first();
                $discount = $foundedService?->discount;
                if ($discount) {
                    $discountPercent = $discount?->percent;
                    $price = $service->min_price;
                    $discountWeight = $price * ($discountPercent / 100);
                    $service->min_price = round($price - $discountWeight);
                    $service->discount = $discountPercent;
                    $service->discount_last_day = $discount->end;
                }
                return $service;
            });

        $employeesData = User::query()
            ->where('role_id', Role::IS_EMPLOYEE)
            ->with([
                'responses' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
                'portfolio',
                'availableWorktimes',
            ])
            ->get(['id', 'name', 'email', 'birth', 'phone', 'rank', 'description', 'avatar'])
            ->map(function ($user) {
                $rating = round(Response::query()->where('user_id', $user->id)->avg('rating'), 1);
                $user['rating'] = number_format($rating, 1, '.', '');
                $user['avatar'] = $user->avatar ? Storage::url($user->avatar) : null;

                $user['services'] = $user->servicesWithDiscount()
                    ->get()
                    ->map(function ($service) {
                        $price = $service->pivot->price;
                        $resultingFields = [
                            'id' => $service->id,
                            'name' => $service->name,
                            'price' => $price,
                            'duration' => $service->pivot->duration,
                        ];

                        $discount = $service->discount?->percent;
                        if ($discount) {
                            $resultingFields['discount'] = $discount;
                            $resultingFields['discount_price'] = round($price * (1 - $discount / 100));
                        }
                        return $resultingFields;
                    });
                return $user;
            });

        return Inertia::render('Home', [
            'pageData' => $pageData,
            'services' => $services,
            'employees' => $employeesData,
        ]);
    }
}
