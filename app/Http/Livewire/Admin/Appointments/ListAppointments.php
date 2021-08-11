<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use Livewire\Component;

class ListAppointments extends Component
{
    public function render()
    {

        $appointments = Appointment::with('client')
            ->latest()
            ->paginate();

        return view('livewire.admin.appointments.list-appointments', [
            'appointments'  => $appointments,
        ]);
    }
}
