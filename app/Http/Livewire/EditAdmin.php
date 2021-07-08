<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use App\Models\Domain;
use Livewire\Component;
use Hash;

class EditAdmin extends Component
{
    public $admin;
    public $showMessage = false;

    protected $rules = [
        'admin.name'    => 'required|string|min:6',
        'admin.email'   => 'required|email',
        'admin.domain_id' => 'required',
        'admin.password'   => 'sometimes|required',
    ];

    public function render()
    {
        $domains = Domain::all();
        return view('livewire.edit-admin',compact('domains'));
    }

    public function delete($id)
    {
        Admin::destroy([$id]);
        $this->emitUp('closeEdit');
    }


    public function save()
    {
        $this->validate();
        if (is_object($this->admin)) {
        	if(empty($this->admin['password'])) {
        		unset($this->admin['password']);
        	} else {
            	$this->admin['password'] = Hash::make($this->admin['password']);
        	}
            $this->admin->save();
        } else {
        	if(empty($this->admin['password'])) {
        		unset($this->admin['password']);
        	} else {
            	$this->admin['password'] = Hash::make($this->admin['password']);
        	}
            $this->admin             = Admin::create($this->admin);
        }
        $this->showMessage = true;
    }


}
