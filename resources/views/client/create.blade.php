@extends('layout.main')

@section('content')

@include('include.topbar')
@include('include.navbar')

<title>New Client</title>

<div class="container">
    <div class="row">
        <div class="col-sm-9 mx-auto">
            <form action="#" method="post">
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
                        <div class="mb-3">
                            <label for="user_role">Gender</label>
                            <select class="form-select" aria-label="role" id="gender_id" name="gender_id">
                                <option selected>Select gender</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mt-3 mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" />
                        </div>
                        <div class="mb-3">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" />
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" />
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" />
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="list.php" class="btn btn-secondary mt-3 w-100">Back</a>
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