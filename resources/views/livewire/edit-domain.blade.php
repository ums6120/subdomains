<div>
    <div class="modal d-block" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="upateModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h5 class="modal-title">Manage Domain</h5>
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
                        <label for="name" class="control-label">Domain Name</label>
                        <div class="col-12">
                            <input type="text" wire:model.defer="domain.name" name="name" class='form-control'>
                            @error('domain.name') <span class="error">Domain Name is required.</span> @enderror
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
