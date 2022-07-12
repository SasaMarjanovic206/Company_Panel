@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="custom-card-header center">{{ __('Company') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container-btn-div">
                        <a href="{{ route('companies.index') }}" role="button" class="btn btn-primary container-btn">{{ __('Companies') }}</a>
                        <a href="{{ route('employees.create', $company->id) }}" role="button" class="btn btn-primary container-btn" id="company-btn">{{ __('Add Employee') }}</a>
                    </div>

                    <div class="container col-md-6 mt-5">
                        <p class="lead text-left d-inline-block company-paragraph">{{ __('Company Name') }}</p><p class="text-center d-inline p-5">{{ $company->name }}</p>
                    </div>
                    <div class="container col-md-6 mt-2">
                        <p class="lead text-left d-inline-block company-paragraph">{{ __('Company Email') }}</p><p class="text-center d-inline p-5">{{ $company->email }}</p>
                    </div>
                    <div class="container col-md-6 mt-2 mb-2">
                        <p class="lead text-left d-inline-block company-paragraph">{{ __('Company Website') }}</p><p class="text-center d-inline p-5">{{ $company->website }}</p>
                    </div>
                    @if($company->logo !== null)
                        @php $company->logo = str_replace('public/', '', $company->logo); @endphp
                        <div class="container col-md-6 mb-5">
                            <p class="lead text-left d-inline-block company-paragraph">{{ __('Company Logo') }}</p><p class="text-center d-inline p-5"><img src="/storage/{{ $company->logo }}" alt="company logo" width="50px" height="50px" /></p>
                        </div>
                    @endif

                    @if(count($company->employees) > 0)
                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>Email</th>
                                <th>{{ __('Phone') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $number = 1; @endphp
                            @foreach($company->employees as $employee)
                                <tr>
                                    <td>{{ $number }}.</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $employee->last_name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td class="btn-group w-100">
                                        <a href="{{ route('employees.edit', $employee->id) }}" type="button" class="btn btn-small btn-warning d-inline-block w-50">{{ __('Edit') }}</a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline-block w-50">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-small btn-danger w-100" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @php $number++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection