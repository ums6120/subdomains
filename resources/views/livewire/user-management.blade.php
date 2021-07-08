<div class="row">
    <div class="card p-0 mb-4">
        <div class="card-header">
            <i class="fas fa-users me-1"></i>
            Total Records : {{ $totalUsers }}
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td wire:click="sortBy('id')">ID</td>
                    <td wire:click="sortBy('name')">Name</td>
                    <td wire:click="sortBy('email')">E-mail</td>
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
                    <td>
                        <input type="text" wire:model.debounce.200ms="search.email" placeholder="email" class="form-control">
                    </td>
                    <td class="" nowrap>
                        <button class="btn btn-sm btn-info text-white" wire:click="clearAll">Search</button>
                        <button class="btn btn-sm btn-success" wire:click="edit(null)">Add</button>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($users as $listuser)
                    <tr>
                        <td>{{ $listuser->id}}</td>
                        <td>{{ $listuser->name}}</td>
                        <td>{{ $listuser->email}}</td>
                        <td>{{ $listuser->created_at->diffForHumans()}}</td>
                        <td>{{ $listuser->updated_at->diffForHumans()}}</td>
                        <td class="float-right">
                            <button wire:click="edit({{ $listuser->id }})" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-danger btn-sm" wire:click="$emit('askdelete',{{$listuser->id}})"><i class="fas fa-trash"></i></button>
                        </td>


                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        {{ $users->links() }}
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

    @if($editUser)
        <livewire:edit-user :user="$user"/>
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
