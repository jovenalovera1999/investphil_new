@php
use App\Models\Payment;
@endphp

@extends('layout.main')

@section('content')

<title>PHILINVEST | Client Dashboard</title>

<style>
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        top: 0;
    }

    .imgs {
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }

    .imgs img {
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }

    #imagesCarousel,
    #imagesCarousel .carousel-inner,
    #imagesCarousel .carousel-item {
        height: 60vh !important;
        background: black;
    }

    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
    }

    #imagesCarousel img {
        width: auto !important;
        height: auto !important;
        max-height: calc(100%) !important;
        max-width: calc(100%) !important;
    }
</style>

@include('include.topbar')

@include('include.messages')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-7">
            <h2 class="mt-5">Monthly Payment Made</h2>
            <div class="table-responsive">
                <table class="table">
                    <div class="float-end mt-1 me-1">
                    </div>
                    <thead>
                        <th class="text-center">Invoices</th>
                        <th class="text-center">Monthly Paid</th>
                        <th class="text-center">Date Transacted</th>
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
            <strong class="mt-3">Total Assessment:</strong>
            <p>{{ $house->price }}</p>
            <strong class="mt-3">Downpayment:</strong>
            @if(empty($downpayment->first()->downpayment))
                <p>0.00</p>
            @else
                <p>{{ $downpayment->first()->downpayment }}</p>
            @endif
            <strong class="mt-3">Total Payment Made:</strong>
            <p>{{ $totalPaymentMade }}</p>
        </div>
    </div>
</div>

@endsection