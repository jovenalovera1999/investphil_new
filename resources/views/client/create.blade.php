@extends('layout.main')

@section('content')

@include('include.topbar')

<title>PHILINVEST | Create New Client</title>

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <form action="/store_client" method="post">
                @csrf
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title">Client Personal Information</h5>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" />
                                    @error('first_name') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="first_name">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="first_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" />
                                    @error('last_name') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" id="age" name="age" value="{{ old('age') }}" />
                                    @error('age') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gender_id">Gender</label>
                                    <select class="form-select" aria-label="role" id="gender_id" name="gender_id">
                                        <option value="" selected>Select gender</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                                        @endforeach
                                        @if(old('gender_id'))
                                            @foreach ($genders as $gender)
                                                @if($gender->gender_id == old('gender_id'))
                                                    <option value="{{ $gender->gender_id }}" selected hidden>{{ $gender->gender }}</option>
                                                    @break
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('gender_id') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                                    @error('email') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" />
                                    @error('contact_number') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" />
                                    @error('username') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                    @error('password') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                                    @error('password_confirmation') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">House to Owned</h5>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="payment_method_id">Payment Method</label>
                                    <select class="form-select" aria-label="role" id="payment_method_id" name="payment_method_id">
                                        <option value="" selected>Select payment method</option>
                                        @foreach ($paymentMethods as $paymentMethod)
                                            <option value="{{ $paymentMethod->payment_method_id }}">{{ $paymentMethod->payment_method }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p id="payment_method_validation" class="text-danger fs-6"></p>
                                    <label for="house_id">House</label>
                                    <select class="form-select" aria-label="role" id="house_id" name="house_id">
                                        <option value="" selected>Select house</option>
                                        @foreach ($houses as $house)
                                            <option value="{{ $house->house_id }}">{{'House No: ' . $house->house_no . ', House Type: ' . $house->category }}</option>
                                        @endforeach
                                    </select>
                                    <p id="house_validation" class="text-danger fs-6"></p>
                                </div>
                                <div class="mb-3">
                                    <label for="downpayment">Downpayment</label>
                                    <input type="text" class="form-control" id="downpayment" name="downpayment" />
                                    <p id="downpayment_validation" class="text-danger fs-6"></p>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addHouseToOwned()">Add House</button>
                            </div>
                            <div class="col">
                                <div class="table-resonsive" id="house_to_owned">
                                    <table class="table" id="table_house_to_owned">
                                        <thead>
                                            <th>Payment Method</th>
                                            <th>House No. and Model</th>
                                            <th>Downpayment</th>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/clients" class="btn btn-secondary mt-3 w-100">Back</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary mt-3 w-100">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection