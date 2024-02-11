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
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="card-title mb-4">Payment Transaction</h5>
                    <form action="/store_payment/{{ $clientHouse->client_house_id }}" method="post">
                        @csrf
                        <p><strong>Client Name:</strong> {{ (!empty($clientHouse->middle_name)) ? $clientHouse->last_name . ', ' . 
                            $clientHouse->first_name . ' ' . $clientHouse->middle_name[0] . '.' : $clientHouse->last_name . 
                            ', ' . $clientHouse->first_name }}</p>
                        <p><strong>House No.:</strong> {{ $clientHouse->house_no }}</p>
                        <p><strong>House Model:</strong> {{ $clientHouse->category }}</p>
                        <p><strong>House Price:</strong> {{ $clientHouse->price }}</p>
                        <p><strong>Downpayment:</strong> {{ $downpayment }}</p>
                        <input type="hidden" name="already_have_downpayment" value="{{ $downpayment }}">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="invoices">Invoices</label>
                                    <input type="text" class="form-control" id="invoices" name="invoices"
                                        value="{{ old('invoices', mt_rand(10000000, 99999999)) }}" readonly />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label for="payment_method_id">Payment Method</label>
                                    <select class="form-select" aria-label="role" id="payment_method_id" name="payment_method_id">
                                        <option value="" selected>Select payment method</option>
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->payment_method_id }}">{{ $paymentMethod->payment_method }}</option>
                                        @endforeach
                                        @if(old('payment_method_id'))
                                            @foreach ($paymentMethods as $paymentMethod)
                                                @if($paymentMethod->payment_method_id == old('payment_method_id'))
                                                    <option value="{{ $paymentMethod->payment_method_id }}" selected hidden>{{ $paymentMethod->payment_method }}</option>
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('payment_method_id') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="mb-1">
                                    <label for="amount_to_pay">Amount to Pay</label>
                                    <input type="text" class="form-control" id="amount_to_pay" name="amount_to_pay" value="{{ old('amount_to_pay') }}" />
                                    @error('amount_to_pay') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="is_downpayment" id="is_downpayment" 
                                        value="1" {{ old('is_downpayment') ? 'checked' : '' }}>
                                    <label for="is_downpayment" class="form-check-label">Downpayment?</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <div class="col-sm-3 me-1">
                                    <a href="/payments" class="btn btn-secondary mt-auto p-2 w-100">Back</a>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary mt-auto p-2 w-100">Save Payment Transaction</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection