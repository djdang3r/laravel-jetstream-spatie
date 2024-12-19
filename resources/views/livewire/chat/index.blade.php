<div>
    <!-- Aquí puedes agregar el contenido del chat -->
    <div class="card card-success direct-chat direct-chat-success">
        <div class="card-header">
            <h3 class="card-title">Direct Chat</h3>
            <div class="card-tools">
                <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fas fa-comments"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @include('livewire.chat.chat-box')
            @include('livewire.chat.chat-list')
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <form action="#" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                    <span class="input-group-append">
                        <button type="button" class="btn btn-primary">Send</button>
                    </span>
                </div>
            </form>
        </div>
        <!-- /.card-footer-->
    </div>
    
</div>