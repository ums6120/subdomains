<div>
    <div class="modal d-block" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="upateModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title">Manage Admin</h5>
                    <button type="button" class="btn p-0" data-dismiss="modal" aria-label="Close">
                        <h2 aria-hidden="true" wire:click="$emitUp('closeEdit')">&times;</h2>
                    </button>
                </div>
                <div class="modal-body">
                    @if($showMessage)
                        <div class="alert alert-success alert-dismissible p-2" role="alert">
                        	Save successfully!
                            <button type="button" class="btn p-0" data-dismiss="alert" aria-label="Close"><h2
                                    aria-hidden="true">&times;</h2></button>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <div class="col-12">
                            <input type="text" wire:model.defer="admin.name" name="name" class='form-control'>
                            @error('admin.name') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <div class="col-12">
                            <input type="text" wire:model.defer="admin.email" name="email" class='form-control'>
                            @error('admin.email') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <div class="col-12">
                            <input type="password" wire:model.defer="admin.password" name="password" class='form-control'>
                            @error('admin.password') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="domain" class="control-label">Domain</label>
                        <div class="col-12">
                            <select wire:model="admin.domain_id" class="form-control">
                                <option value="">Select Domain</option>
                                @foreach($domains as $domain)
                                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                @endforeach
                            </select>
                            @error('admin.domain_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" wire:click="$emitUp('closeEdit')">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" wire:click="save()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        this.livewire.on('askdelete', id => {
            bootbox.confirm("Are you sure you want to delete ?", (result) => {
                if (result) {
                    this.livewire.emit('delete', id)
                }
            });
        });
    });
</script>
<style>
    .error{
        color:red;
    }
</style>
