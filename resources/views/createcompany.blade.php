@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="custom-card-header center">{{ __('Enter Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row mt-4">
                            <div class="form-group col-md-6">
                                <label for="company-name" class="mb-2 control-label">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="company-name" id="company-name" placeholder="{{ __('Enter name...') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company-email" class="mb-2 control-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control" name="company-email" id="company-email" placeholder="{{ __('Enter email...') }}" required>
                            </div>
                        </div>

                        <div class="row mt-4 mb-5">
                            <div class="form-group col-md-6">
                                <label for="company-website" class="mb-2">{{ __('Website') }}</label>
                                <input type="text" class="form-control" name="company-website" id="company-website" placeholder="{{ __('Enter website...') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company-logo" class="mb-2">{{ __('Logo') }}</label>
                                <input type="file" class="form-control" name="company-logo" id="company-logo" accept=".jpg,.jpeg,.bmp,.png,.svg">
                            </div>
                        </div>

                        <div class="mb-4 mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>

                    </form>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger small">{{$error}}</div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection