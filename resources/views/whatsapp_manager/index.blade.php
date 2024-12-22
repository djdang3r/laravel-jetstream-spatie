@extends('adminlte::page')

@section('title', 'Whatsapp API Cloud Manager')

@section('content_header')
    <h1>Whatsapp API Cloud Manager</h1>
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@stop

@section('js')
    <script></script>
@stop

@section('vite')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@stop
