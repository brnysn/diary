@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-plus"></i> Kişiler / <small>Kişi Ekle</small>
                </div>

                <div class="card-body">

                    <div class="p-2">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('contacts.store') }}">
                        @csrf

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="firstname">İsim</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="firstname" value="{{ old('firstname') }}">

                                    @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="lastname">Soysim</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname" value="{{ old('lastname') }}">

                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="email">E-posta</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="phone">Telefon</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="photo">Görsel</label>
                                </div>
                                <div class="col-9">
                                    <input type="file" class="@error('photo') is-invalid @enderror" name="photo" id="photo" value="{{ old('photo') }}">

                                    @error('photo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                    <button type="reset" onclick="window.location='{{ route("contacts.index") }}'" class="btn btn-secondary">İptal</button>
                                </div>
                            </div>
                                
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
