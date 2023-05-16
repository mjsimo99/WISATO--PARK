@extends('layouts.app')
@section('title', ' - Settings')
@section('content')
<div class="container-fluid mb100">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">General Setting</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Site Title</label>
                                    <input type="text" name="site_title" class="form-control"
                                        value="{{ old('site_title') ? old('site_title') : $settings->site_title }}">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Login Image <small class="font-italic text-info">(1366X768 | 1000kb)</small></label>
                                    <input type="file" name="login_image" class="form-control">
                                    @if($settings->login_image != NULL && public_path($settings->login_image) &&
                                    !is_dir($settings->login_image))
                                    <span>Existing: <a target="_blank" href="{{ asset($settings->login_image) }}">View</a></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Logo <small class="font-italic text-info">(150X50 | 500kb)</small></label>
                                    <input type="file" name="logo" class="form-control">
                                    @if($settings->logo != NULL && public_path($settings->logo) &&
                                    !is_dir($settings->logo))
                                    <span>Existing: <a target="_blank" href="{{ asset($settings->logo) }}">View</a></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Favicon <small class="font-italic text-info">(64X64 | 50kb)</small></label>
                                    <input type="file" name="favicon" class="form-control">
                                    @if($settings->favicon != NULL && public_path($settings->favicon) &&
                                    !is_dir($settings->favicon))
                                    <span>Existing: <a target="_blank" href="{{ asset($settings->favicon) }}">View</a></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success pull-right" type="submit">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection