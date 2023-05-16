@extends('layouts.app')
@section('title', ' - Parking Slot List')
@section('content')
<div class="container-fluid mb100">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Parking Slot List') }}
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('parking_settings.create') }}">Create new</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="parkingSlotDatatable" class="table table-borderd table-condenced w-100">

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/custom/settings/parking_setting.js') }}"></script>
@endpush