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
                    <strong>List of Clients</strong>
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
                                    <th class="text-center">House Number</th>
                                    <th class="text-center">House Model</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                <tr>
                                    <td style="width: 14%">{{ $client->first_name }}</td>
                                    <td style="width: 14%">{{ $client->middle_name }}</td>
                                    <td style="width: 14%">{{ $client->last_name }}</td>
                                    <td style="width: 14%">{{ $client->house_no }}</td>
                                    <td style="width: 14%">{{ $client->category }}</td>
                                    @if ($client->is_full_paid == false)
                                        <td class="status" style="width: 14%"><span class="waiting">Not Fully Paid</span></td>
                                    @else
                                        <td class="status" style="width: 14%"><span class="active">Fully Paid</span></td>
                                    @endif
                                    <td style="width: 14%">
                                        <div class="btn-group" role="group">
                                            <a href="/payment/view/monthly_payment/{{ $client->client_house_id }}"
                                                class="btn btn-outline-primary">View Monthly Payment</a>
                                            <a href="/payment/create/client_house/{{ $client->client_house_id }}" class="btn btn-outline-primary">Add New Transaction</a>
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