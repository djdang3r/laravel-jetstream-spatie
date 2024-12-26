<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Whatsapp Business Account</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: none;">
        <!-- form start -->
        <form wire:submit.prevent="save" class="form-horizontal">
            <div class="card-body">
                <div class="form-group">
                    <label for="waba_id">Whatsapp Business ID <code> Meta Account</code></label>
                    <input type="number" class="form-control form-control-border" id="waba_id" wire:model="waba_id"
                        placeholder="Identificador de la cuenta de WhatsApp Business">
                    @error('waba_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="waba_api_token">API Token
                        <code> Bearer Token</code></label>
                    <textarea class="form-control" id="waba_api_token" wire:model="waba_api_token" rows="3" placeholder="Token de acceso ..."></textarea>
                    @error('waba_api_token') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Register</button>
                <button type="button" class="btn btn-default float-right" wire:click="resetForm">Cancel</button>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
    <!-- /.card-body -->
</div>