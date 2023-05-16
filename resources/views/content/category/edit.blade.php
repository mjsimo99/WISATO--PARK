@extends('layouts.app')
@section('title', ' - Edit Category')
@section('content')
<div class="container-fluid mb100">

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Category') }}
                    <a class="btn btn-sm btn-primary pull-right" href="{{ route('category.index') }}">Category List</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.update', ['category' => $category->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="type" class="col-md-2 col-form-label text-md-right"> {{ __('Type') }} <span class="tcr i-req">*</span></label>

                            <div class="col-md-4">
                                <input id="type" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') ?? $category->type }}" autocomplete="off" required>

                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label for="status" class="col-md-2 col-form-label text-md-right">{{ __('Status') }} <span class="tcr i-req">*</span></label>

                            <div class="col-md-4">

                                <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                    <option value="1" {{ ($category->status == 1) ? ' selected' : '' }}>Enable</option>
                                    <option value="0" {{ ($category->status == '0') ? ' selected' : '' }}>Disable</option>
                                </select>


                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }} <span class="tcr i-req">*</span> </label>

                            <div class="col-md-10">

                                <textarea name="description" id="description" cols="5" rows="5" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{ old('description') ?? $category->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0 d-flex justify-content-end">

                            <div class="col-md-4 d-flex justify-content-end">
                                <button type="reset" class="btn btn-secondary me-2" id="frmClear">
                                    {{ __('Clear') }}
                                </button>
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
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