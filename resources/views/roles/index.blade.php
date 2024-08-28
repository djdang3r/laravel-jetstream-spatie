@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Roles and Permissions</h1>
@stop

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                @php
                    $heads = [
                        'ID',
                        'Name',
                        'Guard',
                        ['label' => 'Actions', 'no-export' => true, 'width' => 20],
                    ];

                    $config = [
                        'order' => [[1, 'asc']],
                        'columns' => [null, null, null, ['orderable' => true]],
                    ];
                @endphp

                {{-- Minimal example / fill data using the component slot --}}
                <x-adminlte-datatable id="roles-list" :heads="$heads">
                    @foreach($roles as $role)
                        <tr>
                                <td>{!! $role->id !!}</td>
                                <td>{!! $role->name !!}</td>
                                <td>{!! $role->guard_name !!}</td>
                                <td>
                                    @can('edit role')
                                        <a href="/roles/edit/{{ $role->id }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                            <i class="fa fa-lg fa-fw fa-pen"></i>
                                        </a>
                                    @endcan

                                    @can('delete role')
                                        <a href="/roles/delete/{{ $role->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </a>
                                    @endcan

                                    @can('view detail role')
                                        <a href="/roles/{{ $role->id }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                            <i class="fa fa-lg fa-fw fa-eye"></i>
                                        </a>
                                    @endcan
                                </td>
                        </tr>
                    @endforeach
                </x-adminlte-datatable>

                {{-- Compressed with style options / fill data using the plugin config --}}
                <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config"
                    striped hoverable bordered compressed/>



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
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop
