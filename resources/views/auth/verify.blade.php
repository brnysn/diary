@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('E-Posta Adresinizi Doğrulayın') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('E-Posta adresinize doğrulama maili gönderilmiştir.') }}
                        </div>
                    @endif

                    {{ __('Devam etmeden önce, lütfen doğrulama maili için posta kutunuzu kontrol edin.') }}
                    {{ __('Doğrulama maili almadıysanız yeni bir doğrulama maili almak için') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Buraya Tıklayın') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
