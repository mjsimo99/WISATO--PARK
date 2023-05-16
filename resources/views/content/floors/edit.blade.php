@extends('layouts.app')
@section('title', ' - Edit Floor')
@section('content')
<div class="container-fluid mb100">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Floor') }}
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('floors.index') }}">Floor List</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('floors.update',['floor' => $floor->id]) }}">
                        @csrf   
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="text-md-right">{{ __('Name') }} <span class="tcr text-danger">*</span></label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                        value="{{ (old('name')) ?? $floor->name }}" autocomplete="off" required autofocus>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="level" class="text-md-right">{{ __('Floor Level') }}</label>
                                    <select name="level" id="level" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}" required>
                                        @for ($i = 0; $i <= 12; $i++ ) <option value="{{ $i }}" {{ (old('level', $floor->level)==$i ) ? ' selected' : '' }}>{{ $i
                                            }}</option>
                                            @endfor
                                    </select>
                            
                                    @if ($errors->has('level'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="text-md-right">{{ __('Remarks') }}</label>
                                    <textarea name="remarks" id="remarks" class="form-control{{ $errors->has('remarks') ? ' is-invalid' : '' }}"
                                        rows="2">{{ (old('remarks')) ?? $floor->remarks }}</textarea>
                                    @if ($errors->has('remarks'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('remarks') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <div class="pull-right d-flex justify-content-end">
                                    <button type="reset" class="btn btn-secondary me-2" id="frmClear">
                                        {{ __('Clear') }}
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection