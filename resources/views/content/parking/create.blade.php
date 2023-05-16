@extends('layouts.app')
@section('title', ' - Add Parking')
@push('css')
<link rel="stylesheet" href="{{ asset('css/custom/parking.css') }}">
@endpush
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
                <div class="card-body p-2">
                    <form action="{{route('parking.quick_end')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" name="barcode" id="barcode" class="form-control" tabindex="1"
                                    placeholder="Barcode" autocomplete="off">
                            </div>
                            <div class="col-md-12">
                                <input value="Find" class="btn btn-sm btn-outline-info pull-right mt-2" type="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Add Parking') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('parking.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-1">
                                            <label for="vehicle_no" class="col-form-label text-md-right"><span
                                                    class="tcr i-req">*</span> {{
                                                __('Vehicle No') }}</label>
                                            <input id="vehicle_no" type="text"
                                                class="form-control {{ $errors->has('vehicle_no') ? ' is-invalid' : '' }}"
                                                name="vehicle_no" value="{{ old('vehicle_no') }}" autocomplete="off"
                                                required>

                                            @if ($errors->has('vehicle_no'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('vehicle_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-1">
                                            <label for="category_id"
                                                class="col-md-4 col-form-label col-form-label text-md-right"><span
                                                    class="tcr i-req">*</span> {{ __('Type')
                                                }}</label>
                                            <select name="category_id" id="category_id"
                                                class="select2 form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                                required>
                                                <?php
                                                foreach ($categories as $key => $value) {
                                                    echo '<option value="'.$value->id.'" '.((old('category_id') == $value->id) ? ' selected' : '').'>'.$value->type.'</option>';
                                                }
                                                ?>
                                            </select>

                                            @if ($errors->has('category_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-1">
                                            <label for="driver_name" class="col-form-label text-md-right"> {{ __('Driver
                                                Name')
                                                }}</label>
                                        </div>
                                        <input id="driver_name" type="text"
                                            class="form-control {{ $errors->has('driver_name') ? ' is-invalid' : '' }}"
                                            name="driver_name" value="{{ old('driver_name') }}" autocomplete="off">

                                        @if ($errors->has('driver_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('driver_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="driver_mobile" class="col-form-label text-md-right"> {{
                                                __('Driver
                                                Mobile') }}</label>
                                            <input id="driver_mobile" type="number"
                                                class="form-control {{ $errors->has('driver_mobile') ? ' is-invalid' : '' }}"
                                                name="driver_mobile" value="{{ old('driver_mobile') }}"
                                                autocomplete="off">

                                            @if ($errors->has('driver_mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('driver_mobile') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 parkingUI">
                                <div class="plane">
                                    <div class="cockpit">
                                        <h3>Please select a slot</h3>
                                    </div>
                                    @if ($errors->has('slot_id'))
                                    <div class="d-none flashMessage">
                                        <div id="msgType">warning</div>
                                        <div id="msg">{{ $errors->first('slot_id') }}</div>
                                    </div>
                                    @endif
                                    <div id="slotSection">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Save') }}
                                    </button>
                                    <button type="reset" class="btn btn-secondary" id="frmClear">
                                        {{ __('Clear') }}
                                    </button>
                                </div>
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
                <div class="card-header">{{ __('All Parking') }}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderd table-condenced w-100 f12" id="parkingDatatable">
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