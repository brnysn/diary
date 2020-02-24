@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                
                <div class="card-header">
                    <i class="fas fa-users"></i> Günlük


                    <a href="{{route('journals.create')}}" class="btn btn-outline-info btn-sm mx-1 float-right">
                        <i class="fa fa-plus"></i> Günlük Ekle
                    </a>


                    <div class="btn-group float-right">
                        <a id="filterCityDropdown" class="btn btn-outline-secondary btn-sm dropdown-toggle mx-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            İlçeye Göre Filtrele
                        </a>
                        <div class="dropdown-menu" id="citiesMenu" aria-labelledby="filterCityDropdown">
                            <a class="filterSelect dropdown-item" href="#" data-val="" data-column="7" data-name="İlçeye Göre Filtrele" data-title="#filterCityDropdown">
                                <i class="fas fa-map-marker-alt"></i>
                                Tümünü Gör
                            </a>
                        </div>
                    </div>

                    <div class="btn-group float-right">
                        <a id="filterStateDropdown" class="btn btn-outline-secondary btn-sm dropdown-toggle mx-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Şehire Göre Filtrele
                        </a>
                        <div class="dropdown-menu" id="statesMenu" aria-labelledby="filterStateDropdown">
                            <a class="filterSelect dropdown-item" href="#" data-val="" data-column="6" data-name="Şehire Göre Filtrele" data-title="#filterStateDropdown">
                                <i class="fas fa-map-marker-alt"></i>
                                Tümünü Gör
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="p-2">
                        <table id="journalTable" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Başlık</th>
                                    <th>Metin</th>
                                    <th>Tarih</th>
                                    <th>Kişiler</th>
                                    <th>Etiketler</th>
                                    <th>İl</th>
                                    <th>İlçe</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function(){
        var journalStates = [];            //setting lists for filters
        var journalCities = [];            //setting lists for filters
        // begin first table
		var table = $("#journalTable").DataTable({
            "language": {
                "url": "{{asset('assets')}}/datatables/Turkish.json"
            },
            "order": [[ 0, "desc" ]],
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: '{{route("journals.datatable")}}',
			columns: [
				{data: 'id'},
				{data: 'title'},
				{data: 'content'},
				{data: 'date'},
				{data: 'contacts'},
				{data: 'tags'},
				{data: 'state.name'},
				{data: 'city.name'},
				{data: 'İşlemler', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: 4,
					orderable: false,
					render: function(data, type, full, meta) {
                        let contactsArray = [];
                        data.forEach(contact => {
                            contactsArray.push(contact.fullname)
                        });
						return contactsArray.toString();
					},
				},
				{
					targets: 5,
					orderable: false,
					render: function(data, type, full, meta) {
                        let tagsArray = [];
                        data.forEach(tag => {
                            tagsArray.push(tag.name)
                        });
						return tagsArray.toString();
					},
				},
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        if(data && journalStates.indexOf(data) === -1){ journalStates.push(data); }
                        journalStates.sort();
                        return (data)
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        if(data && journalCities.indexOf(data) === -1){ journalCities.push(data); }
                        journalCities.sort();
                        return (data)
                    },
                },
				{
					targets: -1,
					title: 'İşlemler',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <a href="/journals/`+full.id+`/edit" class="btn btn-outline-info mx-1">
                        <i class="fa fa-edit"></i>
                            Düzenle
                        </a>`;
					},
				},
			],
            "initComplete": function( settings, json ) {
                journalStates.forEach(state => {
                    $('#statesMenu').append(`
                        <a class="filterSelect dropdown-item" href="#" data-val="`+state+`" data-column="6" data-name="`+state+`" data-title="#filterStateDropdown">
                            <i class="fas fa-map-marker-alt"></i>
                            `+state+`
                        </a>`)
                });

                journalCities.forEach(city => {
                    $('#citiesMenu').append(`
                        <a class="filterSelect dropdown-item" href="#" data-val="`+city+`" data-column="7" data-name="`+city+`" data-title="#filterCityDropdown">
                            <i class="fas fa-map-marker-alt"></i>
                            `+city+`
                        </a>`)
                });

                $('.filterSelect').click(function() {
                    table.column($(this).data('column'))
                        .search($(this).data('val'))
                        .draw()
                    $($(this).data('title')).text($(this).data('name'));
                });

            }
		});

    });
</script>
@endsection