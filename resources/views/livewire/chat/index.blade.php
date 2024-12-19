<div>
    <!-- Aquí puedes agregar el contenido del chat -->
    <div class="card card-success direct-chat direct-chat-success direct-chat-contacts-open">
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
            @livewire('chat.chat-box')
            @livewire('chat.chat-list')
        </div>
        <!-- /.card-body -->
        
    </div>
    
</div>