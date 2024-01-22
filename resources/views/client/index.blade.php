@extends('layout.main')

@section('content')

<title>List of Clients</title>

<div class="sticky-top">
    @include('include.topbar')
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <div class="card mt-5">
                <div class="card-header">
                    <b>List of Clients</b>
                    <span>
                        <a class="btn btn-primary btn-block btn-sm col-sm-2 float-end" href="#" id="new_client">
                            <i class="fa fa-plus"></i> New Client
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-hover">
                            <div class=" mt-1 me-1 float-end">
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
                                        <a href="#" class="btn btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-outline-danger">Delete</a>
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