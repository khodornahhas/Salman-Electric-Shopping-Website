<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{ 
   public function show()
{
    if (!Auth::check()) {
        return redirect()->route('login'); 
    }

    $user = Auth::user();
    return view('account', compact('user'));
}


    public function update(Request $request){
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'address' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return redirect('/account')->with('success', 'Profile updated successfully!');
    }

    public function destroy(Request $request){
        $request->validate([
            'password' => ['required'],
        ]);

        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error', 'Incorrect password.');
        }

        $user = auth()->user();
        auth()->logout();
        $user->delete();

        return redirect('/profile');
    }
}
