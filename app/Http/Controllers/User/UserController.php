<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Logs;

class UserController extends Controller
{
    public function userMaintenance()
    {
        return view('users.maintenance.maintenance');
    }

    public function index()
    {
        $user = User::find(Auth::id());
        return view('users.dashboard.home', compact('user'));
    }

    public function accounts()
    {
        $user = User::find(Auth::id());
        return view('users.accounts.show', [
            'ActiveTab' => 'userAccounts',
            'SubActiveTab' => 'ShowUserAccounts',
        ], compact('user'));
    }

    public function userEditAccounts()
    {
        $user = Auth::user();
        return view('users.accounts.edit', [
            'ActiveTab' => 'accounts',
            'SubActiveTab' => 'edit',
        ], compact('user'));
    }

    public function userUpdateAccounts(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Logs::create([
            'user_id' => $user->id,
            'description' => $user->name . '" updated their account information.',
        ]);
        return redirect()->back()->with('success', 'Account updated successfully.');
    }
}
