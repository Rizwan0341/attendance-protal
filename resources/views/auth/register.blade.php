@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="row">
                <div class="col-md-10 mx-auto">
 
                    @if (\Session::has('error'))
                        <div class="alert alert-danger " role="alert">
                            {{ \Session::get('error') }}
                        </div>
                    @elseif (\Session::has('success'))
                    
                        <div class="alert alert-success " role="alert">
                            {{ \Session::get('success') }}
                        </div>
                    @endif
                </div>
            </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="select-role" class="col-md-4 col-form-label text-md-end">{{ __('Select Role') }}</label>

                            <div class="col-md-6">
                                <select name="role" class="form-select" id="select-role" required>
                                    <option value="0">User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <!-- <input id="select-role" type="select-role" class="form-control" name="password_confirmation" required autocomplete="new-password"> -->
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="select_shift" class="col-md-4 col-form-label text-md-end">{{ __('Select User Shift') }}</label>

                            <div class="col-md-6">
                                <select name="select_shift" class="form-select" id="select_shift" required>
                                @foreach($shifts as $shift)
                                    <option value="{{ $shift->id }}">{{ $shift->shift_name }} ({{ $shift->start_time }} - {{ $shift->end_time }})</option>
                                @endforeach
                                </select>
                                <!-- <input id="select-role" type="select-role" class="form-control" name="password_confirmation" required autocomplete="new-password"> -->
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
