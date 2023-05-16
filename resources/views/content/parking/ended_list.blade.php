@extends('layouts.app')
@section('title', ' - All Parking')
@section('content')
<div class="container-fluid mb100">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ended Parking') }}</div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-borderd table-condenced w-100 f12" id="parkingDatatableEnded">
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 

@endsection
@push('scripts')
    <script src="{{ asset('js/custom/settings/parking.js') }}"></script>
@endpush