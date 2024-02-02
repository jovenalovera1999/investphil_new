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
            <h2 class="mt-5">House Owned</h2>
            <div class="table-responsive">
                <table class="table">
                    <div class="float-end mt-1 me-1">
                        {{ $houses->links() }}
                    </div>
                    <thead>
                        <th class="text-center">House No.</th>
                        <th class="text-center">House Model</th>
                        <th class="text-center">Total Assessment</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($houses as $house)
                            <tr>
                                <td>{{ $house->house_no }}</td>
                                <td>{{ $house->category }}</td>
                                <td>{{ $house->price }}</td>
                                <td><a href="/dashboard/view/monthly_payment/{{ $house->client_house_id }}" class="btn btn-outline-primary">View Monthly Paid</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection