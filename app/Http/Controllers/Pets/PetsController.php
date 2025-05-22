<?php

namespace App\Http\Controllers\Pets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;

class PetsController extends Controller
{
    public function list()
    {
        $appointments = Appointments::all(); // or use your own query/filter
        return view('admin.pets.view', [
            'ActiveTab' => 'pets',
            'SubActiveTab' => 'list'
        ], compact('appointments'));
    }

    public function medicalHistory()
    {
        $appointments = Appointments::all();
        return view('admin.pets.medicalHistory', [
            'ActiveTab' => 'pets',
            'SubActiveTab' => 'medical'
        ], compact('appointments'));
    }

    public function edit($id)
    {
        $appointment = Appointments::findOrFail($id);
        return view('admin.pets.edit', [
            'ActiveTab' => 'pets',
            'SubActiveTab' => 'edit'
        ], compact('appointment'));
    }
}
