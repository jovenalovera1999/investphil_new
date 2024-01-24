@extends('layout.main')

@section('content')

@include('include.topbar')

<style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: flex;
        padding: flex;
        line-height: 2em;
    }
</style>

@include('include.messages')

<div class="container">
    <div class="row">
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-4">
            <div class="mt-5 ms-1 me-1">
                <form action="/houses" method="get">
                    <label for="search">Search</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ session('searchTerm', '') }}" />
                    <button class="btn btn-primary mt-2 mb-3">Search</button>
                </form>
            </div>
            <form action="/store_house" method="post">
                @csrf
                <div class="card">
                    <div class="card-header">
                        House Form
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-1">
                            <label class="control-label">House No</label>
                            <input type="text" class="form-control" name="house_no" value="{{ old('house_no') }}" />
                            @error('house_no') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="category_id" class="control-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="" selected>Please check the category list.</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category }}</option>
                                @endforeach
                                @if (old('category_id'))
                                    @foreach ($categories as $category)
                                        @if ($category->category_id == old('category_id'))
                                            <option value="{{ $category->category_id }}" selected>$category->category</option>
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="description" class="control-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control">{{ old('description') }}</textarea>
                            @error('description') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label class="control-label">Price</label>
                            <input type="text" class="form-control text-right" name="price" value="{{ old('price') }}" />
                            @error('price') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="add_house">
                                    Save</button>
                                <button class="btn btn-sm btn-default col-sm-3" type="reset"> Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-5">
            <table class="table table-bordered table-hover mt-5">
                <div class="float-end mt-3">
                    {{ $houses->appends(['search' => session('searchTerm', '')])->links() }}
                </div>
                <thead>
                    <tr>
                        <th class="text-center">House</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($houses as $house)    
                    <tr>
                        <td>
                            House No:
                            {{ $house->house_no }}
                            <br><br>
                            House Type:
                            {{ $house->category }}
                            <br><br>
                            Description:
                            {{ $house->description }}
                            <br><br>
                            Price:
                            {{ $house->price }}
                        </td>
                        <td>
                            <div class="btn-group" role="" group>
                                <a href="#" class="btn btn-outline-warning">Edit</a>
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

@endsection