<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ListUser extends Component
{

    public $state = [];
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    
    public function addNew() 
    {
        // dd('addNew');
        $this->dispatchBrowserEvent('show-form'); 
    }

    public function createUser() 
    {
        // dd($this->state);
        $validateData = Validator::make($this->state, [
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|confirmed',
        ])->validate();
        // dd($validateData);

        $validateData['password'] = bcrypt($validateData['password']);
        User::create($validateData);
        $this->dispatchBrowserEvent('hide-form');
        return redirect()->back();
    }
    

    public function render()
    {
        // return view('livewire.admin.users.list-user');

        $users = User::latest()->paginate();
        return view('livewire.admin.users.list-user', [
            'users' => $users
        ]);
    }
}
