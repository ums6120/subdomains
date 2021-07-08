<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Admin;
use App\Models\Domain;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class AdminManagement extends Component
{
    use WithPagination;

    protected $listeners = ['closeEdit', 'delete', 'edit'];
    protected $paginationTheme = 'bootstrap';

    public $search = ['name' => '', 'email' => '', 'id' => '','domain_id'=>''];
    public $paginationCount = 10;
    public $sortField = "name";
    public $sortOrder = "asc";
    public $editAdmin = false;
    public $admin = null;

    public function render()
    {
        $admins = Admin::query();
        $admins = $this->applySearch($admins);
        $admins->orderBy($this->sortField, $this->sortOrder);
        $totalAdmins  = $admins->count();

        return view('livewire.admin-management',
            [
                'admin'           => $this->admin,
                'admins'          => $admins->paginate($this->paginationCount),
                'totalAdmins'    => $totalAdmins,
                'possibleCounts' => [1, 5, 10, 15, 20,50,100,200],
                'possibleDomains'  => Domain::all()
            ]
        );
    }

    public function sortBy($field)
    {
        $this->sortField = $field;
        $this->sortOrder = ($this->sortOrder == "asc") ? "desc" : "asc";
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPaginationCount()
    {
        $this->resetPage();
    }

    public function clearAll()
    {
        $this->search = ['name' => '', 'email' => '', 'id' => '','domain_id'=>''];
        $this->resetPage();
    }

    /** EDIT */

    public function edit($admin)
    {
        $this->admin     = Admin::find($admin);
        $this->editAdmin = true;
    }

    public function closeEdit()
    {
        $this->admin     = null;
        $this->editAdmin = false;
    }

    /** DELETE */

    public function delete($id)
    {
        Admin::destroy([$id]);
    }

    private function applySearch(\Illuminate\Database\Eloquent\Builder $admins)
    {
        $admins = ($this->search['name']) ? $admins->where('name', 'like', '%' . $this->search['name'] . '%') : $admins;
        $admins = ($this->search['email']) ? $admins->where('email', 'like', '%' . $this->search['email'] . '%') : $admins;
        $admins = ($this->search['id']) ? $admins->where('id', '=', $this->search['id']) : $admins;
        $admins = ($this->search['domain_id']) ? $admins->where('domain_id', '=', $this->search['domain_id']) : $admins;
        return $admins;
    }
}
