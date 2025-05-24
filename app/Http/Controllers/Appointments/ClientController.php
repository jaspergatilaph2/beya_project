<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Logs;
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

        return redirect()->back()->with('success', 'Appointment deleted successfully.');
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

    public function logs()
    {
        // Get all logs, paginated (adjust perPage as needed)
        $logs = Logs::with(['user', 'appointment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.logs.logs', [
            'logs' => $logs,
            'ActiveTab' => 'logs',
            'SubActiveTab' => 'list',
        ]);
    }
}
