@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-tag"></i> Etiketler</div>
                <div class="card-body">
                        <a href="{{ route('tags.create') }}">Etiket Ekle</a><br>
                        <a href="{{ route('tags.index') }}">Etiketleri Göster</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Günlük</div>
                <div class="card-body">
                        <a href="{{ route('journals.create') }}">Yaz</a><br>
                        <a href="{{ route('journals.index') }}">Göster</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header"><i class="fas fa-users"></i> Kişiler</div>
                <div class="card-body">
                        <a href="{{ route('contacts.create') }}">Kişi Ekle</a><br>
                        <a href="{{ route('contacts.index') }}">Kişileri Göster</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
