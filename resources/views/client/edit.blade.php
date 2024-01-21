@extends('layout.main')

@section('content')

<title>Edit Client</title>

@include('include.topbar')
@include('include.navbar')

<div class="container">
    <form action="#" method="post" class="col-sm-8 mx-auto mt-5">
        <div class="row">
            <div class="col">
                <div class="mt-3 mb-3">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" />
                </div>
                <div class="mb-3">
                    <label for="first_name">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" />
                </div>
                <div class="mb-3">
                    <label for="first_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" />
                </div>
                <div class="mb-3">
                    <label for="age">Age</label>
                    <input type="text" class="form-control" id="age" name="age" />
                </div>
            </div>
            <div class="col">
                <div class="mt-3 mb-3">
                    <label for="gender">Gender</label>
                    <input type="text" class="form-control" id="gender" name="gender" />
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" />
                </div>
                <div class="mb-3">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" />
                </div>
                <div class="mb-3">
                    <label for="role">User Role</label>
                    <input type="text" class="form-control" id="role" name="role" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="#" class="btn btn-secondary mt-3 w-100">Back</a>
            </div>
            <div class="col">
                <a href="#" class="btn btn-primary mt-3 w-100">Save</a>
            </div>
        </div>
    </form>
</div>

@endsection