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
@stop

@section('js')
    <script></script>
@stop
