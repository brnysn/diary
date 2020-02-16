@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users"></i> Günlük / <small>Günlüğe Yaz</small>
                </div>

                <div class="card-body">

                    <div class="p-2">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('journals.store') }}">
                        @csrf

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="title">Başlık</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}" autofocus required>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="content">İçerik</label>
                                </div>
                                <div class="col-9">
                                    <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="7">{{ old('content') }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="date">Tarih</label>
                                </div>
                                <div class="col-9">
                                    <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" name="date" id="date" value="{{ old('date') }}">

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="state_id">İl</label>
                                </div>
                                <div class="col-9">
                                    <select class="form-control @error('state_id') is-invalid @enderror" id="state_id" name="state_id" required>
                                                    
                                        <option value=""> İl Seçiniz</option> 
                                        @if ($states->count())
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>    
                                            @endforeach
                                        @endif

                                    </select>

                                    @error('state_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-3 text-right form-text">
                                    <label for="city_id">İlçe</label>
                                </div>
                                <div class="col-9">
                                    <select class="form-control @error('city_id') is-invalid @enderror" name="city_id" id="city_id" required>
                                                    
                                        <option value="">Öncelikle şehir seçiniz</option>

                                    </select>

                                    @error('city_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if(!empty($tags))
                                <div class="form-group row">
                                    <label class="col-3 text-right form-text">Etiketler</label>

                                    <div class="col-9">
                                        <div class="row">
                                            @foreach ($tags as $tag)
                                                <div class="col-sm-3 mb-3 text-center">
                                                    <label for="tags[{{$tag->id}}]" style="font-size:1rem; cursor: pointer;">{{$tag->name}}</label><br>
                                                    <input type="checkbox" name="tags[{{$tag->id}}]" id="tags[{{$tag->id}}]" stlye="cursor: pointer;">
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>
                            @endif

                            @if(!empty($contacts))
                                <div class="form-group row">
                                    <label class="col-3 text-right form-text">Etiketler</label>

                                    <div class="col-9">
                                        <div class="row">
                                            @foreach ($contacts as $contact)
                                                <div class="col-sm-4 mb-3 text-center">
                                                    <label for="contacts[{{$contact->id}}]" style="font-size:1rem; cursor: pointer;">{{$contact->fullname}}</label><br>
                                                    <input type="checkbox" name="contacts[{{$contact->id}}]" id="contacts[{{$contact->id}}]" stlye="cursor: pointer;">
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>

                                </div>
                            @endif

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                    <button type="reset" onclick="window.location='{{ route("journals.index") }}'" class="btn btn-secondary">İptal</button>
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

@section('js')
<script src="{{ asset('js') }}/axios.js"></script>
<script>
    $(function() {
        function setCities(id,selected=null){
            if(id){      
                //clear select box options
                $("#city_id").find('option').remove()
                //add new options
                axios.post('{{route('states.cities')}}',{id:id,'method':'POST','_token':'{{Session::token()}}'
                }).then((response)=>{
                    //add the empty option
                    $("#city_id").append($("<option></option>").attr("value","").text("İlçe seçiniz"))
                    //add other options
                    response.data.forEach(function(element) {
                        $("#city_id").append($("<option></option>").attr("value",element.id).text(element.name))
                    })
                }).catch((error)=>{
                    console.log(error.response.data)
                });
            }
        }
        setCities({{empty(old('state_id')) ? '':old('state_id')}}{{empty(old('city_id')) ? '':','.old('city_id')}})

        $("#state_id").on("change", function() {
            setCities(this.value)
        });
    });
</script>
@endsection