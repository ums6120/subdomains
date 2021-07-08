<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Hash;

class EditUser extends Component
{
    public $user;
    public $showMessage = false;

    protected $rules = [
        'user.name'    => 'required|string|min:6',
        'user.email'   => 'required|email',
        'user.password'   => 'sometimes|required',
    ];

    public function render()
    {
        return view('livewire.edit-user');
    }

    public function delete($id)
    {
        User::destroy([$id]);
        $this->emitUp('closeEdit');
    }


    public function save()
    {
        $this->validate();
        if (is_object($this->user)) {
        	if(empty($this->user['password'])) {
        		unset($this->user['password']);
        	} else {
            	$this->user['password'] = Hash::make($this->user['password']);
        	}
            $this->user->save();
        } else {
        	if(empty($this->user['password'])) {
        		unset($this->user['password']);
        	} else {
            	$this->user['password'] = Hash::make($this->user['password']);
        	}
            $this->user             = User::create($this->user);
        }
        $this->showMessage = true;
    }


}
