@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Déclaration d'importation</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Déclaration</li>
                        <li class="breadcrumb-item active">N°{{ $importation->id }}</li>
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
                        <div class="invoice">
                            <div>
                                <div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="media">
                                                <div class="media-left"><img class="media-object img-60"
                                                        src="../assets/images/other-images/logo-login.png" alt="">
                                                </div>
                                                <div class="media-body m-l-20 text-right">
                                                    <h4 class="media-heading">{{ $importation->entreprise->company_name }}
                                                    </h4>
                                                    <p>{{ $importation->entreprise->email }}<br><span>{{ $importation->entreprise->phone }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Info-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-md-end text-xs-center">
                                                <h3>Déclaration #<span class="counter">{{ $importation->id }}</span></h3>
                                                <p>Date: {{ $importation->created_at }}</p>
                                            </div>
                                            <!-- End Title-->
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- End InvoiceTop-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="media">
                                            <div class="media-left"><img class="media-object rounded-circle img-60"
                                                    src="../assets/images/user/1.jpg" alt=""></div>
                                            <div class="media-body m-l-20">
                                                <h4 class="media-heading">Identification de l'opérateur économique</h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-md-end" id="project">

                                            <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                                data-bs-target="#cardModalView">Modifier</button>
                                            <a href="{{ url('admin/export/importation/' . $importation->id) }}"><button
                                                    class="btn btn btn-primary me-2" type="button">Imprimer</button></a>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- End Invoice Mid-->
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Libellé</th>
                                                <th>Valeur</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Raison Sociale</td>
                                                    <td>{{ $importation->entreprise->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nature de l'activité</td>
                                                    <td>{{ $importation->entreprise->activity == null ? $importation->entreprise->activity_ent->name : $importation->entreprise->activity }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Localisation</td>
                                                    <td>{{ $importation->entreprise->localisation }}</td>
                                                </tr>
                                                <tr>
                                                    <td>BP</td>
                                                    <td>{{ $importation->entreprise->postal_code }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Téléphone</td>
                                                    <td>{{ $importation->entreprise->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>N° Statistique</td>
                                                    <td>{{ $importation->entreprise->number_statistic }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Carte commerçant</td>
                                                    <td>{{ $importation->entreprise->number_commercant }}</td>
                                                </tr>
                                                <tr>
                                                    <td>RCCM</td>
                                                    <td>{{ $importation->entreprise->rccm }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Table-->
                                </div>
                                <!-- End InvoiceBot-->
                                <br>
                                <!-- End InvoiceTop-->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="media">
                                            <div class="media-left"><img class="media-object rounded-circle img-60"
                                                    src="../assets/images/user/1.jpg" alt=""></div>
                                            <div class="media-body m-l-20">
                                                <h4 class="media-heading">Importation</h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="text-md-end" id="project">

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <!-- End Invoice Mid-->
                                <div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Libellé</th>
                                                <th>Valeur</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Nature des marchandises</td>
                                                    <td>{{ $importation->type_product }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pays d'origine</td>
                                                    <td>{{ $importation->country_origin }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pays de provenance</td>
                                                    <td>{{ $importation->country_from }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Destination</td>
                                                    <td>{{ $importation->destination }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Port d'embarquement</td>
                                                    <td>{{ $importation->dock_loading }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Port de débarquement</td>
                                                    <td>{{ $importation->dock_unloading }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Valeur de la marchandise</td>
                                                    <td>{{ $importation->value }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Moyen de transport</td>
                                                    <td>{{ $importation->type_transaport }}</td>
                                                </tr>
                                                <tr>
                                                    <td>N° de facture pro-forma</td>
                                                    <td>{{ $importation->facture_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Documents</td>
                                                    <td><a href="{{ asset($importation->facture_url) }}" target="_blank">
                                                            <button style="padding: 10px !important" type="button"
                                                                class="btn btn-primary">
                                                                Télécharger <i class="icon-download"></i>
                                                            </button></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Tonnage</td>
                                                    <td>{{ $importation->weight }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Quantité</td>
                                                    <td>{{ $importation->quantity }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Transitaire</td>
                                                    <td>{{ $importation->transitaire }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Table-->
                                </div>
                                <!-- End InvoiceBot-->
                            </div>
                            <div class="col-sm-12 text-center mt-3">
                                <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                    data-bs-target="#cardModalView">Modifier</button>
                                <a href="{{ url('admin/export/importation/' . $importation->id) }}"><button
                                        class="btn btn btn-primary me-2" type="button">Imprimer</button></a>
                            </div>
                            <!-- End Invoice-->
                            <!-- End Invoice Holder-->
                            <!-- Container-fluid Ends-->
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour la déclaration N° :
                        {{ $importation->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>

                <form action="{{ url('update/importation/' . $importation->id) }}" method="POST">

                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="type_product">Nature des marchandises *</label>
                                <input class="form-control" id="type_product" type="text"
                                    value="{{ $importation->type_product }}" name="type_product" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="country_origin">Pays d\'origine *</label>
                                <input class="form-control" id="country_origin" type="text"
                                    value="{{ $importation->country_origin }}" name="country_origin" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="country_from">Pays de Provenance *</label>
                                <input class="form-control" id="country_from" type="text"
                                    value="{{ $importation->country_from }}" name="country_from" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="destination">Destination *</label>
                                <input class="form-control" id="destination" type="text"
                                    value="{{ $importation->destination }}" name="destination" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="dock_loading">Port d\'embarquement *</label>
                                <input class="form-control" id="dock_loading" type="text"
                                    value="{{ $importation->type_product }}" name="dock_loading" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="dock_unloading">Port de débarquement *</label>
                                <input class="form-control" id="dock_unloading" type="text"
                                    value="{{ $importation->dock_unloading }}" name="dock_unloading" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="value">Valeur de la marchandise *</label>
                                <input class="form-control" id="value" type="text"
                                    value="{{ $importation->value }}" name="value" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="type_transaport">Moyen de transport *</label>
                                <input class="form-control" id="type_transaport" type="text"
                                    value="{{ $importation->type_transaport }}" name="type_transaport" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="facture_number">N° de Facture pro-forma *</label>
                                <input class="form-control" id="facture_number" type="text"
                                    value="{{ $importation->facture_number }}" name="facture_number" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="weight">Tonnage *</label>
                                <input class="form-control" id="weight" type="number"
                                    value="{{ $importation->weight }}" name="weight" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="quantity">Quantité *</label>
                                <input class="form-control" id="quantity" type="number"
                                    value="{{ $importation->quantity }}" name="quantity" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="transitaire">Transitaire *</label>
                                <input class="form-control" id="transitaire" type="text"
                                    value="{{ $importation->transitaire }}" name="transitaire" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
@endpush
