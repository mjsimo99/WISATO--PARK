@extends('layouts.app')
@section('title', ' - Add Parking')
@section('content')

<div class="container-fluid mb100">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Filter for report') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('reports.index') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="from_date" class="col-md-5 col-form-label "> {{ __('From Date') }} :</label>

                                    <div class="col-md-7">
                                        <input id="from_date" type="text" class="form-control dateTimePicker" name="from_date" value="{{ old('from_date', request()->get('from_date')) }}" autocomplete="off">
                                        @if ($errors->has('from_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>  
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="to_date" class="col-md-5 col-form-label "> {{ __('To Date') }} :</label>

                                    <div class="col-md-7">
                                        <input id="to_date"  type="text" class="form-control dateTimePicker" name="to_date" value="{{ old('to_date', request()->get('to_date')) }}" autocomplete="off">
                                        @if ($errors->has('to_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('to_date') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="category_id" class="col-md-5 col-form-label "> {{ __('Type') }} :</label>

                                    <div class="col-md-7">

                                        <select name="category_id" id="category_id" class="select2 form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" >
                                            <option value="-1">All Type</option>
                                            <?php
                                            foreach ($categories as $key => $value) {
                                                echo '<option'. (old("category_id", request()->get("category_id")) == $value->id ? "selected" : '').' value="'.$value->id.'">'.$value->type.'</option>';
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
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="car_no" class="col-md-5 col-form-label "> {{ __('Vehicle No') }} :</label>

                                    <div class="col-md-7">
                                        <input id="car_no" type="text" class="form-control {{ $errors->has('car_no') ? ' is-invalid' : '' }}" name="car_no" value="{{ old('car_no', request()->get('car_no')) }}" autocomplete="off" >

                                        @if ($errors->has('car_no'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('car_no') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="driver_name" class="col-md-5 col-form-label "> {{ __('Driver Name') }} :</label>

                                    <div class="col-md-7">
                                        <input id="driver_name" type="text" class="form-control {{ $errors->has('driver_name') ? ' is-invalid' : '' }}" name="driver_name" value="{{ old('driver_name', request()->get('driver_name')) }}" autocomplete="off" >

                                        @if ($errors->has('driver_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('driver_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group row">
                                    <label for="driver_mobile" class="col-md-5 col-form-label "> {{ __('Driver Mobile') }} :</label>

                                    <div class="col-md-7">
                                        <input id="driver_mobile" type="number" class="form-control {{ $errors->has('driver_mobile') ? ' is-invalid' : '' }}" name="driver_mobile" value="{{ old('driver_mobile', request()->get('driver_mobile')) }}" autocomplete="off" >

                                        @if ($errors->has('driver_mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('driver_mobile') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>  
                            </div>
                        </div>

                        <div class="form-group row pull-right">

                            <div class="col-md-12">
                                <a class="btn-secondary btn" href="{{route('reports.index')}}" class="btn" id="frmClear">
                                    {{ __('Clear') }}
                                </a>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Filter') }}
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(count($request))
        <div class="col-md-12 mt50">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            {{ __('Report View') }}
                        </div>                
                        <div class="col-6">
                            <form target="_blank" action="{{ route('reports.pdf_report') }}">
                                @csrf
                                @foreach ($request as $key => $value)
                                    <input type="hidden" name="data[{{$key}}]" value="{{ $value }}">
                                @endforeach
                                <button  class="btn btn-primary btn-sm pull-right">Download / Print</button>
                            </form>
                        </div>
                    </div>                    
                </div>

                <div class="card-body">
                    @include('content.reports.pdf_report')
                </div>
            </div>
        </div>
        @endif
    </div>
</div> 
@endsection