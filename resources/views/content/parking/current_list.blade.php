@extends('layouts.app')
@section('title', ' - All Parking')
@section('content')
<div class="container-fluid mb100">
    <div class="row customEqual">
        <div class="col-sm-12 col-md-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <h5>Total Parking Space</h5>
                </div>
                <div class="card-body">
                    <h1>{{ $total_slots }}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <h5>Total Booked</h5>
                </div>
                <div class="card-body">
                    <h1>{{ $currently_parking }}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <h5>Total Available</h5>
                </div>
                <div class="card-body">
                    <h1>{{$total_slots - $currently_parking}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 mb-2">
            <div class="card customEqualEl">
                <div class="card-header">{{ __('Quick Checkout') }}</div>
                <div class="card-body">
                    <form action="{{route('parking.quick_end')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="text" name="barcode" id="barcode" class="form-control" tabindex="1" placeholder="Barcode" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <input value="Find" class="btn btn-outline-info" type="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Currenlty Parking') }}</div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-borderd table-condenced w-100 f12" id="parkingDatatableCurrent">
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