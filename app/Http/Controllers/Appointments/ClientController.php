<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ClientController extends Controller
{
    public function indexAppointments()
    {
        $appointments = Appointments::all();
        return view('admin.appointments.view', [
            'ActiveTab' => 'appoinments',
            'SubActiveTab' => 'list'
        ], compact('appointments'));
    }


    public function updateStatus($appointmentId, $status)
    {
        $appointment = Appointments::findOrFail($appointmentId);

        // Optionally validate the status value before saving
        $validStatuses = ['pending', 'confirmed', 'cancelled'];
        if (!in_array($status, $validStatuses)) {
            return back()->withErrors('Invalid status value.');
        }

        $appointment->status = $status;
        $appointment->save();

        return back()->with('success', 'Appointment status updated.');
    }

    public function destroy($id)
    {
        $appointment = Appointments::findOrFail($id);
        $appointment->delete();

        return redirect()->with('success', 'Appointment deleted successfully.');
    }

    public function list()
    {
        $appointments = Appointments::all(); // or use your own query/filter
        return view('admin.pets.view', [
            'appointments' => $appointments,
            'ActiveTab' => 'pets',
            'SubActiveTab' => 'list',
        ]);
    }

    public function viewAppointments()
    {
        $appointments = Appointments::with('user')->get()->unique('owner_name');
        return view('admin.owners.view', [
            'appointments' => $appointments,
            'ActiveTab' => 'owners',
            'SubActiveTab' => 'list',
        ]);
    }
}
