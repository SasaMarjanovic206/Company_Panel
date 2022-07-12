@extends('layouts.app');

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <form action="" method="POST" class="bg-white p-6 rounded shadow-md" style="width:300px;">
            @csrf
                <div class="mb-5">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                @error('email')
                    <div class="row justify-content-center" style="color:red;margin-top:0;">
                        {{ $message }}
                    </div>
                @enderror
                <div class="d-grid col-6 mx-auto">
                    <button type="submit" class="btn btn-primary">Email Me</button>
                </div>
                @if(session('success'))
                    <div class="text-success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>

@endsection