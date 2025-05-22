<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointments;
use Illuminate\Support\Facades\DB;

class Admincontroller extends Controller
{
    public function index()
    {

        return view('admin.dashboard.home', compact('appointments'));
    }


    public function accounts()
    {
        $user = Auth::user();
        return view('admin.accounts.show', [
            'ActiveTab' => 'accounts',
            'SubActiveTab' => 'show'
        ], compact('user'));
    }

    public function editAccounts()
    {
        $user = Auth::user();
        return view('admin.accounts.edit', [
            'ActiveTab' => 'accounts',
            'SubActiveTab' => 'edit',
        ], compact('user'));
    }

    public function updateAccounts(Request $request, User $user)
    {
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

        return redirect()->back()->with('success', 'Account updated successfully.');
    }


    public function appointmentsReport()
    {
        // Fetch all appointments (you can add filters or eager loading if needed)
        $appointments = Appointments::all();

        // Return view with appointments data
        return view('admin.dashboard.home', compact('appointments'));
    }

    public function countConfirmedAppointments()
    {
        // Count confirmed appointments (or customize your logic)
        $count = Appointments::where('status', 'confirmed')->count();

        // Return JSON response
        return response()->json([
            'appointments' => $count,
        ]);
    }
}
