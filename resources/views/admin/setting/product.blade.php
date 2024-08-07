@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Type de produits</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Paramètres</li>
                        <li class="breadcrumb-item active">Type de produits</li>
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
                                data-bs-target="#securityModal"><i class="fa fa-plus"></i>Ajouter untype</a>
                        </div>
                        <div class="list-product">
                            <table class="table" id="activite">
                                <thead>
                                    <tr>
                                        <th> <span class="f-light f-w-600">ID</span></th>
                                        <th> <span class="f-light f-w-600">Libellé</span></th>
                                        <th> <span class="f-light f-w-600">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#cardModal{{ $product->id }}">Modifer</button>
                                                <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cardModalCenter{{ $product->id }}">
                                                    Supprimer
                                                </button>
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

    <div class="modal fade" id="securityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un type de produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/product') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" name="name" required>
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

    @foreach ($products as $product)
        <div class="modal fade" id="cardModal{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelOne" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour une activé</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/product/update/' . $product->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Nom</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                    required>
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
    @endforeach

    @foreach ($products as $product)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cette activité ?
                    </div>
                    <form action="{{ url('admin/product/update/' . $product->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="delete" value="true" />
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#activite').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                },

            });
        });
    </script>
@endpush
