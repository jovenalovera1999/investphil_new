@extends('layout.main')

@section('content')

<title>PHILINVEST | Edit Category</title>

@include('include.topbar')

@include('include.messages')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <!-- FORM Panel -->
            <div class="col-sm-4 mx-auto">
                <form action="/update_category/{{ $category->category_id }}" method="post" class="mt-5">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Category Form
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="category" value="{{ $category->category }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="save">
                                        Save</button>
                                    <a href="/categories" class="btn btn-sm btn-default col-sm-3"> Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- FORM Panel -->
        </div>
    </div>
</div>
    
@endsection