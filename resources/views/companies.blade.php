@extends('layouts.app')

@section('content')

<script>
    fetch('http://127.0.0.1:8000/api/testRoute')
        .then(res => {
            // console.log(res.json())

            // let data = res.json();
            Object.entries(res.json()).map(item => {
                console.log(item.email)
            })
            // for (const email in data) {
            //     console.log(email);
            // }
        })
</script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="custom-card-header center">{{ __('Companies') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container-btn-div">
                        <a href="/" role="button" class="btn btn-primary container-btn">{{ __('Home') }}</a>
                        <a href="{{ route('companies.create') }}" role="button" class="btn btn-primary container-btn" id="company-btn">{{ __('Add Company') }}</a>
                    </div>

                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Logo') }}</th>
                                <th>{{ __('Website') }}</th>
                                <th>{{ __('Creator') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companies as $company)
                                <tr>
                                    <td><a href="{{ route('companies.show', $company->id) }}" class="company-link">{{ $company->name }}</a></td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                        @if($company->logo !== null)
                                            @php $company->logo = str_replace('public/', '', $company->logo); @endphp
                                            <image src="/storage/{{ $company->logo }}" class="rounded" alt="" width="30px" height="30px" />
                                        @endif
                                    </td>
                                    <td>{{ $company->website }}</td>
                                    <td>{{ $company->user->name }}</td>
                                    <td class="btn-group w-100">
                                        <a href="{{ route('companies.edit', $company->id) }}" type="button" class="btn btn-small btn-warning d-inline-block w-50">{{ __('Edit') }}</a>
                                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline-block w-50">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-small btn-danger w-100" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $companies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection