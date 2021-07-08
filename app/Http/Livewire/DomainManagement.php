<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Domain;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class DomainManagement extends Component
{
    use WithPagination;

    protected $listeners = ['closeEdit', 'delete', 'edit'];
    protected $paginationTheme = 'bootstrap';

    public $search = ['name' => '', 'id' => ''];
    public $paginationCount = 10;
    public $sortField = "name";
    public $sortOrder = "asc";
    public $editDomain = false;
    public $domain = null;

    public function render()
    {
        $domains = Domain::query();
        $domains = $this->applySearch($domains);
        $domains->orderBy($this->sortField, $this->sortOrder);
        $totalDomains  = $domains->count();

        return view('livewire.domain-management',
            [
                'domain'           => $this->domain,
                'domains'          => $domains->paginate($this->paginationCount),
                'totalDomains'    => $totalDomains,
                'possibleCounts' => [1, 5, 10, 15, 20,50,100,200],
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
        $this->search = ['name' => '', 'id' => ''];
        $this->resetPage();
    }

    /** EDIT */

    public function edit($domain)
    {
        $this->domain     = Domain::find($domain);
        $this->editDomain = true;
    }

    public function closeEdit()
    {
        $this->domain     = null;
        $this->editDomain = false;
    }

    /** DELETE */

    public function delete($id)
    {
        Domain::destroy([$id]);
    }

    private function applySearch(\Illuminate\Database\Eloquent\Builder $domains)
    {
        $domains = ($this->search['name']) ? $domains->where('name', 'like', '%' . $this->search['name'] . '%') : $domains;
        $domains = ($this->search['id']) ? $domains->where('id', '=', $this->search['id']) : $domains;
        return $domains;
    }
}
