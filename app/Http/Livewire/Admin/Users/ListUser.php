<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class ListUser extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;
    // public $name;
    // public $email;
    // public $password;
    // public $password_confirmation;
    
    public function addNew() 
    {
        // dd('addNew');
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form'); 
    }

    public function createUser() 
    {
        // dd($this->state);
        $this->showEditModal = false;
        $validateData = Validator::make($this->state, [
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|confirmed',
        ])->validate();
        // dd($validateData);

        $validateData['password'] = bcrypt($validateData['password']);
        User::create($validateData);

        // pass message session
        // session()->flash('message', 'User added successfully');

        

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User Added Successfully']);
        return redirect()->back();
    }

    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;
        // dd($user->toArray());
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
        // dd($user);   
    }

    public function updateUser()
    {
        // dd('updateUser');
        $validateData = Validator::make($this->state, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();

        if(!empty($validateData['password'])) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        $this->user->update($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
        return redirect()->back();
    }
    

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully']);
    }



    public function render()
    {
        // return view('livewire.admin.users.list-user');

        $users = User::latest()->paginate(5);
        return view('livewire.admin.users.list-user', [
            'users' => $users
        ]);
    }
}
