@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">
                    <i class="fas fa-users"></i> Kişiler
                    <a href="{{route('contacts.create')}}" class="btn btn-outline-info btn-sm float-right">
                        <i class="fa fa-plus"></i> Kişi Ekle
                    </a>
                </div>

                <div class="card-body">
                    <div class="p-2">
                        <table id="contactTable" class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>İsim</th>
                                    <th>Soyisim</th>
                                    <th>Telefon</th>
                                    <th>E-Posta</th>
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
		$("#contactTable").DataTable({
            "language": {
                "url": "{{asset('assets')}}/datatables/Turkish.json"
            },
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: '{{route("contacts.datatable")}}',
			columns: [
				{data: 'id'},
				{data: 'firstname'},
				{data: 'lastname'},
				{data: 'phone', "defaultContent": "<i>Girilmemiş</i>" },
				{data: 'email', "defaultContent": "<i>Girilmemiş</i>" },
				{data: 'İşlemler', responsivePriority: -1},
			],
			columnDefs: [
				{
					targets: -1,
					title: 'İşlemler',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <a href="/contacts/`+full.id+`/edit" class="btn btn-outline-info mx-1">
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