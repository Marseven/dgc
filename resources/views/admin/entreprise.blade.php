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
                        <li class="breadcrumb-item active">Entreprise</li>
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
                                <a class="btn btn-primary" href="#"><i class="fa fa-plus"></i>Ajouter une
                                    entreprise</a>
                            </div>
                        </div>
                        <div class="list-product">
                            <table class="table" id="entreprise">
                                <thead>
                                    <tr>
                                        <th> <span class="f-light f-w-600">Société</span></th>
                                        <th> <span class="f-light f-w-600">Téléphone</span></th>
                                        <th> <span class="f-light f-w-600">BP</span></th>
                                        <th> <span class="f-light f-w-600">Activité</span></th>
                                        <th> <span class="f-light f-w-600">Localisation</span></th>
                                        <th> <span class="f-light f-w-600">Date de Création</span></th>
                                        <th> <span class="f-light f-w-600">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entreprises as $entreprise)
                                        <tr>
                                            <td>{{ $entreprise->company_name }}</td>
                                            <td>{{ $entreprise->phone }}</td>
                                            <td>{{ $entreprise->postal_code }}</td>
                                            <td>{{ $entreprise->activity->name }}</td>
                                            <td>{{ $entreprise->localisation }}</td>
                                            <td>{{ $entreprise->created_at }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a href="#"><i
                                                                class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
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
        $('#entreprise').DataTable({
            language: {
                'url': "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            },
        });
    </script>
@endpush
