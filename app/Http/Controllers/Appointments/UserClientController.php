<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;

class UserClientController extends Controller
{
    public function userAppointments()
    {
        // Logic to retrieve and show user appointments
        return view('users.appointments.create', [
            'ActiveTab' => 'appointments',
            'SubActiveTab' => 'userAppointments',
        ]);
    }

    public function store(Request $request)
    {
        // Validate inputs
        $validated = $request->validate([
            'owner_name' => 'required|string|max:255',
            'pet_name' => 'required|string|max:255',
            'contact_number' => 'required|digits:11',
            'pet_breed' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today', // ✅ updated this line
            'upload_document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'pets_picture' => 'nullable|image|max:2048',
            'reason' => 'required|string',
        ]);

        // Handle file upload
        $uploadDocPath = null;
        if ($request->hasFile('upload_document')) {
            $uploadDocPath = $request->file('upload_document')->store('medical_records', 'public');
        }

        $petsPicturePath = null;
        if ($request->hasFile('pets_picture')) {
            $petsPicturePath = $request->file('pets_picture')->store('pets', 'public');
        }

        // Create appointment
        Appointments::create([
            'user_id' => auth()->id(),
            'owner_name' => $validated['owner_name'],
            'pet_name' => $validated['pet_name'],
            'contact_number' => $validated['contact_number'],
            'pet_breed' => $validated['pet_breed'],
            'appointment_date' => $validated['appointment_date'],
            'upload_document' => $uploadDocPath,
            'pets_picture' => $petsPicturePath,
            'reason' => $validated['reason'],
        ]);

        return back()->with('success', 'Appointment booked successfully.');
    }


    public function viewAppointments()
    {
        // Logic to retrieve and show user appointments
        $appointments = Appointments::where('user_id', auth()->id())->get();

        return view('users.appointments.view', [
            'ActiveTab' => 'appointments',
            'SubActiveTab' => 'viewAppointments',
            'appointments' => $appointments,
        ]);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointments::findOrFail($id);

        $validated = $request->validate([
            'owner_name' => 'required|string',
            'pet_name' => 'required|string',
            'contact_number' => 'required|string|max:11',
            'pet_breed' => 'required|string',
            'reason' => 'required|string',
            'appointment_date' => 'required|date',
            'upload_document' => 'nullable|image|max:2048',
            'pets_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('upload_document')) {
            $validated['upload_document'] = $request->file('upload_document')->store('documents', 'public');
        }

        if ($request->hasFile('pets_picture')) {
            $validated['pets_picture'] = $request->file('pets_picture')->store('pets', 'public');
        }

        $appointment->update($validated);

        return redirect()->back()->with('success', 'Appointment updated successfully.');
    }

    public function viewPets()
    {
        $appointments = Appointments::where('user_id', auth()->id())->get();
        return view('users.pets.view', [
            'ActiveTab' => 'pets',
            'SubActiveTab' => 'viewPets',
            'appointments' => $appointments,
        ]);
    }
}
