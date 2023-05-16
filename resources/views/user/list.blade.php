@extends('layouts.app')
@section('title', ' - User List')
@section('content')
<div class="container-fluid mb100">
   
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('User List') }}
                    <a class="btn btn-sm btn-info pull-right" href="{{ route('user.create') }}">Create
                        new</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userDataTable" class="table table-borderd table-condenced w-100">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('js/user.js')}}"></script>
@endpush