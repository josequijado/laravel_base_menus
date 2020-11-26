@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth/register.Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth/register.A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('auth/register.Before proceeding, please check your email for a verification link.') }}
                    {{ __('auth/register.If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('auth/register.click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
