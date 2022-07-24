@extends('layouts.app')

@section('content')

@include('layouts.converter')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card w-100">
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
                        <a href="" role="button" class="btn btn-primary container-btn" id="search-companies-btn">{{ __('Search Companies') }}</a>
                    </div>

                    <div class="d-none justify-content-center mt-4 mb-4 shadow rounded w-75 mx-auto" id="modal-div">
                        <form action="#" method="POST" class="justify-content-center w-50">
                        @csrf
                            <label for="search-term" class="d-block text-center lead mb-3 mt-2">Termin za pretragu</label>
                            <input type="text" class="form-control mb-3" name="search-term" id="search-term" required>
                            <div class="d-flex justify-content-around mb-4">
                                <button type="button" class="btn btn-success w-25" id="searchbtn">Search</button>
                                <button type="button" class="btn btn-danger w-25" id="close-btn">Close</button>
                            </div>
                        </form>
                    </div>

                    @if(count($companies) > 0)
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
                        <tbody id="tbody">
                            @foreach($companies as $company)
                                <tr>
                                    <td><a href="{{ route('companies.show', $company->id) }}" class="company-link">{{ $company->name }}</a></td>
                                    <td>{{ $company->email }}</td>
                                    <td>
                                        @if($company->logo !== null)
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
                    <div class="d-flex justify-content-center" id="link-pagination-div">
                        {{ $companies->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    const showmodal = document.getElementById('search-companies-btn');
    const modal = document.getElementById('modal-div');
    const search = document.getElementById('searchbtn');
    const close = document.getElementById('close-btn');
    const showcurrency = document.getElementById('currency-converter-btn');
    const currencyform = document.getElementById('currency-form');
    const currencyclose = document.getElementById('cancel-amount-btn');

    showmodal.addEventListener('click', function(event) {
        event.preventDefault();
        modal.classList.remove('d-none');
        modal.classList.add('d-flex');
    });

    search.addEventListener('click', function(event) {
        event.preventDefault();
        let term = document.getElementById('search-term').value;
            fetch('/searchcompanies', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'url': '/searchcompanies',
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            },
            body:JSON.stringify({
                "term":term
            })
        })
        .then(response => response.json())
        .then(function(response) {

            document.getElementById('tbody').innerHTML = '';
            document.getElementById('link-pagination-div').innerHTML = '';
            for (let i = 0; i < response.length; i++)
            {
                if (response[i].logo == null) {
                    response[i].logo = '';
                } else {
                    response[i].logo = '<image src="/storage/' + response[i].logo + '" class="rounded" alt="" width="30px" height="30px" />';
                }

                $('#tbody').append(
                    '<tr><td><a href="companies' + "/" + response[i].id + '" class="company-link">' + response[i].name + '</a></td>' +
                    '<td>' + response[i].email + '</td>' +
                    '<td>' + response[i].logo + '</td>' +
                    '<td>' + response[i].website + '</td>' +
                    '<td>' + response[i].user.name + '</td>' +
                    '<td class="btn-group w-100"><a href="companies/' + response[i].id + '/edit" type="button" class="btn btn-small btn-warning d-inline-block w-50">{{ __("Edit") }}</a>' +
                    '<form action="companies' + '/' + response[i].id + '" method="POST" class="d-inline-block w-50">@csrf<input type="hidden" name="_method" value="DELETE"><button type="submit" class="btn btn-small btn-danger w-100"  onclick="return confirm(&quot;{{ __("Are you sure?") }}&quot;)">{{ __("Delete") }}</button></form>' +
                    '</td>' +
                    '</tr>'
                );
            }
        })
        .catch(error => alert(error.message))
    });

    close.addEventListener('click', function(event) {
        event.preventDefault();
        modal.classList.remove('d-flex');
        modal.classList.add('d-none');
        document.getElementById('search-term').value = '';
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
