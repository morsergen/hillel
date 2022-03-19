@extends('layouts.app')

@section('content')
    <div class="container admin-area">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Users') }} ({{$users->count()}})</h3>
                    </div>
                    <table class="admin">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Birthdate</th>
                            <th>Phone</th>
                            <th>Register Date</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->birthdate }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="div_paginate">{{ $users->links('admin/pagination/default') }}</div>
            </div>
        </div>
    </div>
@endsection
