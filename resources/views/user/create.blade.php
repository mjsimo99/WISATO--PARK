@extends('layouts.app')
@section('title', ' - Create New User')
@section('content')
<div class="container-fluid mb100">
   
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Create User') }}
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('user.list') }}">User List</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right"> {{ __('Name') }}<span class="tcr i-req">*</span></label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autocomplete="off" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right"> {{ __('E-Mail Address') }}<span class="tcr i-req">*</span></label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autocomplete="off" required>

                                <span class="form-text text-muted">
                                    This email will be used as your login email.
                                </span>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-3 col-form-label text-md-right"> {{ __('Role') }}<span class="tcr i-req">*</span></label>

                            <div class="col-md-9">                                
                                <select id="role" name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" required>       
                                    @foreach($roles as $role)                                    
                                        <option value="{{$role->id}}" @if(old('role') == $role->id) {{ ' selected' }}  @endif>{{ucfirst($role->name)}}</option>
                                    @endforeach                                    
                                </select>

                                <input type="hidden" name="required_role" value="true">
                                
                                @if ($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right"> {{ __('Password') }}<span class="tcr i-req">*</span></label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                
                                <input type="hidden" name="required_password" value="true">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="tcr i-req">*</span></label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex justify-content-end">
                            <div class="col-md-7 offset-md-3 d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary me-2" id="frmClear">
                                    {{ __('Clear') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection