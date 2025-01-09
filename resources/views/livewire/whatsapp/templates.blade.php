<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Template Manager</h3>
            <input type="hidden" id="template_id" value="{{ $template_id }}">
            <div class="card-tools">
                <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#modal_create_template">+ Crear Nueva Plantilla</button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 40px">Actions</th>
                        <th>Template name</th>
                        <th>Category</th>
                        <th>Languaje</th>
                        <th>Last Updated</th>
                        <th>Messages</th>
                        <th style="width: 40px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($templates as $temp)
                        <tr wire:temp>
                            <td>{{ $loop->iteration }}.</td>
                            <td>
                                <!-- Add any actions you need here -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item modal-detailTemplate" data-toggle="modal" data-target="#modal_detail_template" href="#" data-template-name="{{ $temp->name }}" data-template-id="{{ $temp->template_id }}" data-template-wa-id="{{ $temp->wa_template_id }}">Detalles de Plantilla</a>
                                        <a class="dropdown-item modal-editTemplate" data-toggle="modal" data-target="#modal_edit_template" href="#" data-template-name="{{ $temp->name }}" data-template-id="{{ $temp->template_id }}" data-template-wa-id="{{ $temp->wa_template_id }}">Editar Plantilla</a>
                                        <a class="dropdown-item modal-sendTemplate" data-toggle="modal" data-target="#modal_send_template" href="#" data-template-name="{{ $temp->name }}" data-template-id="{{ $temp->template_id }}" data-template-wa-id="{{ $temp->wa_template_id }}">Enviar Plantilla</a>

                                        <div class="dropdown-divider"></div>

                                        <a class="dropdown-item modal-deleteTemplate" data-toggle="modal" data-target="#modal_delete_template" href="#">Eliminar Plantilla</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $temp->name }}</td>
                            @if ($temp->category == 'AUTHENTICATION')
                                <td><span class="badge bg-primary"><i class="fa fa-lock" aria-hidden="true"></i></span> {{ $temp->category }}</td>
                            @elseif ($temp->category == 'MARKETING')
                                <td><span class="badge bg-info"><i class="fa fa-tag" aria-hidden="true"></i></span> {{ $temp->category }}</td>
                            @elseif ($temp->category == 'UTILITY')
                                <td><span class="badge bg-navy"><i class="fa fa-paperclip" aria-hidden="true"></i></span> {{ $temp->category }}</td>
                            @endif
                            <td>{{ $temp->language }}</td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                    {{ $temp->updated_at->format('d M h:i a') }}
                                </div>
                            </td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            @if ($temp->status == 'APPROVED')
                                <td><span class="badge bg-success">{{ $temp->status }}</span></td>
                            @elseif ($temp->status == 'PENDING')
                                <td><span class="badge bg-warning">{{ $temp->status }}</span></td>
                            @elseif ($temp->status == 'REJECTED')
                                <td><span class="badge bg-danger">{{ $temp->status }}</span></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <livewire:whatsapp.modals.edit-template-modal>
    <livewire:whatsapp.modals.send-template-modal>
    <livewire:whatsapp.modals.view-template-modal>
    <livewire:whatsapp.modals.delete-template-modal>
    <livewire:whatsapp.modals.create-template-modal>
</div>

