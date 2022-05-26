<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function show()
    {
        $course = null;
        if(auth()->user()->hasRole('teacher')) {
            $course = auth()->user()->teaches;
        }

        return view('password.change', [
            'course' => $course,
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        // validate if email same as one in db, if new password is not same as old one, if password confirmation is correct
        $request->validate([
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);

        // update password
        auth()->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('home');

    }
}
