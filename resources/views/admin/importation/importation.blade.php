@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>
                        Liste des importations</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Déclarations</li>
                        <li class="breadcrumb-item active">Importations</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    @include('layout.alert')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="list-product-header">

                        </div>
                        <div class="list-product">
                            <table class="table" id="importation">
                                <thead>
                                    <tr>
                                        <th> <span class="f-light f-w-600">#</span></th>
                                        <th> <span class="f-light f-w-600">Société</span></th>
                                        <th> <span class="f-light f-w-600">Nature</span></th>
                                        <th> <span class="f-light f-w-600">Provenance</span></th>
                                        <th> <span class="f-light f-w-600">Destination</span></th>
                                        <th> <span class="f-light f-w-600">Facture</span></th>
                                        <th> <span class="f-light f-w-600">Valeur</span></th>
                                        <th> <span class="f-light f-w-600">Tonnage</span></th>
                                        <th> <span class="f-light f-w-600">Transitaire</span></th>
                                        <th> <span class="f-light f-w-600">Date de Création</span></th>
                                        <th> <span class="f-light f-w-600">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($importations as $importation)
                                        <tr>
                                            <td>{{ $importation->entreprise->company_name }}</td>
                                            <td>{{ $importation->type_product }}</td>
                                            <td>{{ $importation->country_from }}</td>
                                            <td>{{ $importation->destination }}</td>
                                            <td>
                                                <a target="_blank"
                                                    href="{{ asset($importation->facture_url) }}">{{ $importation->facture_number ?? 'Télécharger' }}</a>
                                            </td>
                                            <td>{{ $importation->value }} FCFA</td>
                                            <td>{{ $importation->weight }}</td>
                                            <td>{{ $importation->transitaire }}</td>
                                            <td>{{ $importation->created_at }}</td>
                                            <td>
                                                <ul class="action">

                                                    <li class="edit">
                                                        <a href="#" class="modal_edit_action" data-bs-toggle="modal"
                                                            data-id="{{ $importation->id }}"
                                                            data-bs-target="#cardModalView">
                                                            <i class="icon-pencil"></i>
                                                        </a>
                                                    </li>
                                                    <li class="view">

                                                            <i class="icon-download"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <div class="modal fade" id="cardModalView" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#importation').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ url('admin/ajax/importations') }}",
                columnDefs: [{
                    className: "upper",
                    targets: [1]
                }],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'societe'
                    },
                    {
                        data: 'type_product'
                    },
                    {
                        data: 'country_from'
                    },
                    {
                        data: 'destination'
                    },
                    {
                        data: 'facture_number'
                    },
                    {
                        data: 'value'
                    },
                    {
                        data: 'weight'
                    },
                    {
                        data: 'transitaire'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'actions'
                    },
                ]
            });
        });

        $(document).on("click", ".modal_edit_action", function() {
            var id = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('get-importation') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "edit",
                },
                success: function(data) {
                    //get data value params
                    var body = data.body;
                    //dynamic title
                    $('#cardModalView .modal-content').html(body); //url to delete item
                    $('#cardModalView').modal('show');
                }
            });

        });
    </script>
@endpush
