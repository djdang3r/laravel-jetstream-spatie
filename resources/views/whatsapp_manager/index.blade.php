@extends('adminlte::page')

@section('title', 'Whatsapp API Cloud Manager')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Whatsapp API Cloud Manager</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Whatsapp API Cloud Manager</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <!-- Main content -->
    @livewire('whatsapp.index')
    <!-- /.content -->
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style>
        .message-content {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px; /* Ajusta el ancho según tus necesidades */
            display: inline-block;
            vertical-align: middle;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css'])
@stop

@section('js')
    @vite(['resources/js/app.js'])
    <script></script>
@stop