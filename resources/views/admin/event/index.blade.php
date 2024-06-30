@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/dropzone.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/vendors/date-picker.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Liste des évènements</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Évènement</li>
                        <li class="breadcrumb-item active">Évènements</li>
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
                            <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                data-bs-target="#cardModalAdd"><i class="fa fa-plus"></i>Ajouter une évènement</a>
                        </div>
                        <br><br>
                        <div class="list-product">
                            <table class="table" id="event">
                                <thead>
                                    <tr>
                                        <th> <span class="f-light f-w-600">#</span></th>
                                        <th> <span class="f-light f-w-600">Image</span></th>
                                        <th> <span class="f-light f-w-600">Titre</span></th>
                                        <th> <span class="f-light f-w-600">Début</span></th>
                                        <th> <span class="f-light f-w-600">Fin</span></th>
                                        <th> <span class="f-light f-w-600">Lieu</span></th>
                                        <th> <span class="f-light f-w-600">Statut</span></th>
                                        <th> <span class="f-light f-w-600">Date de Création</span></th>
                                        <th> <span class="f-light f-w-600">Action</span></th>
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

    <div class="modal fade" id="cardModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un évènement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <form action="{{ url('admin/event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Titre</label>
                                        <input class="form-control" name="title" type="text" placeholder="Titre *"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea4" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input class="form-control" name="picture" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Date de début</label>
                                        <input class="form-control" type="datetime-local" id="start_time" name="start_time"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Date de fin</label>
                                        <input class="form-control" type="datetime-local" id="end_time" name="end_time"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div id="date-error" style="color: red; display: none;">La date de début doit être avant la date
                                de fin.</div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Lieu</label>
                                        <input class="form-control" name="place" type="text" placeholder="Lieu *"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script src="{{ asset('admin/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('admin/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('admin/js/datepicker/date-picker/datepicker.custom.js') }}"></script>

    <script src="{{ asset('admin/js/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('admin/js/dropzone/dropzone-script.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');
            var errorDiv = document.getElementById('date-error');

            function validateDates() {
                var startTime = new Date(startTimeInput.value);
                var endTime = new Date(endTimeInput.value);

                if (startTime >= endTime) {
                    errorDiv.style.display = 'block';
                    return false;
                } else {
                    errorDiv.style.display = 'none';
                    return true;
                }
            }

            startTimeInput.addEventListener('change', validateDates);
            endTimeInput.addEventListener('change', validateDates);
        });

        $(document).ready(function() {
            $('#event').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ url('admin/ajax/events') }}",
                columnDefs: [{
                    className: "upper",
                    targets: [1]
                }],
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'picture'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'start_time'
                    },
                    {
                        data: 'end_time'
                    },
                    {
                        data: 'place'
                    },
                    {
                        data: 'status'
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
                url: "{{ route('get-event') }}",
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

        $(document).on("click", ".modal_delete_action", function() {
            var id = $(this).data('id');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('get-event') }}",
                dataType: 'json',
                data: {
                    "id": id,
                    "action": "delete",
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
