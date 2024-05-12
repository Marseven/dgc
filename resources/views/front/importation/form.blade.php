@extends('layout.default')

@section('content')
    <section class="breadcrumb-classic bg-image"
        style="background-image: url('{{ asset('front/images/breadcrumbs-parallax-07.png') }}')">
        <div class="container">
            <div class="row">
                <ul class="list-breadcrumb">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li>Déclaration Prévisionnelle d’importation</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-50 section-md-75 section-md-100 section-lg-120 section-xl-150 bg-wild-sand">

        <div class="container text-left">
            @include('layout.alert')
            <br>
            <h2>Déclaration Prévisionnelle d’importation</h2>
            <form method="post" action="{{ route('importation') }}" enctype="multipart/form-data">
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
                                <label class="form-label" for="company_name">Raison sociale *</label>
                                <input class="form-input" id="company_name" type="text" name="company_name">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="localisation">Localisation *</label>
                                <input class="form-input" id="localisation" type="text" name="localisation">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="postal_code">BP *</label>
                                <input class="form-input" id="postal_code" type="text" name="postal_code">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="phone">Téléphone *</label>
                                <input class="form-input" id="phone" type="tel" name="phone">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="number_commercant">N° Carte de commerçant *</label>
                                <input class="form-input" id="number_commercant" type="text" name="number_commercant">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="activity">Activité *</label>
                                <input class="form-input" id="activity" type="text" name="activity">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="number_statistic">N° Statistique *</label>
                                <input class="form-input" id="number_statistic" type="text" name="number_statistic">
                            </div>
                            <div class="form-wrap postfix-xl-right-40">
                                <label class="form-label" for="rccm">N° RCCM *</label>
                                <input class="form-input" id="rccm" type="text" name="rccm">
                            </div>
                        </div>

                    </div>
                </div>
                <br><br>
                <h3 style="font-weight: 700">Produits</h3>
                <br>
                <div class="row" style="margin-top: 0px;">
                    <div class="col-xl-4 col-lg-6">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="type_product">Nature des marchandises *</label>
                            <input class="form-input" id="type_product" type="text" name="type_product" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="country_origin">Pays d'origine *</label>
                            <input class="form-input" id="country_origin" type="text" name="country_origin" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="country_from">Pays de Provenance *</label>
                            <input class="form-input" id="country_from" type="text" name="country_from" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="destination">Destination *</label>
                            <input class="form-input" id="destination" type="text" name="destination" required>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="dock_loading">Port d'embarquement *</label>
                            <input class="form-input" id="dock_loading" type="text" name="dock_loading" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="dock_unloading">Port de débarquement *</label>
                            <input class="form-input" id="dock_unloading" type="text" name="dock_unloading" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="value">Valeur de la marchandise *</label>
                            <input class="form-input" id="value" type="number" name="value" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="type_transaport">Moyen de transport *</label>
                            <input class="form-input" id="type_transaport" type="text" name="type_transaport"
                                required>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="facture_number">N° de Facture pro-forma *</label>
                            <input class="form-input" id="facture_number" type="text" name="facture_number" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="facture_url">Téléverser la facture pro-forma *</label>
                            <br><br>
                            <input class="form-control" id="facture_url" type="file" name="facture_url" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="weight">Tonnage *</label>
                            <input class="form-input" id="weight" type="number" name="weight" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="quantity">Quantité *</label>
                            <input class="form-input" id="quantity" type="number" name="quantity" required>
                        </div>
                        <div class="form-wrap postfix-xl-right-40">
                            <label class="form-label" for="transitaire">Transitaire *</label>
                            <input class="form-input" id="transitaire" type="text" name="transitaire" required>
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
        function viewSociete() {
            var entreprise_id = document.getElementById("entreprise_id");
            var societe = document.getElementById("societe");

            if (entreprise_id.value == 0) {
                societe.style.display = "block";
            } else {
                societe.style.display = "none";
            }
        }
    </script>
@endpush
