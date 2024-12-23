@extends('adminlte::page')

@section('title', 'Whatsapp Chat')

@section('content_header')
    <h1>Whatsapp Chat</h1>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Phone Numbers List</h3>
                        </div>
                        <div class="card-body box-profile">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                    alt="user image">
                                <span class="username">
                                    <a href="#">Script Soport</a><!-- verified_name -->
                                </span>
                                <span class="description">57 323 4262686</span>
                                <span class="description">Phone number ID: 194112953793281</span>
                            </div>
                        </div>

                        <div class="card-body box-profile">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                    alt="user image">
                                <span class="username">
                                    <a href="#">Gogoo Soporte</a><!-- verified_name -->
                                </span>
                                <span class="description">57 314 5055047</span>
                                <span class="description">Phone number ID: 1085687916275343</span>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Information</h3>
                        </div>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">Script Develop</h3>

                            <p class="text-muted text-center">57 323 4262686</p>

                            <strong><i class="fas fa-book mr-1"></i> Phone number ID</strong>
                            <p class="text-muted">
                                194112953793281
                            </p>

                            <strong><i class="fas fa-book mr-1"></i> Address</strong>
                            <p class="text-muted">
                                Santa Rosa de Cabal, Terrazas de Monserrate.
                            </p>

                            <strong><i class="fas fa-book mr-1"></i> Email</strong>
                            <p class="text-muted">
                                info@scriptdevelop.com.co
                            </p>

                            <strong><i class="fas fa-book mr-1"></i> Web sites</strong>
                            <ul class="text-muted">
                                <li>
                                    <a href="https://www.scriptdevelop.com.co" target="_blank">www.scriptdevelop.com.co</a>
                                </li>
                                <li>
                                    <a href="https://www.scriptdevelop.com" target="_blank">www.scriptdevelop.com</a>
                                </li>
                            </ul>

                            <strong><i class="fas fa-book mr-1"></i> Description</strong>
                            <p class="text-muted">
                                Servicios
                            </p>


                            {{-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="float-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="float-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="float-right">13,287</a>
                                </li>
                            </ul> --}}

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#chats" data-toggle="tab">Chats</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#update-account" data-toggle="tab">Update
                                        Account</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="chats">
                                    <div class="row">
                                        <div class="col-4">
                                            <div
                                                class="card card-success direct-chat direct-chat-success direct-chat-contacts-open">
                                                <div class="card-header">
                                                    <h3 class="card-title">Asesores</h3>
                                                </div>
                                                <div class="card-body">
                                                    <!-- Contacts are loaded here -->
                                                    <div class="asesor-list">
                                                        <ul class="contacts-list">
                                                            <li>
                                                                <a href="#">
                                                                    <img class="contacts-list-img"
                                                                        src="https://adminlte.io/docs/3.1//assets/img/user1-128x128.jpg">
                                                                    <div class="contacts-list-info">
                                                                        <span class="contacts-list-name">
                                                                            Script Soport "Default"
                                                                            <small
                                                                                class="contacts-list-date float-right">2/28/2015</small>
                                                                        </span>
                                                                        <span class="contacts-list-msg">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                fill="currentColor"
                                                                                class="bi bi-check-all"
                                                                                viewBox="0 0 16 16">
                                                                                <path
                                                                                    d="M8.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L2.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093L8.95 4.992zm-.92 5.14.92.92a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 1 0-1.091-1.028L9.477 9.417l-.485-.486z">
                                                                                </path>
                                                                            </svg>How have you been? I was...
                                                                        </span>
                                                                        <span class="badge badge-success float-right">
                                                                            4
                                                                        </span>
                                                                    </div>
                                                                    <!-- /.contacts-list-info -->
                                                                </a>
                                                            </li>
                                                            <!-- End Contact Item -->
                                                        </ul>
                                                        <!-- /.contacts-list -->
                                                    </div>
                                                    <!-- /.direct-chat-pane -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            @livewire('chat.index')
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="update-account">

                                </div>

                                <div class="tab-pane" id="settings">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script></script>
@stop
