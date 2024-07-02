@extends('layout.default')

@push('styles')
    <style>
        /* styles.css */
        .nav-pills {
            list-style: none;
            padding: 0;
            display: flex;
            margin-bottom: 20px;
        }

        .nav-pills .nav-item {
            margin-right: 10px;
        }

        .nav-pills .nav-link {
            background-color: #f8f9fa;
            border: 1px solid #f8f9fa;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #424bd5;
            border: 1px solid #424bd5;
            color: #fff;
        }

        .nav-pills .nav-link:hover {
            background-color: #424bd5;
            border: 1px solid #424bd5;
            color: #fff;
        }

        .tab-content {
            padding: 20px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .fade {
            opacity: 0;
            transition: opacity 0.5s;
        }

        .show {
            opacity: 1;
        }
    </style>
@endpush

@section('content')
    <section class="breadcrumb-classic bg-image"
        style="background-image: url('{{ asset('front/images/breadcrumbs-parallax-07.png') }}')">
        <div class="container">
            <div class="row">
                <ul class="list-breadcrumb">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li>{{ $event->title }}</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-75 section-md-120 section-lg-120 section-xl-150" id="custom-way-point">
        <div class="container text-left">
            @include('layout.alert')
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-target="#pills-home" type="button"
                        role="tab" aria-controls="pills-home" aria-selected="true">Inscription Particulier</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-target="#pills-contact" type="button"
                        role="tab" aria-controls="pills-contact" aria-selected="false">Demande de Stand pour
                        Entreprise</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">

                    <h2>Inscription particulier pour l'évènement</h2>
                    <form method="post" action="{{ url('attendee/' . $event->id) }}">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <br>
                        <div class="row" style="margin-top: 0px;">
                            <div class="col-xl-6 col-lg-8">
                                <div class="form-wrap postfix-xl-right-40">
                                    <label for="entreprise_id">Sélectionnez votre ticket </label>
                                    <select class="form-input" id="entreprise_id" name="ticket_id">
                                        <option value="0">Choisissez votre société</option>
                                        @foreach ($tickets as $ticket)
                                            <option value="{{ $ticket->id }}">{{ $ticket->name }} -
                                                {{ round($ticket->price) }}
                                                FCFA</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div id="attendee">
                            <div class="row" style="margin-top: 0px;">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="last_name">Nom *</label>
                                        <input class="form-input" id="last_name" type="text" name="last_name" required>
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="phone">Téléphone *</label>
                                        <input class="form-input" id="phone" type="tel" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="first_name">Prénom *</label>
                                        <input class="form-input" id="first_name" type="text" name="first_name" required>
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="email">Email *</label>
                                        <input class="form-input" id="email" type="email" name="email" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-form btn-default" type="submit">Valider</button>
                    </form>

                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">

                    <h2>Demande de stand pour une entreprise</h2>
                    <br>
                    <form method="post" action="{{ url('compagnie/' . $event->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <div id="societe">
                            <div class="row" style="margin-top: 0px;">
                                <div class="col-xl-4 col-lg-6">
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="name">Nom de l'entreprise *</label>
                                        <input class="form-input" id="name" type="text" name="name">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="manager">Nom du Gérant ou Représentant *</label>
                                        <input class="form-input" id="manager" type="text" name="manager">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="activity">Activité *</label>
                                        <input class="form-input" id="activity" type="text" name="activity">
                                    </div>

                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="phone">Téléphone *</label>
                                        <input class="form-input" id="phone" type="tel" name="phone">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="email">Email *</label>
                                        <input class="form-input" id="email" type="email" name="email">
                                    </div>


                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="adress">Adresse *</label>
                                        <input class="form-input" id="adress" type="text" name="adress">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="city">Ville *</label>
                                        <input class="form-input" id="city" type="text" name="city">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="state">Province *</label>
                                        <input class="form-input" id="state" type="text" name="state">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="country">Pays *</label>
                                        <input class="form-input" id="country" type="text" name="country">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="postal_code">BP *</label>
                                        <input class="form-input" id="postal_code" type="text" name="postal_code">
                                    </div>
                                </div>

                                <div class="col-xl-4">

                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="business_circuit">N° Fiche Circuit *</label>
                                        <input class="form-input" id="business_circuit" type="text"
                                            name="business_circuit">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="business_url">Téléverser la fiche circuit</label>
                                        <br><br>
                                        <input class="form-control" id="business_url" type="file"
                                            name="business_url">
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="legal_status">Forme Juridique *</label>
                                        <input class="form-input" id="legal_status" type="text" name="legal_status"
                                            required>
                                    </div>
                                    <div class="form-wrap postfix-xl-right-40">
                                        <label for="website">Site</label>
                                        <input class="form-input" id="website" type="text" name="website">
                                    </div>

                                </div>

                            </div>
                        </div>
                        <br><br>
                        <button class="btn btn-form btn-default" type="submit">Soumettre</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabLinks = document.querySelectorAll('.nav-link');
            const tabPanes = document.querySelectorAll('.tab-pane');

            tabLinks.forEach(link => {
                link.addEventListener('click', function() {
                    // Remove active class from all links
                    tabLinks.forEach(link => link.classList.remove('active'));

                    // Remove active and show classes from all panes
                    tabPanes.forEach(pane => {
                        pane.classList.remove('active');
                        pane.classList.remove('show');
                        pane.classList.add('fade');
                    });

                    // Add active class to the clicked link
                    link.classList.add('active');

                    // Get the target pane and add active and show classes
                    const targetPane = document.querySelector(link.getAttribute('data-target'));
                    targetPane.classList.add('active');
                    setTimeout(() => {
                        targetPane.classList.add('show');
                    }, 100);
                });
            });

            // Ensure the first tab is shown by default
            const firstLink = tabLinks[0];
            const firstPane = document.querySelector(firstLink.getAttribute('data-target'));
            firstLink.classList.add('active');
            firstPane.classList.add('active');
            firstPane.classList.add('show');
        });
    </script>
@endpush
