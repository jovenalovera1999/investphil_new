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
            <h2 class="mt-5">House Owned</h2>
            <table class="table">
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-text">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <strong>House No.:</strong> {{ $payment->house_no }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>House Model:</strong> {{ $payment->category }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Total Assessment:</strong> {{ $payment->price }}
                                                        </div>
                                                        <div class="mb-3">
                                                            <strong>Downpayment:</strong> {{ $payment->downpayment }}
                                                        </div>
                                                        {{-- <div class="mb-3">
                                                            <strong>Total Payment Made:</strong> {{ $totalPaymentMade }}
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{-- <div class="btn-group mt-5 ms-5" role="group" aria-label="Basic example">
                                                            <a href="#" class="btn btn-outline-primary">View</a>
                                                            <a href="#" class="btn btn-outline-warning">Edit</a>
                                                            <a href="#" class="btn btn-outline-danger">Delete</a>
                                                        </div> --}}
                                                        <table class="table">
                                                            <thead>
                                                                <th>Monthly Paid</th>
                                                                <th>Date Transacted</th>
                                                            </thead>
                                                            <tbody>
                                                                <td>
                                                                    {{ $payment->monthly_paid }}
                                                                </td>
                                                                <td>
                                                                    {{ $payment->created_at }}
                                                                </td>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection