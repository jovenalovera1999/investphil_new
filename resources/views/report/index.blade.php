@extends('layout.main')

@section('content')

<!-- Tab title -->
<title>PHILINVEST | Report Payments</title>

<!-- Topbar -->
@include('include.topbar')

<div class="container">
    <div class="row">
        <!-- Column one -->
        <div class="col-sm-2">
            <!-- Navbar -->
            @include('include.navbar')
        </div>
        <!-- Column two -->
        <div class="col-sm-10">
            <!-- Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">Payment Report</h5>
                    <!-- Form -->
                    <form action="/report/payments" method="get" name="report_payment_form_search">
                        <!-- Search client field -->
                        <div class="mb-3 col-sm-4">
                            <label for="search">Search Client</label>
                            <input type="text" class="form-control col-12 col-sm-4" id="search" name="search" />
                        </div>
                    </form>
                    <!-- Table responsive and hover -->
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <div class="mt-1 me-1">
                                {{ $clients->links() }}
                            </div>
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th>House No.</th>
                                    <th>House Model</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Show all clients along with their houses and payments of each house -->
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $client->last_name . ', ' }} {{ $client->first_name }} {{ $client->middle_name }}</td>
                                        <td>{{ $client->house_no }}</td>
                                        <td>{{ $client->category }}</td>
                                        <td><a href="/report/payment/show/{{ $client->client_house_id }}" class="btn btn-primary">View</a></td>
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