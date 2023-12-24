<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use App\Mail\UserReportMail;
use Illuminate\Http\Request;
use App\Mail\RegistrationSuccessMail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user = User::create($request->all());

        // Send welcome email
        Mail::to($user->email)->send(new UserReportMail($user));

        Mail::to('admin@somewebsite.com')->send(new RegistrationSuccessMail($user));

        return redirect()->route('home')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());

        return redirect()->route('home')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('home')->with('success', 'User deleted successfully');
    }
}
