@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Déclaration de stock</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Stock</li>
                        <li class="breadcrumb-item active">N°{{ $stock->id }}</li>
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
                                                    <h4 class="media-heading">{{ $stock->entreprise->company_name }}</h4>
                                                    <p>{{ $stock->entreprise->email }}<br><span>{{ $stock->entreprise->phone }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- End Info-->
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-md-end text-xs-center">
                                                <h3>Déclaration #<span class="counter">{{ $stock->id }}</span></h3>
                                                <p>Date: {{ $stock->created_at }}</p>
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
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#cardModal">Statut</button>
                                            <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                                data-bs-target="#cardModalView">Modifier</button>
                                            {{-- <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                                data-bs-target="#securityModal">Note de l'administration</button> --}}
                                            <a href="{{ url('admin/export/stock/' . $stock->id) }}"><button
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
                                                    <td>{{ $stock->entreprise->company_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nature de l'activité</td>
                                                    <td>{{ $stock->entreprise->activity == null ? $stock->entreprise->activity_ent->name : $stock->entreprise->activity }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Commune/Arrondissement</td>
                                                    <td>{{ $stock->entreprise->commune }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Quartier</td>
                                                    <td>{{ $stock->entreprise->hood }}</td>
                                                </tr>
                                                <tr>
                                                    <td>BP</td>
                                                    <td>{{ $stock->entreprise->postal_code }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Téléphone</td>
                                                    <td>{{ $stock->entreprise->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Fiche circuit</td>
                                                    <td>{{ $stock->entreprise->business_circuit }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Carte commerçant</td>
                                                    <td>{{ $stock->entreprise->number_commercant }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Agrément de commerce</td>
                                                    <td>{{ $stock->entreprise->number_agrement }}</td>
                                                </tr>
                                                <tr>
                                                    <td>RCCM</td>
                                                    <td>{{ $stock->entreprise->rccm }}</td>
                                                </tr>
                                                <tr>
                                                    <td>NIF</td>
                                                    <td>{{ $stock->entreprise->nif }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date de création</td>
                                                    <td>{{ $stock->entreprise->date_create }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Forme juridique</td>
                                                    <td>{{ $stock->entreprise->legal_status }}</td>
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
                                                <h4 class="media-heading">Stock</h4>

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
                                                    <td>Nom du référent</td>
                                                    <td>{{ $stock->referent }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Contact du référent</td>
                                                    <td>{{ $stock->referent_contact }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nature de l'activité</td>
                                                    <td>{{ $stock->activity_st->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type de déclaration</td>
                                                    <td>{{ $stock->type_declaration_st->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Type de produits</td>
                                                    <td>{{ $stock->type_product == null ? $stock->type_product_st->name : $stock->type_product }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Province</td>
                                                    <td>{{ $stock->province }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ville</td>
                                                    <td>{{ $stock->ville }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Commune</td>
                                                    <td>{{ $stock->commune }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Département</td>
                                                    <td>{{ $stock->departement }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Moyen logistique utilisé</td>
                                                    <td>{{ $stock->logistic_st->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Données sur le stock</td>
                                                    <td><a href="{{ asset($stock->file_product_url) }}" target="_blank">
                                                            <button style="padding: 10px !important" type="button"
                                                                class="btn btn-primary">
                                                                Télécharger <i class="icon-download"></i>
                                                            </button></a></td>
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
                                {{-- <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                    data-bs-target="#securityModal">Note de l'administration</button> --}}
                                <a href="{{ url('admin/export/stock/' . $stock->id) }}"><button
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

    <div class="modal fade" id="securityModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Ajouter une note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('activite') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Note</label>
                            <textarea class="form-control" name="note" required></textarea>
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

    <div class="modal fade" id="cardModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le statut déclaration N° :
                        {{ $stock->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>

                <form action="{{ url('update-state/stock/' . $stock->id) }}" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="status">Statut *</label>
                                <select class="form-control" id="status" name="status" onchange="message_rejectd()"
                                    required>
                                    <option value="pending">En cours</option>
                                    <option value="rejected">Rejetté</option>
                                    <option value="missing_file">Document manquant</option>
                                    <option value="completed">Validé</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3" id="message_rejected" style="display: none">
                            <label for="message_rejected" class="col-form-label">Message</label>
                            <textarea class="form-control" name="message_rejected" required></textarea>
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

    <div class="modal fade" id="cardModalView" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour la déclaration N° :
                        {{ $stock->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <form action="{{ url('admin/update/stock/' . $stock->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="referent">Nom du Référent *</label>
                                <input class="form-control" id="referent" type="text"
                                    value="{{ $stock->referent }}" name="referent" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="referent_contact">Contact du Référent *</label>
                                <input class="form-control" id="referent_contact" type="text"
                                    value="{{ $stock->referent_contact }}" name="referent_contact" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="activity_id">Nature de l'activité *</label>
                                <select class="form-control" id="activity_id" name="activity_id">
                                    @foreach ($activities_st as $activity)
                                        <option @if ($activity->id == $stock->activity_st->id) selected @endif
                                            value="{{ $activity->id }}">{{ $activity->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="declaration_type_id">Type de déclaration *</label>
                                <select class="form-control" id="declaration_type_id" name="declaration_type_id">
                                    @foreach ($declarations as $declaration)
                                        <option @if ($declaration->id == $stock->type_declaration_st->id) selected @endif
                                            value="{{ $declaration->id }}">{{ $declaration->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="product_type_id">Type de produits *</label>
                                <select class="form-control" id="product_type_id" name="product_type_id">
                                    @foreach ($products as $product)
                                        <option @if ($product->id == $stock->type_product_st->id) selected @endif
                                            value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="province">Province *</label>
                                <input class="form-control" id="province" type="text"
                                    value="{{ $stock->province }}" name="province" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="ville">Ville *</label>
                                <input class="form-control" id="ville" type="text" value="{{ $stock->ville }}"
                                    name="ville" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="commune">Commune *</label>
                                <input class="form-control" id="commune" type="text" value="{{ $stock->commune }}"
                                    name="commune" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="departement">Département *</label>
                                <input class="form-control" id="departement" type="text"
                                    value="{{ $stock->departement }}" name="departement" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label for="logistic_id">Moyen logistique utilisé*</label>
                                <select class="form-control" id="logistic_id" name="logistic_id">
                                    @foreach ($logistics as $logistic)
                                        <option @if ($logistic->id == $stock->logistic_st->id) selected @endif
                                            value="{{ $logistic->id }}">{{ $logistic->name }}</option>
                                    @endforeach
                                </select>
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
    <script>
        function message_rejected() {
            var status = document.getElementById("status");
            var message = document.getElementById("message_rejected");

            if (status.value != "rejected") {
                message.style.display = "none";
            } else {
                message.style.display = "block";
            }
        }
    </script>
@endpush
