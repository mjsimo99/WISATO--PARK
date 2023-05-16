@extends('layouts.app')
@section('title', ' - Unauthorized')

@section('content')
<div class="container-fluid vh-100">
    <div class="align-content-center bg-light h-100 justify-content-center row">
        <div class="col-lg-6">
            <h4>{{ (isset($error)) ? $error : 'This action is unauthorized.' }}</h4>
        </div>
    </div>
</div>
@endsection
