<?php

namespace App\Http\Controllers;

use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WorktimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worktimes = Worktime::where('user_id', Auth::id())
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->get(['id', 'date', 'time', 'is_free']);
        return Inertia::render('Employee/Worktime/Index', ['worktimes' => $worktimes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|after_or_equal:' . Carbon::now()->toDateString(),
            'time' => 'required',
        ]);

        $timeFormat = $request->time . ':00';

        if ($request->date == Carbon::now()->toDateString()) {
            if ($timeFormat < Carbon::now()->setTimezone(
                    'Europe/Kiev'
                )->format('H:i' . ':00')) {
                return redirect()->route('worktime.index')->with(
                    [
                        'message' => 'Time must be in future',
                        'type' => 'error',
                    ]
                );
            }
        }

        $existingWorktime = Worktime::where('user_id', $request->user_id)
            ->where('date', $request->date)
            ->where('time', $timeFormat)
            ->exists();

        if ($existingWorktime) {
            return redirect()->route('worktime.index')->with(
                [
                    'message' => 'This time already exist in selected date.',
                    'type' => 'error',
                ]
            );
        }

        $worktime = new Worktime();
        $worktime->user_id = $request->user_id;
        $worktime->date = $request->date;
        $worktime->time = $timeFormat;
        $worktime->is_free = 1;
        $worktime->save();

        return redirect()->route('worktime.index')->with(
            [
                'message' => 'Time successfully added!',
                'type' => 'success',
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Worktime $worktime)
    {
        $worktime->is_free = !$worktime->is_free;
        $worktime->save();
        return redirect()->route('worktime.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worktime $worktime)
    {
        $worktime->delete();
        return redirect()->route('worktime.index')->with(
            [
                'message' => 'Time was deleted successfully!',
                'type' => 'success',
            ]
        );
    }
}
