@extends('layouts.app')
@include('layouts.components.sidebar')
@include('layouts.components.header')

@section('container')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <a href="{{ route('admin.users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fa-solid fa-plus"></i>
                Create new
            </a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                </button>
                <h4><i class="icon fas fa-check"></i> {{ Session::get('success') }}</h4>
            </div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users list</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="10px">№</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th width="150px">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->title }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <div style="float: left">
                                        <a
                                            href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                            class="btn btn-primary"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            Edit
                                        </a>
                                    </div>
                                    <div style="float:right;">
                                        <a
                                            href="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                            class="btn btn-danger delete-post">
                                            <i class="fa-solid fa-trash-can"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop

@include('layouts.components.footer')
