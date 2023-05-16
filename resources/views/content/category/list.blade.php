@extends('layouts.app')
@section('title', ' - All Category')
@section('content')
<div class="container-fluid mb100">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('All Category') }}
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('category.create') }}"> Create new</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-borderd table-condenced w-100" id="categoryDatatable">
                          
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@push('scripts')
<script src="{{ asset('js/custom/settings/category.js') }}"></script>
@endpush