@extends('layout.main')

@section('content')

<title>PHILINVEST | List of Categories</title>

@include('include.topbar')

@include('include.messages')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-lg-10">
            <div class="row">
                <!-- FORM Panel -->
                <div class="col-md-4">
                    <form action="/store_category" method="post" class="mt-5">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                Category Form
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="id">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="category">
                                </div>
                            </div>
        
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="save">
                                            Save</button>
                                        <button class="btn btn-sm btn-default col-sm-3" type="button"> Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- FORM Panel -->
        
                <!-- Table Panel -->
                <div class="col-md-8">
                    <div class="card mt-5">
                        <div class="card-header">
                            <b>Category List</b>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                {{ $category->category }}
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="/category/edit/{{ $category->category_id }}" class="btn btn-outline-warning">Edit</a>
                                                    <a href="#" class="btn btn-outline-danger">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Table Panel -->
            </div>
        </div>
    </div>
</div>

@endsection