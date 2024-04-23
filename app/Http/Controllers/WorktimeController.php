<?php

namespace App\Http\Controllers;

use App\Models\Worktime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            ->get(['id', 'date', 'time', 'is_free'])
            ->map(function ($worktime) {
                $worktime->reserved = $worktime->isReserved();
                return $worktime;
            });
        return Inertia::render('Employee/Worktime/Index', ['worktimes' => $worktimes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'date' => 'required|after_or_equal:' . Carbon::now()->toDateString(),
            'time' => 'required',
        ]);

        $timeFormat = $request->time . ':00';

        if ($request->date == Carbon::now()->toDateString()) {
            if ($timeFormat < Carbon::now()->format('H:i' . ':00')) {
                return redirect()->route('worktime.index')->with(
                    [
                        'message' => 'Година повинна бути в майбутньому',
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
                    'message' => 'Ця година вже існує у вибраній даті',
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
                'message' => 'Годину успішно додано!',
                'type' => 'success',
            ]
        );
    }

    private function storeWorktime(int $userId, string $date, string $time, int $isFree = 1)
    {
        $worktimeExist = Worktime::where('user_id', $userId)
            ->where('date', $date)
            ->where('time', $time)
            ->exists();

        if (!$worktimeExist) {
            $worktime = new Worktime();
            $worktime->user_id = $userId;
            $worktime->date = $date;
            $worktime->time = $time;
            $worktime->is_free = $isFree;
            $worktime->save();
        }
    }

    public function generate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'date' => 'required|after_or_equal:' . Carbon::now()->toDateString(),
            'times' => 'required|array',
        ]);

        foreach ($request->times as $time) {
            if ($request->date == Carbon::now()->toDateString()) {
                if ($time > Carbon::now()->format('H:i:s')) {
                    $this->storeWorktime($request->user_id, $request->date, $time);
                }
            } else {
                $this->storeWorktime($request->user_id, $request->date, $time);
            }
        }

        return redirect()->route('worktime.index')->with(
            [
                'message' => 'Графік успішно згенеровано!',
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
                'message' => 'Годину успішно видалено!',
                'type' => 'success',
            ]
        );
    }
}
