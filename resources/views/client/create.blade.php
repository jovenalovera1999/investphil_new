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
            <form action="/store_client" method="post" class="mt-5">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="mt-3 mb-3">
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
                            <label for="user_role">Gender</label>
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
                        <div class="mt-3 mb-3">
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
                <div class="row">
                    <div class="col">
                        <a href="/clients" class="btn btn-secondary mt-3 w-100">Back</a>
                    </div>
                    <div class="col">
                        <form action="#" method="post">
                            <button type="submit" class="btn btn-primary mt-3 w-100">Save</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection