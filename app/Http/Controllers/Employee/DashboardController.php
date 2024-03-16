<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'Employee/Dashboard/Index',
        );
    }

}
