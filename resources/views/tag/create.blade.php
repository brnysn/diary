@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-tag"></i> Etiketler / <small>Etiket Ekle</small>
                </div>

                <div class="card-body">

                    <div class="p-2">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('tags.store') }}">
                        @csrf
                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="name">İsim</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                    <button type="reset" onclick="window.location='{{ route("tags.index") }}'" class="btn btn-secondary">İptal</button>
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
