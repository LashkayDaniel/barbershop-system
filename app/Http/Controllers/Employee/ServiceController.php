<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $employeeServices = User::query()->find($userId)->services()->get();
        $allServices = Service::query()->where('is_available', true)->get();
        return Inertia::render(
            'Service/Index',
            [
                'allServices' => $allServices,
                'employeeServices' => $employeeServices,
            ]
        );
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
        $request->validate([
            'service_id' => 'required|numeric',
            'duration' => 'required|numeric|min:0|max:1000',
            'price' => 'required|numeric|min:0|max:10000',
        ]);

        $user = User::find(Auth::id());
        $serviceId = $request->service_id;

        if ($user->services->contains($serviceId)) {
            return redirect()->back()->withInput()->withErrors(
                ['service_id' => 'Service with this name already exists.']
            );
        }

        $user->services()->attach($serviceId, ['duration' => $request->duration, 'price' => $request->price]);

        return redirect()->route('services.index')->with(
            [
                'message' => 'Service was added successfully',
            ]
        );
    }

    public function storeForStaff(Request $request)
    {
        $request->validate([
            'service_id' => 'required|numeric',
            'price' => 'required|numeric|min:0',
        ]);

        $staff = User::find(Auth::id());
        $serviceId = $request->service_id;

        if ($staff->services->contains($serviceId)) {
            return redirect()->route('services.index')->with(
                [
                    'type' => 'error',
                    'message' => 'This service is already associated with the staff.',
                ]
            );
        }

        $staff->services()->attach($serviceId, ['price' => $request->price]);

        return redirect()->route('services.index')->with(
            [
                'message' => 'Service was create successfully',
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $staff = User::find(Auth::id());
        $staff->services()->updateExistingPivot($service, ['price' => $request->price]);

        return redirect()->route('services.index')->with(
            [
                'message' => 'Service was update successfully',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $staff = User::find(Auth::id());
        $staff->services()->detach($service);

        return redirect()->route('services.index')->with(
            [
                'message' => 'Service was delete successfully',
            ]
        );
    }
}
