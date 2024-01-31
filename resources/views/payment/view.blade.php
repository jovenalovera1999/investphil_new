@extends('layout.main')

@section('content')

@include('include.topbar')

@include('include.messages')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <div class="card mt-3">
                <div class="card-header">
                    <strong>Client Information</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <strong>Full Name:</strong>
                            <p>{{$client->first_name}} {{$client->last_name}}</p>
                            <strong>Age:</strong>
                            <p>{{ $client->age }}</p>
                            <strong>Gender:</strong>
                            <p>{{ $client->gender }}</p>
                        </div>
                        <div class="col">
                            <strong>Email:</strong>
                            <p>{{ $client->email }}</p>
                            <strong>Contact Number:</strong>
                            <p>{{ $client->contact_number }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <strong>{{ $client->last_name . "'s " }} House Owned</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-hover">
                            <div class="ms-1 me-1">
                                <form action="/payments" method="get">
                                    <label for="search">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" value="" />
                                    <button class="btn btn-primary mt-2 mb-2">Search</button>
                                </form>
                            </div>
                            <div class="mt-1 me-1 float-end">
                                {{-- {{ $clients->appends(['search' => session('searchTermClient', '')])->links() }} --}}
                            </div>
                            <thead>
                                <tr>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Middle Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Age</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Contact Number</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
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
                                        @if ($client->is)
                    
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-outline-primary">View Payment Transactions</a>
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