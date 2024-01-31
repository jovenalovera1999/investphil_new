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
                    <b>List of Clients</b>
                    <span>
                        <a class="btn btn-primary btn-block btn-sm col-sm-2 float-end" href="/client/create" id="new_client">
                            <i class="fa fa-plus"></i> New Payment Transaction
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    @include('include.messages')
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-hover">
                            <div class="ms-1 me-1">
                                <form action="/payments" method="get">
                                    <label for="search">Search</label>
                                    <input type="text" class="form-control" id="search" name="search"
                                        value="{{ session('searchTermClientPayment', '') }}" />
                                </form>
                            </div>
                            <div class="mt-1 me-1 float-end">
                                {{ $clients->appends(['search' => session('searchTermClientPayment', '')])->links() }}
                            </div>
                            <thead>
                                <tr>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Middle Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Contact Number</th>
                                    <th class="text-center">House Number</th>
                                    <th class="text-center">House Model</th>
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
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->contact_number }}</td>
                                    <td>{{ $client->house_no }}</td>
                                    <td>{{ $client->category }}</td>
                                    @if ($client->is_full_paid == 0)
                                        <td style="background-color: red; color:white;">Not Fully Paid</td>
                                    @else
                                        <td style="background-color: green; color:white;">Fully Paid</td>
                                    @endif
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