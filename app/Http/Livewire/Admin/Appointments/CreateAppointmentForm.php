<?php

namespace App\Http\Livewire\Admin\Appointments;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateAppointmentForm extends Component
{
    public $state = [];

    public function createAppointment()
    {
        // dd($this->state);
        // $this->state['time'] = '00:00:00';

        Validator::make($this->state, [
            'client_id' => 'required',
            'date'  => 'required',
            'time'  => 'required',
            'note'  => 'nullable',
            'status'    => 'required|in:SCHEDULED,CLOSED',
        ])->validate();
        
        
        Appointment::create($this->state);
        $this->dispatchBrowserEvent('alert', ['message' => 'Appointment created successfully']);   
    }

    public function render()
    {
        $client = Client::all();
        return view('livewire.admin.appointments.create-appointment-form', [
            'clients' => $client,
        ]);
    }
}
