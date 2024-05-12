@extends('layout.default')

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/js/formValidation.min.js"
        integrity="sha512-DlXWqMPKer3hZZMFub5hMTfj9aMQTNDrf0P21WESBefJSwvJguz97HB007VuOEecCApSMf5SY7A7LkQwfGyVfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@section('content')
    <section class="breadcrumb-classic bg-image"
        style="background-image: url('{{ asset('front/images/breadcrumbs-parallax-07.png') }}')">
        <div class="container">
            <div class="row">
                <ul class="list-breadcrumb">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li>Déclaration Prévisionnelle de stock</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-50 section-md-75 section-md-100 section-lg-120 section-xl-150 bg-wild-sand">

        <div class="container text-left">
            @include('layout.alert')
            <br>
            <h2>Déclaration prévisionnelle de stock</h2>
            <form id="stack_form" method="post" action="{{ route('stock') }}" enctype="multipart/form-data">
                @csrf
                <br>
                <h3 style="font-weight: 700">Société</h3>
                <br>
                <div class="row" style="margin-top: 0px;">
                    <div class="col-xl-6 col-lg-6">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="entreprise_id">Sélectionnez votre société </label>
                            <select class="form-input" id="entreprise_id" name="entreprise_id" onChange="viewSociete()">
                                <option value="0">Choisissez votre société</option>
                                @foreach ($entreprises as $entreprise)
                                    <option value="{{ $entreprise->id }}">{{ $entreprise->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <h5>OU</h5>
                <br>
                <div id="societe">
                    <div class="row" style="margin-top: 0px;">
                        <div class="col-xl-4 col-lg-6">
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="legal_status">Forme Juridique *</label>
                                <input class="form-input" id="legal_status" type="text" name="legal_status" required>
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="company_name">Société *</label>
                                <input class="form-input" id="company_name" type="text" name="company_name">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="activity">Activité *</label>
                                <input class="form-input" id="activity" type="text" name="activity">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="commune">Commune *</label>
                                <input class="form-input" id="commune" type="text" name="commune">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="hood">Quartier *</label>
                                <input class="form-input" id="hood" type="text" name="hood">
                            </div>

                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="postal_code">BP *</label>
                                <input class="form-input" id="postal_code" type="text" name="postal_code">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="phone">Téléphone *</label>
                                <input class="form-input" id="phone" type="tel" name="phone">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="email">Email *</label>
                                <input class="form-input" id="email" type="email" name="email">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="business_circuit">N° Fiche Circuit *</label>
                                <input class="form-input" id="business_circuit" type="text" name="business_circuit">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="number_commercant">N° Carte Commerçant *</label>
                                <input class="form-input" id="number_commercant" type="text" name="number_commercant">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="nif">N° NIF *</label>
                                <input class="form-input" id="nif" type="text" name="nif">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="rccm">N° RCCM *</label>
                                <input class="form-input" id="rccm" type="text" name="rccm">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label>Date de création *</label>
                                <input class="form-input" id="date_create" type="date" name="date_create">
                            </div>
                        </div>

                    </div>
                </div>
                <br><br>
                <h3 style="font-weight: 700">Stock</h3>
                <p>Pour les données sur stock vous devrez fournir un fichier PDF en pièce jointe dans ce formulaire. <a
                        href="{{ asset('front/doc/Modele_Declaration_de_Stock_Produit_Annexe.docx') }}"
                        target="_blank">Télécharger le modèle de fichier.</a> </p>
                <br>
                <div class="row" style="margin-top: 0px;">
                    <div class="col-xl-4 col-lg-6">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="service">Service/Département *</label>
                            <input class="form-input" id="service" type="text" name="service" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="referent">Nom du référent stock *</label>
                            <input class="form-input" id="referent" type="text" name="referent" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="referent_contact">Contact *</label>
                            <input class="form-input" id="referent_contact" type="tel" name="referent_contact"
                                required>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="province">Province *</label>
                            <input class="form-input" id="province" type="text" name="province" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="ville">Ville *</label>
                            <input class="form-input" id="ville" type="text" name="ville" required>
                        </div>

                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="activity_id">Nature de l'activité *</label>
                            <select class="form-input" id="activity_id" name="activity_id">
                                <option>Choisissez une activité</option>
                                @foreach ($activities_st as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="declaration_type_id">Type de déclaration *</label>
                            <select class="form-input" id="declaration_type_id" name="declaration_type_id">
                                <option>Choisissez un type de déclaration</option>
                                @foreach ($declarations as $declaration)
                                    <option value="{{ $declaration->id }}">{{ $declaration->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="product_type_id">Type de produits *</label>
                            <select class="form-input" id="product_type_id" name="product_type_id" onChange="other()">
                                <option>Choisissez un type de produit</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                <option value="autre">Autre</option>
                            </select>
                            <input class="form-input" id="type_product" type="text" name="type_product" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="logistic_id">Moyen logistiques utilisés *</label>
                            <select class="form-input" id="logistic_id" name="logistic_id">
                                <option>Choisissez un moyen logistique</option>
                                @foreach ($logistics as $logistic)
                                    <option value="{{ $logistic->id }}">{{ $logistic->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="file_product_url">Téléverser le fichier de données sur les
                                stocks *</label>
                            <br><br>
                            <input class="form-control" id="file_product_url" type="file" name="file_product_url"
                                required>
                        </div>
                    </div>
                </div>
                <button class="btn btn-form btn-default" type="submit">Soumettre</button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(e) {
            FormValidation.formValidation(document.getElementById('stack_form'), {
                fields: {
                    file_product_url: {
                        validators: {
                            notEmpty: {
                                message: "Fichier obligatoire"
                            },
                            file: {
                                extension: 'pdf',
                                type: 'application/pdf',
                                message: "S'il vous plaît veuillez téléverser un fichier PDF.",
                                maxSize: 1048576,
                            },
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });
        });

        function viewSociete() {
            var entreprise_id = document.getElementById("entreprise_id");
            var societe = document.getElementById("societe");

            if (entreprise_id.value == 0) {
                societe.style.display = "block";
            } else {
                societe.style.display = "none";
            }
        }

        function other() {
            var product_type_id = document.getElementById("product_type_id");
            var type_product = document.getElementById("type_product");

            if (product_type_id.value == "autre") {
                type_product.style.display = "block";
            } else {
                type_product.style.display = "none";
            }
        }
    </script>
@endpush
