@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Profile</h1>
@stop
@section('plugins.BootstrapSwitch', true)
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            <p class="text-muted text-center">{{ $user->email }}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Onboarding</b> <a class="float-right">{{ ucfirst($user->created_at->diffForHumans()) }}</a>
                                </li>
                                <!--
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            -->
                            </ul>
                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div>

                    </div>


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                        </div>

                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Roles</strong>
                            <hr>
                            <p class="text-muted">
                                @foreach ($roles as $role)
                                    <x-adminlte-button label="{{ ucwords($role) }}" theme="info" icon="fas fa-info-circle"/>
                                @endforeach
                            </p>
                        </div>

                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#permissions"
                                        data-toggle="tab">Permissions</a></li>
                                <li class="nav-item"><a class="nav-link" href="#profile-accions" data-toggle="tab">Profile Actions</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="permissions">
                                    <div class="row">
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
                                    </div>
                                </div>

                                <div class="tab-pane" id="profile-accions">

                                    <x-app-layout>
                                        <x-slot name="header">
                                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                                {{ __('Profile') }}
                                            </h2>
                                        </x-slot>
                                
                                        <div>
                                            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                                                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                                    @livewire('profile.update-profile-information-form')
                                
                                                    <x-section-border />
                                                @endif
                                
                                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                                    <div class="mt-10 sm:mt-0">
                                                        @livewire('profile.update-password-form')
                                                    </div>
                                
                                                    <x-section-border />
                                                @endif
                                
                                                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                                    <div class="mt-10 sm:mt-0">
                                                        @livewire('profile.two-factor-authentication-form')
                                                    </div>
                                
                                                    <x-section-border />
                                                @endif
                                
                                                <div class="mt-10 sm:mt-0">
                                                    @livewire('profile.logout-other-browser-sessions-form')
                                                </div>
                                
                                                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                                    <x-section-border />
                                
                                                    <div class="mt-10 sm:mt-0">
                                                        @livewire('profile.delete-user-form')
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </x-app-layout>
                                </div>

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2"
                                                    placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills"
                                                    placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms
                                                            and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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
            $('.permission-checkbox').change(function() {
                var isChecked = $(this).is(':checked');
                var userId = $(this).data('user-id');
                var permission = $(this).data('permission');

                $.ajax({
                    url: '/users/' + {{ $user->id }} + '/assign-permission',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        permission: permission,
                        isChecked: isChecked
                    },
                    success: function(response) {
                        if(response.status === 'success') {
                            console.log('Permission updated successfully.');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error updating permission:', xhr.responseText);
                    }
                });
            });
        });
</script>
@stop
