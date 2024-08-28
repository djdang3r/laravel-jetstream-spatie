@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Role Detail</h1>
@stop

@section('content')

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects Detail</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Estimated budget</span>
                                            <span class="info-box-number text-center text-muted mb-0">2300</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Total amount spent</span>
                                            <span class="info-box-number text-center text-muted mb-0">2000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center text-muted">Estimated project
                                                duration</span>
                                            <span class="info-box-number text-center text-muted mb-0">20</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- -->
                        <div class="col-12 col-md-12 col-lg-4">
                            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ ucfirst($role->name) }}</h3>
                            <p class="text-muted">{{ $role->description }}.</p>
                            <br>

                            <!-- 
                            <div class="text-muted">
                                <p class="text-sm">Client Company
                                    <b class="d-block">Deveint Inc</b>
                                </p>
                                <p class="text-sm">Project Leader
                                    <b class="d-block">Tony Chicken</b>
                                </p>
                            </div>


                            <h5 class="mt-5 text-muted">Project files</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                        Functional-requirements.docx</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i>
                                        UAT.pdf</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>
                                        Email-from-flatbal.mln</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i>
                                        Logo.png</a>
                                </li>
                                <li>
                                    <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                        Contract-10_12_2014.docx</a>
                                </li>
                            </ul>
                            <div class="text-center mt-5 mb-3">
                                <a href="#" class="btn btn-sm btn-primary">Add files</a>
                                <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                            </div>
                            -->
                        </div>
                    
                        
                        <div class="col-12 col-md-12 col-lg-8 ">
                            <div class="row">
                                <div class="row">
                                    @foreach ($modules as $module)
                                        <div class="col-md-4 col-sm-12">
                                            <x-adminlte-card title="{{ ucfirst($module->name) }}" theme="info"
                                                icon="fas fa-lg fa-bell" collapsible maximizable>
                                                <div class="form-group">
                                                    @foreach ($module->permissions as $permission)
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input permission-checkbox"
                                                                id="permission-{{ $permission->id }}" name="permissions[]"
                                                                value="{{ $permission->name }}"
                                                                data-permission="{{ $permission->name }}"
                                                                data-role-id="{{ $role->id }}"
                                                                {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="permission-{{ $permission->id }}">
                                                                {{ ucfirst($permission->name) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </x-adminlte-card>
                                        </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        </div>


                        
                    </div>
                </div>

            </div>














            
        </div>
    </section>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");

        $(document).ready(function() {
            $('.permission-checkbox').on('change', function() {
                var isChecked = $(this).is(':checked');
                var permissionName = $(this).data('permission');
                var roleId = $(this).data('role-id');

                $.ajax({
                    url: '{{ route('roles.update-permission', ['role' => $role->id]) }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        permission: permissionName,
                        isChecked: isChecked
                    },
                    success: function(response) {
                        console.log('Permission updated successfully.');
                    },
                    error: function(xhr) {
                        console.error('An error occurred:', xhr.responseText);
                    }
                });
            });
        });
    </script>

@stop
