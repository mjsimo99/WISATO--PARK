@extends('layouts.app')
@section('title', ' - All Tariff')
@section('content')
<div class="container-fluid mb100">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('All Tariff') }}
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('tariff.create') }}">Create new</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-borderd table-condenced w-100" id="tariffDatatable">
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 

<script src="{{ asset('js/custom/settings/tariff.js') }}"></script>

@endsection