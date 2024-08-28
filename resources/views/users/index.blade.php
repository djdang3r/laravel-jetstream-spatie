@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Welcome User</h1>
@stop

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">

          <div class="small-box bg-info">
          <div class="inner">
          <h3>{{ $total_users }}</h3>
          <p>Users</p>
          </div>
          <div class="icon">
          <i class="fas fa-user"></i>
          </div>
          <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
          </a>
          </div>
          </div>

          <div class="col-lg-3 col-6">

          <div class="small-box bg-success">
          <div class="inner">
          <h3>{{ $new_users }}</h3>
          <p>New Users</p>
          </div>
          <div class="icon">
          <i class="fas fa-user-plus"></i>
          </div>
          <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
          </a>
          </div>
          </div>

          <div class="col-lg-3 col-6">

          <div class="small-box bg-warning">
          <div class="inner">
          <h3>0</h3>
          <p>Canceled Users</p>
          </div>
          <div class="icon">
          <i class="fas fa-user"></i>
          </div>
          <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
          </a>
          </div>
          </div>

          <div class="col-lg-3 col-6">

          <div class="small-box bg-danger">
          <div class="inner">
          <h3>{{ $deleted_users }}</h3>
          <p>Deleted Users</p>
          </div>
          <div class="icon">
          <i class="fas fa-user"></i>
          </div>
          <a href="#" class="small-box-footer">
          More info <i class="fas fa-arrow-circle-right"></i>
          </a>
          </div>
          </div>

          </div>
        <!-- /.row -->

        <div class="row">
          
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    







    @php
        $heads = [
            'ID',
            'Name',
            ['label' => 'Email', 'width' => 40],
            'Roles',
            ['label' => 'Actions', 'no-export' => true, 'width' => 15],
        ];

        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>';

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="users-list" :heads="$heads">
        @foreach($users as $user)
            <tr>
                    <td>{!! $user->id !!}</td>
                    <td>{!! $user->name !!}</td>
                    <td>{!! $user->email !!}</td>
                    <td>
                        @foreach($user->roles as $role)
                        <span class="badge badge-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        @can('edit user')
                            <a href="/users/edit/{{ $user->id }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                        @endcan

                        @can('delete user')
                            <a href="/users/delete/{{ $user->id }}" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </a>
                        @endcan

                        @can('view datail user')
                            <a href="/users/{{ $user->id }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
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

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}


@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

@stop
