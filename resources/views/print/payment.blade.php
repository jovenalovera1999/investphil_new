<!-- Main HTML -->
@extends('layout.main')

<!-- HTML content -->
@section('content')

<!-- Tab title -->
<title>PHILINVEST | Print Payment</title>

    <!-- Title and sub title -->
    <h2 class="mt-3 text-center">PAYMENT REPORT</h2>
    <p class="text-center">As of <u><strong>{{ $currentDate }}</strong></u></p>
    <div class="row mt-3">
        <!-- Client Information -->
        <div class="col">
            <p class="text-center"><strong>Client Name: </strong><u>{{ $client->first_name }} {{ $client->middle_name }} {{ $client->last_name }}</u></p>
        </div>
        <div class="col">
            <p class="text-center"><strong>House No.: </strong><u>{{ $client->house_no }}</u></p>
        </div>
        <div class="col">
            <p class="text-center"><strong>House Model: </strong><u>{{ $client->category }}</u></p>
        </div>
    </div>
    <div class="col-sm-6 mx-auto">
        <!-- Table responsive -->
        <div class="table-responsive mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Invoices</th>
                        <th>Monthly Paid</th>
                        <th>Date Transacted</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthlyPayments as $monthlyPayment)
                        <tr>
                            <td>{{ $monthlyPayment->invoices }}</td>
                            @if (doubleval($monthlyPayment->monthly_paid) == 0)
                                <td><strong><i>Downpayment</i></strong></td>
                            @else
                                <td>{{ $monthlyPayment->monthly_paid }}</td>
                            @endif
                            <td>{{ $monthlyPayment->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Total assessment, downpayment and payment made -->
        <p><strong class="mt-3">Total Assessment:</strong> {{ $client->price }}</p>
        @if(empty($downpayment->first()->downpayment))
            <p><strong class="mt-3">Downpayment:</strong> 0.00</p>
        @else
            <p><strong class="mt-3">Downpayment:</strong> {{ $downpayment->first()->downpayment }}</p>
        @endif
        <p><strong class="mt-3">Total Payment Made:</strong> {{ $totalPaymentMade }}</p>
    </div>

<!-- JS window print -->
<script>
    // Function to handle the print event
    function handlePrint() {
        // Print the page
        window.print();

        // Add an event listener to detect when the print dialog is closed
        window.addEventListener('afterprint', function(event){
            // Go back to the previous page
            window.history.back();
        });
    }

    // Call the handlePrint function when the window loads
    window.onload = function() {
        handlePrint();
    };
</script>

@endsection