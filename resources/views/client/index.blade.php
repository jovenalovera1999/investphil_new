@extends('layout.main')

@section('content')

@include('include.topbar')
@include('include.navbar')

<title>List of Clients</title>

<div class="container">
    <div class="row float-end">
        <div class="mt-5">
            <div class="card">
                <div class="card-header">
                    <b>List of Client</b>
                    <span>
                        <a class="btn btn-primary btn-block btn-sm col-sm-2 float-end" href="#" id="new_client">
                            <i class="fa fa-plus"></i> New Client
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
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
                                <tr>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>Hello World</td>
                                    <td>
                                        <a href="#" class="btn btn-outline-primary">View</a>
                                        <a href="#" class="btn btn-outline-warning">Edit</a>
                                        <a href="#" class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection