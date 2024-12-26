<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Template Manager</h3>
            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
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
                    @foreach($templates as $template)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>
                                <!-- Add any actions you need here -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu" style="">
                                        <a class="dropdown-item modal-editTemplate" href="#" data-template-name="{{ $template->name }}" data-template-id="{{ $template->template_id }}" data-template-wa-id="{{ $template->wa_template_id }}">Editar Plantilla</a>
                                        <a class="dropdown-item modal-detailTemplate" href="#" data-template-name="{{ $template->name }}" data-template-id="{{ $template->template_id }}" data-template-wa-id="{{ $template->wa_template_id }}">Detalles de Plantilla</a>
                                        <a class="dropdown-item modal-sendTemplate" href="#" data-template-name="{{ $template->name }}" data-template-id="{{ $template->template_id }}" data-template-wa-id="{{ $template->wa_template_id }}">Enviar Plantilla</a>
        
                                        <div class="dropdown-divider"></div>
        
                                        <a class="dropdown-item modal-deleteTemplate" href="#">Eliminar Plantilla</a>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $template->name }}</td>
                            @if ($template->category == 'AUTHENTICATION')
                                <td><span class="badge bg-primary"><i class="fa fa-lock" aria-hidden="true"></i></span> {{ $template->category }}</td>
                            @elseif ($template->category == 'MARKETING')
                                <td><span class="badge bg-info"><i class="fa fa-tag" aria-hidden="true"></i></span> {{ $template->category }}</td>
                            @elseif ($template->category == 'UTILITY')
                                <td><span class="badge bg-navy"><i class="fa fa-paperclip" aria-hidden="true"></i></span> {{ $template->category }}</td>
                            @endif
                            <td>{{ $template->language }}</td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                    {{ $template->updated_at->format('d M h:i a') }}
                                </div>
                            </td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger"
                                        style="width: 55%"></div>
                                </div>
                            </td>
                            @if ($template->status == 'APPROVED')
                                <td><span class="badge bg-success">{{ $template->status }}</span></td>
                            @elseif ($template->status == 'PENDING')
                                <td><span class="badge bg-warning">{{ $template->status }}</span></td>
                            @elseif ($template->status == 'REJECTED')
                                <td><span class="badge bg-danger">{{ $template->status }}</span></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    @livewire('whatsapp.modals.view-template-modal')
</div>
