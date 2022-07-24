@extends('layouts.app')

@section('content')

@include('layouts.converter')

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
                        <a href="" role="button" class="btn btn-primary container-btn" id="search-employees-btn">{{ __('Search Employees') }}</a>
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
                        <div class="container col-md-6 mb-5">
                            <p class="lead text-left d-inline-block company-paragraph">{{ __('Company Logo') }}</p><p class="text-center d-inline p-5"><img src="/storage/{{ $company->logo }}" alt="company logo" width="50px" height="50px" /></p>
                        </div>
                    @endif

                    <div class="d-none justify-content-center mt-4 mb-4 shadow rounded w-75 mx-auto" id="emp-modal-div">
                        <form action="" method="POST" class="justify-content-center w-50">
                        @csrf
                            <label for="emp-search-term" class="d-block text-center lead mb-3 mt-2">Termin za pretragu</label>
                            <input type="text" class="form-control mb-3" name="emp-search-term" id="emp-search-term">
                            <input type="hidden" id="companyid" value="{{$company->id}}">
                            <div class="d-flex justify-content-around mb-4">
                                <button type="button" class="btn btn-success w-25" id="empsearchbtn">Search</button>
                                <button type="button" class="btn btn-danger w-25" id="emp-close-btn">Close</button>
                            </div>
                        </form>
                    </div>

                    @if(count($company->employees) > 0)
                    <table class="table table-hover mt-5">
                        <thead>
                            <tr>
                                <th>{{ __('First Name') }}</th>
                                <th>{{ __('Last Name') }}</th>
                                <th>Email</th>
                                <th>{{ __('Phone') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($company->employees as $employee)
                                <tr>
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
                            @endforeach
                        </tbody>
                    </table>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript">
        const showempmodal = document.getElementById('search-employees-btn');
        const empmodal = document.getElementById('emp-modal-div');
        const empsearch = document.getElementById('empsearchbtn');
        const empclose = document.getElementById('emp-close-btn');
        const showcurrency = document.getElementById('currency-converter-btn');
        const currencyform = document.getElementById('currency-form');
        const currencyclose = document.getElementById('cancel-amount-btn');

        showempmodal.addEventListener('click', function(event) {
            event.preventDefault();
            empmodal.classList.remove('d-none');
            empmodal.classList.add('d-flex');
        });

        empsearch.addEventListener('click', function(event) {
            event.preventDefault();
            let term = document.getElementById('emp-search-term').value;
            let companyid = document.getElementById('companyid').value;
            fetch('/searchemployees', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'url': '/searchemployees',
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                },
                body:JSON.stringify({
                    "term":term,
                    "companyid":companyid
                })
            })
            .then(response => response.json())
            .then(function(response) {

                document.getElementById('tbody').innerHTML = '';
                for (let i = 0; i < response.length; i++)
                {
                    if (response[i].email == null) {
                        response[i].email = '';
                    }
                    if (response[i].phone == null) {
                        response[i].phone = '';
                    }

                    $('#tbody').append(
                        '<tr><td>' + response[i].first_name + '</td>' +
                        '<td>' + response[i].last_name + '</td>' +
                        '<td>' + response[i].email + '</td>' +
                        '<td>' + response[i].phone + '</td>' +
                        '<td class="btn-group w-100"><a href="/employees/' + response[i].id + '/edit" type="button" class="btn btn-small btn-warning d-inline-block w-50">{{ __("Edit") }}</a>' +
                        '<form action="/employees' + '/' + response[i].id + '" method="POST" class="d-inline-block w-50">@csrf<input type="hidden" name="_method" value="DELETE"><button type="submit" class="btn btn-small btn-danger w-100"  onclick="return confirm(&quot;{{ __("Are you sure?") }}&quot;)">{{ __("Delete") }}</button></form>' +
                        '</td>' +
                        '</tr>'
                    );
                }
                })
                .catch(error => alert(error.message))
        });

        empclose.addEventListener('click', function(event) {
            event.preventDefault();
            empmodal.classList.remove('d-flex');
            empmodal.classList.add('d-none');
            window.location.reload();
        });

        showcurrency.addEventListener('click', function() {
            currencyform.classList.remove('d-none');
            currencyform.classList.add('d-flex');
        });

        currencyclose.addEventListener('click', function(event) {
            event.preventDefault();
            currencyform.classList.remove('d-flex');
            currencyform.classList.add('d-none');
            document.getElementById('currency-from').value = 'RSD';
            document.getElementById('currency-to').value = 'EUR';
            document.getElementById('amount').value = '';
            document.getElementById('converted-currency-p').innerHTML = '';
        });
    </script>

@endsection