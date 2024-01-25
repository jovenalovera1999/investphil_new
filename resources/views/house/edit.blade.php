@extends('layout.main')

@section('content')

<title>PHIINVEST | Edit House</title>

@include('include.topbar')

@include('include.messages')

<div class="container">
    <div class="row">
        
        <div class="col-sm-2">
            @include('include.navbar')
        </div>
        <div class="col-sm-10">
            <form action="/update_house/{{ $house->house_id }}" method="post">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        House Form
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-1">
                            <label class="control-label">House No</label>
                            <input type="text" class="form-control" name="house_no" value="{{ old('house_no', $house->house_no) }}" />
                            @error('house_no') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="category_id" class="control-label">Category</label>
                            <select name="category_id" id="category_id" class="form-select">
                                <option value="">Please check the category list.</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->category_id }}">{{ $category->category }}</option>
                                @endforeach
                                <option value="{{ $house->category_id }}" selected hidden>{{ $house->category }}</option>
                                @if (old('category_id'))
                                    @foreach ($categories as $category)
                                        @if ($category->category_id == old('category_id'))
                                            <option value="{{ $category->category_id }}" selected hidden>{{ $category->category }}</option>
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('category_id') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label for="description" class="control-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="4"
                                class="form-control">{{ old('description', $house->description) }}</textarea>
                            @error('description') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group mb-1">
                            <label class="control-label">Price</label>
                            <input type="text" class="form-control text-right" name="price" value="{{ old('price', $house->price) }}" />
                            @error('price') <p class="text-danger fs-6">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3" name="add_house">
                                    Save</button>
                                <a href="/houses" class="btn btn-sm btn-default col-sm-3"> Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection