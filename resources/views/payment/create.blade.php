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
            
        </div>
    </div>
</div>

@endsection