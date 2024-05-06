<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $request->validate([
            'duration' => 'required|numeric|min:1|max:500',
            'price' => 'required|numeric|min:0|max:10000',
        ]);

        $user = User::find(Auth::id());
        $user->services()->updateExistingPivot($service, ['duration' => $request->duration, 'price' => $request->price]
        );

        return redirect()->route('services.index')->with(
            [
                'message' => 'Service was updated successfully',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $user = User::find(Auth::id());
        $user->services()->detach($service);

        return redirect()->route('services.index')->with(
            [
                'message' => 'Service was delete successfully',
            ]
        );
    }
}
