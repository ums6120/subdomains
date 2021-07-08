<?php

namespace App\Http\Livewire;

use App\Models\Domain;
use Livewire\Component;

class EditDomain extends Component
{
    public $domain;
    public $showMessage = false;

    protected $rules = [
        'domain.name'    => 'required|string|min:3',
    ];

    public function render()
    {
        return view('livewire.edit-domain');
    }

    public function delete($id)
    {
        Domain::destroy([$id]);
        $this->emitUp('closeEdit');
    }


    public function save()
    {
        $this->validate();
        if (is_object($this->domain)) {
            $this->domain->save();
        } else {
            $this->domain= Domain::create($this->domain);
        }
        $this->showMessage = true;
    }


}
