<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{ 

    public function show(){
        $user = Auth::user();
        return view('account', compact('user'));
    }

    public function update(Request $request){
    
        $user = auth()->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
    ]);

    if ($request->hasFile('profile_pic')) {
        $path = $request->file('profile_pic')->store('profile-pictures', 'public');
        $validated['profile_pic'] = $path;
        if ($user->profile_pic) {
            Storage::disk('public')->delete($user->profile_pic);
        }
    }

    $user->update($validated);
    return redirect()->route('account')->with('success', 'Profile updated successfully!');
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

        return redirect('/home');
    }
}
