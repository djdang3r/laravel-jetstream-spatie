<div class="card-body">
    <div class="tab-content">
        <div class="active tab-pane" id="permissions">
            <div class="row">
                @foreach($modules as $module)
                    <div class="col-md-3 col-sm-12">
                        <x-adminlte-card title="{{ ucfirst($module->name) }}" theme="info" icon="fas fa-lg fa-bell" collapsible maximizable>
                            <div class="form-group">
                                @foreach($module->permissions as $permission)
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" 
                                               class="custom-control-input permission-checkbox" 
                                               id="permission-{{ $permission->id }}" 
                                               name="permissions[]" 
                                               value="{{ $permission->name }}"
                                               {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                               {{ !auth()->user()->can('edit permissions') ? '' : 'disabled' }}
                                               data-permission="{{ $permission->name }}">
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