@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="custom-card-header center">{{ __('Enter Employee') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('employees.store') }}" method="POST">
                    @csrf
                        <div class="row mt-4">
                            <div class="form-group col-md-6">
                                <label for="first-name" class="mb-2 control-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" name="first-name" id="first-name" placeholder="{{ __('Enter First Name...') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last-name" class="mb-2 control-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" name="last-name" id="last-name" placeholder="{{ __('Enter Last Name...') }}" required>
                            </div>
                        </div>

                        <div class="row mt-4 mb-5">
                            <div class="form-group col-md-6">
                                <label for="employee-email" class="mb-2">{{ __('Email') }}</label>
                                <input type="text" class="form-control" name="employee-email" id="employee-email" placeholder="{{ __('Enter Email...') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="mb-2">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('Enter Phone...') }}">
                            </div>
                        </div>
                        <input type="hidden" name="company-id" id="company-id" value="{{ $id }}">

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