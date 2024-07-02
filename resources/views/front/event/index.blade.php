@extends('layout.default')

@section('content')
    <section class="breadcrumb-classic bg-image"
        style="background-image: url('{{ asset('front/images/breadcrumbs-parallax-07.png') }}')">
        <div class="container">
            <div class="row">
                <ul class="list-breadcrumb">
                    <li><a href="{{ url('/') }}">Accueil</a></li>
                    <li>Évènements</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="section-75 section-md-120 section-lg-120 section-xl-150" id="custom-way-point">
        <div class="container text-left">
            @if ($events->count() > 0)
                <div class="row row-15 justify-content-sm-center">
                    @foreach ($events as $event)
                        <div class="col-md-9 col-lg-6">
                            <div class="box-info-custom"
                                style="background-image: url({{ $event->picture ? asset($event->picture) : 'images/home-3-01-735x394.jpg' }} );">
                                <div class="box-info-custom-inner">
                                    <h5 class="box-info-custom-title"><a href="{{ url('event/' . $event->id) }}">
                                            {{ $event->title }}</a></h5>
                                    <p>{{ $event->description }}</p>
                                    <p>Début : {{ date_format(date_create($event->start_time), 'd-m-Y H:i:s') }} <br> Fin :
                                        {{ date_format(date_create($event->end_time), 'd-m-Y H:i:s') }}</p>
                                    <p>Lieu : {{ $event->place }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination-container">
                    {{ $events->links('vendor.pagination.bootstrap-4') }}
                </div>
            @else
                <div class="alert alert-info" role="alert">Pas d'évènement pour le moment</div>
            @endif
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
