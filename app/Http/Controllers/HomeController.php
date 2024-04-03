<?php

namespace App\Http\Controllers;

use App\Models\PageData;
use App\Models\Response;
use App\Models\Role;
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
                DB::raw('MIN(su.price) as min_price')
            )
            ->where('s.is_available', true)
            ->groupBy('su.service_id')
            ->get();

        $employeesData = User::query()
            ->where('role_id', Role::IS_EMPLOYEE)
            ->with([
                'services' => function ($query) {
                    $query->select(['id', 'name', 'price', 'duration'])->where('is_available', true);
                },
                'responses' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
                'portfolio',
            ])
            ->get(['id', 'name', 'email', 'birth', 'phone', 'rank', 'description', 'avatar'])
            ->map(function ($user) {
                $rating = round(Response::query()->where('user_id', $user->id)->avg('rating'), 1);
                $user['rating'] = number_format($rating, 1, '.', '');
                $user['avatar'] = $user->avatar ? Storage::url($user->avatar) : null;
                $user->services->makeHidden('pivot');
                return $user;
            });

        return Inertia::render('Home', [
            'pageData' => $pageData,
            'services' => $services,
            'employees' => $employeesData,
        ]);
    }
}
