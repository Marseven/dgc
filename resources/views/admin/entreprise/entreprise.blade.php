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
                        Liste des entreprises</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Importations</li>
                        <li class="breadcrumb-item active">Entreprises</li>
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
                            <div>

                            </div>
                        </div>
                        <div class="list-product">
                            <table class="table" id="entreprise">
                                <thead>
                                    <tr>
                                        <th> <span class="f-light f-w-600">#</span></th>
                                        <th> <span class="f-light f-w-600">Société</span></th>
                                        <th> <span class="f-light f-w-600">Téléphone</span></th>
                                        <th> <span class="f-light f-w-600">BP</span></th>
                                        <th> <span class="f-light f-w-600">Activité</span></th>
                                        <th> <span class="f-light f-w-600">Localisation</span></th>
                                        <th> <span class="f-light f-w-600">Date de Création</span></th>
                                        <th> <span class="f-light f-w-600">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody>
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
            $('#entreprise').DataTable({
                language: {
                    'url': "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ url('admin/ajax/entreprises') }}",
                columnDefs: [{
                    className: "upper",
                    targets: [1]
                }],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'company_name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'postal_code'
                    },
                    {
                        data: 'activity'
                    },
                    {
                        data: 'localisation'
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
                url: "{{ route('get-entreprise') }}",
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

        $(document).on("click", ".modal_view_action", function() {
            var id = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('get-entreprise') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "view",
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
