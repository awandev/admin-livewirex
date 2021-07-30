<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;

class ListUser extends Component
{
    
    public function addNew() 
    {
        // dd('addNew');
        $this->dispatchBrowserEvent('show-form'); 
    }
    

    public function render()
    {
        return view('livewire.admin.users.list-user');
    }
}
