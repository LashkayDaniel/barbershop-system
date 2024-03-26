<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $allServices = Service::query()->orderBy('created_at', 'desc')->get();
        return Inertia::render(
            'Admin/Service/Index',
            [
                'allServices' => $allServices,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10|max:80',
        ]);

        $existingService = Service::where('name', $data['name'])->first();
        if ($existingService) {
            return redirect()->back()->withInput()->withErrors(['name' => 'Service with this name already exists.']);
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with(
            [
                'message' => 'Service was created successfully',
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10|max:80',
        ]);

        $service->update($data);

        return redirect()->route('admin.services.index')->with(
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
        $service->delete();

        return redirect()->route('admin.services.index')->with(
            [
                'message' => 'Service was deleted successfully',
            ]
        );
    }

    public function changeAvailable(Service $service): RedirectResponse
    {
        $service->is_available = !$service->is_available;
        $service->save();

        return redirect()->route('admin.services.index');
    }
}
