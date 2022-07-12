@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="custom-card-header center">{{ __('Edit Employee') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row mt-4">
                            <div class="form-group col-md-6">
                                <label for="edit-first-name" class="mb-2 control-label">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" name="edit-first-name" id="edit-first-name" value="{{ $employee->first_name }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit-last-name" class="mb-2 control-label">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" name="edit-last-name" id="edit-last-name" value="{{ $employee->last_name }}" required>
                            </div>
                        </div>

                        <div class="row mt-4 mb-5">
                            <div class="form-group col-md-6">
                                <label for="edit-employee-email" class="mb-2">{{ __('Email') }}</label>
                                <input type="text" class="form-control" name="edit-employee-email" id="edit-employee-email" value="{{ $employee->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit-phone" class="mb-2">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="edit-phone" id="edit-phone" value="{{ $employee->phone }}">
                            </div>
                        </div>
                        <input type="hidden" name="companyid" id="companyid" value="{{ $employee->company_id }}">

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