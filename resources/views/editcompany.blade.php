@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="custom-card-header center">{{ __('Edit Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('companies.update', $company->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="row mt-4">
                            <div class="form-group col-md-6">
                                <label for="edit-company-name" class="mb-2 control-label">{{ __('Name') }}</label>
                                <input type="text" class="form-control" name="edit-company-name" id="edit-company-name" value="{{ $company->name }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit-company-email" class="mb-2 control-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control" name="edit-company-email" id="edit-company-email" value="{{ $company->email }}" required>
                            </div>
                        </div>

                        <div class="row mt-4 mb-5">
                            <div class="form-group col-md-6">
                                <label for="edit-company-website" class="mb-2">{{ __('Website') }}</label>
                                <input type="text" class="form-control" name="edit-company-website" id="edit-company-website" value="{{ $company->website }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="edit-company-logo" class="mb-2">{{ __('Logo') }}</label>
                                <input type="file" class="form-control" name="edit-company-logo" id="edit-company-logo">
                            </div>
                            @if($company->logo)
                            <div class="form-group col-md-3">
                                @php $company->logo = str_replace('public/', '', $company->logo); @endphp
                                <img src="/storage/{{ $company->logo }}" alt="company logo" width="50px" height="50px" />
                            </div>
                            @endif
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