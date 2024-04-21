<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $allServices = Service::query()
            ->with('discount')
            ->orderBy('created_at', 'desc')
            ->get();

        $allDiscounts = Discount::with('service')->orderByDesc('start')->get();

        return Inertia::render(
            'Admin/Discount/Index',
            [
                'allServices' => $allServices,
                'allDiscounts' => $allDiscounts,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|numeric',
            'discount' => 'required|numeric|min:0|max:100',
            'date_start' => 'required|date_format:Y-m-d',
            'date_end' => 'required|date_format:Y-m-d',
        ]);

        $startDate = $request->date_start;
        $endDate = $request->date_end;

        $existingDiscounts = Discount::where('service_id', $request->service_id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start', [$startDate, $endDate])
                    ->orWhereBetween('end', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('start', '<', $startDate)
                            ->where('end', '>', $endDate);
                    });
            })
            ->exists();

        if ($existingDiscounts) {
            return redirect()->back()->withInput()->withErrors(
                ['date_start' => 'В указаний період вже існує знижка на послугу']
            );
        }
        $discount = new Discount();
        $discount->service_id = $request->service_id;
        $discount->percent = $request->discount;
        $discount->start = $startDate;
        $discount->end = $endDate;
        $discount->save();

        return redirect()->route('discount.index')->with(
            [
                'message' => 'Знижку успішно додано!',
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount): RedirectResponse
    {
        $discount->delete();

        return redirect()->route('discount.index')->with(
            [
                'message' => 'Знижку успішно видалено!',
            ]
        );
    }
}
