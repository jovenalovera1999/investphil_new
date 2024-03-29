@extends('layout.main')

@section('content')

<title>PHILINVEST | List of Clients</title>

@include('include.topbar')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <div class="card mt-3">
                <div class="card-header">
                    <b>List of Clients</b>
                    <span>
                        <a class="btn btn-primary btn-block btn-sm col-sm-2 float-end" href="/client/create"
                            id="new_client">
                            <i class="fa fa-plus"></i> New Client
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    @include('include.messages')
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-hover">
                            <div class="ms-1 me-1 col-sm-3">
                                <form action="/clients" method="get">
                                    <label for="search">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" />
                                </form>
                            </div>
                            <div class="mt-1 me-1">
                                {{ $clients->links() }}
                            </div>
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)    
                                <tr>
                                    <td>{{ $client->first_name }}</td>
                                    <td>{{ $client->middle_name }}</td>
                                    <td>{{ $client->last_name }}</td>
                                    <td>{{ $client->age }}</td>
                                    <td>{{ $client->gender }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->contact_number }}</td>
                                    <td>
                                        <a href="/client/show/{{ $client->user_id }}" class="btn btn-outline-primary">View</a>
                                        <a href="/client/edit/{{ $client->user_id }}" class="btn btn-outline-warning">Edit</a>
                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                            <form action="/destroy_client/{{ $client->user_id }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </form>
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
    </div>
</div>

@endsection