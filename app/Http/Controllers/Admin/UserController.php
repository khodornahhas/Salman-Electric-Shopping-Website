<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'like', "%{$query}%")->get();
        return view('admin.users.index', compact('users'));
    }
}
