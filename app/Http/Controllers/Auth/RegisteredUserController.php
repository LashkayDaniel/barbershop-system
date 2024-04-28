<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:' . User::class,
            'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'birth' => 'required|date',
            'phone' => 'required|string|size:14',
            'rank' => 'required|string|min:2|max:30',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth = $request->birth;
        $user->role_id = Role::IS_EMPLOYEE;
        $user->phone = $request->phone;
        $user->rank = $request->rank;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('staff.index')->with([
            'message' => 'Працівника успішно додано!',
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'birth' => 'required|date',
            'phone' => 'required|string|size:14',
            'rank' => 'required|string|min:2|max:30',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth = $request->birth;
        $user->phone = $request->phone;
        $user->rank = $request->rank;
        $user->update();

        return redirect()->route('staff.index')->with([
            'message' => 'Дані успішно оновлено!',
        ]);
    }
}
