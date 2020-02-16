@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                
                <div class="card-header">
                    <i class="fas fa-users"></i> Günlük
                    <a href="{{route('journals.create')}}" class="btn btn-outline-info btn-sm float-right">
                        <i class="fa fa-plus"></i> Günlük Ekle
                    </a>
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
        // begin first table
		$("#journalTable").DataTable({
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

			]
		});

    });
</script>
@endsection