@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth/register.Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}">

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if (count($scopes) > 1)
                            <div class="form-group row">
                                <label for="scope" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Scope') }}</label>

                                <div class="col-md-6">
                                    <select id="scope" class="form-control @error('scope') is-invalid @enderror" name="scope" value="{{ old('scope') }}">
                                        @foreach ($scopes as $keyScope=>$scope)
                                            <option value="{{ $keyScope }}">
                                                {{ __('auth/register.'.$scope) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('scope')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="scope" value="U">
                        @endif

                        @if (count($idiomas) > 1)
                            <div class="form-group row">
                                <label for="language" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Default Language') }}</label>

                                <div class="col-md-6">
                                    <select id="language" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ old('language') }}">
                                    @foreach ($idiomas as $idioma)
                                        <option value = {{ $idioma['value'] }} (App::isLocale($idioma['value'])$idioma['value'])?'selected':''>
                                            {{ __('general/idiomas.'.$idioma['text']) }}
                                        </option>
                                    @endforeach

                                    </select>

                                    @error('language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @else
                                <input type="hidden" name="language" value="es">
                            @endif
                        </div>

                        @if(env('PHONE_IN_REGISTER') === true)
                            <div class="form-group row">
                                <label for="country_code" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Country Code') }}</label>

                                <div class="col-md-6">
                                    <select id="country_code" class="form-control @error('country_code') is-invalid @enderror" name="country_code" value="{{ old('country_code') }}">
                                        @foreach($prefixes as $keyPrefix=>$prefix)
                                            <option value="{{ $keyPrefix }}">
                                                {{ $prefix }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('country_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Mobile Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}">

                                    @error('phone_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Password') }}</label>

                            <div class="col-md-6">
                                @component('components.password')
                                    @slot('id') password @endslot
                                    @slot('name') password @endslot
                                    @slot('class') @error('password') is-invalid @enderror @endslot
                                @endcomponent

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('auth/register.Confirm Password') }}</label>

                            <div class="col-md-6">
                                @component('components.password')
                                    @slot('id') password-confirm @endslot
                                    @slot('name') password_confirmation @endslot
                                    @slot('class') @endslot
                                @endcomponent
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth/register.Register') }}
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
