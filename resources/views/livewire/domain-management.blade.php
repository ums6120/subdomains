<div class="row">
    <div class="card p-0 mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            Total Records : {{ $totalDomains }}
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td wire:click="sortBy('id')">ID</td>
                    <td wire:click="sortBy('name')">Name</td>
                    <td wire:click="sortBy('created_at')">Created At</td>
                    <td wire:click="sortBy('updated_at')">Updated At</td>
                    <td>Action</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" wire:model.debounce.200ms="search.id" placeholder="id" class="form-control">
                    </td>
                    <td>
                        <input type="text" wire:model.debounce.200ms="search.name" placeholder="name" class="form-control">
                    </td>
                    <td class="" nowrap>
                        <button class="btn btn-sm btn-info text-white" wire:click="clearAll">Search</button>
                        <button class="btn btn-sm btn-success" wire:click="edit(null)">Add</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($domains as $listdomain)
                    <tr>
                        <td>{{ $listdomain->id}}</td>
                        <td>{{ $listdomain->name}}</td>
                        <td>{{ $listdomain->created_at->diffForHumans()}}</td>
                        <td>{{ $listdomain->updated_at->diffForHumans()}}</td>
                        <td class="float-right">
                            <button wire:click="edit({{ $listdomain->id }})" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm" wire:click="$emit('askdelete',{{$listdomain->id}})"><i class="fas fa-trash"></i></button>
                        </td>


                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        {{ $domains->links() }}
                    </td>
                    <td colspan="2">
                        <select wire:model="paginationCount" class="form-control">
                            @foreach($possibleCounts as $number)
                                <option value="{{ $number }}">{{ $number }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @if($editDomain)
        <livewire:edit-domain :domain="$domain"/>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        this.livewire.on('askdelete', id => {
            if(confirm("Are you sure you want to delete this?")){
                this.livewire.emit('delete', id);
            }
        });
    });
</script>
