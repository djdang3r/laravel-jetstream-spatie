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
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
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

                                <div class="tab-pane" id="timeline">

                                    <div class="timeline timeline-inverse">

                                        <div class="time-label">
                                            <span class="bg-danger">
                                                10 Feb. 2014
                                            </span>
                                        </div>


                                        <div>
                                            <i class="fas fa-envelope bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent
                                                    you an email</h3>
                                                <div class="timeline-body">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                    quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            <i class="fas fa-user bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                    accepted your friend request
                                                </h3>
                                            </div>
                                        </div>


                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented
                                                    on your post</h3>
                                                <div class="timeline-body">
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                        comment</a>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="time-label">
                                            <span class="bg-success">
                                                3 Jan. 2014
                                            </span>
                                        </div>


                                        <div>
                                            <i class="fas fa-camera bg-purple"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded
                                                    new photos</h3>
                                                <div class="timeline-body">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                    <img src="https://placehold.it/150x100" alt="...">
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
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
