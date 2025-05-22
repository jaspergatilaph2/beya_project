<?php

namespace App\Http\Controllers\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;

class AnalyticsAppointmentsController extends Controller
{
    public function getMonthlyAppointments(Request $request)
    {
        $ownerName = $request->query('owner_name');

        $appointments = Appointments::selectRaw('MONTH(created_at) as month, COUNT(DISTINCT owner_name) as total')
            ->when($ownerName, function ($query) use ($ownerName) {
                $query->where('owner_name', $ownerName);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [];
        $data = [];

        foreach ($appointments as $appointment) {
            $labels[] = date("F", mktime(0, 0, 0, $appointment->month, 10));
            $data[] = $appointment->total;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
