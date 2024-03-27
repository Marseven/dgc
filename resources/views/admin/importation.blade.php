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
                        <li class="breadcrumb-item">Importations</li>
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
                                    @foreach ($importations as $importation)
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
                                                    <li class="edit"> <a
                                                            href="{{ url('export/' . $importation->id) }}"><i
                                                                class="icon-download"></i></a>
                                                    </li>

                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#importation').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },

            });
        });
    </script>
@endpush
