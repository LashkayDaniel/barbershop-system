<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::query()
            ->where('role_id', Role::IS_EMPLOYEE)
            ->paginate(5)
            ->through(function ($employee) {
                $employee->avatar = $employee->avatar ? Storage::url($employee->avatar) : null;
                return $employee;
            });

        return Inertia::render('Admin/Staff/Index', ['employees' => $employees]);
    }

}
