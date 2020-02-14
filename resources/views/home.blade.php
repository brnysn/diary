@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Anasayfa</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-3">
                        <a href="{{ route('tags.index') }}">Etiketler</a>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('contacts.index') }}">Kişiler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
