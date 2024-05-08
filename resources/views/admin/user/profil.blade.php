@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
@endpush

@php
    $user = App\Models\User::with('roles')->find(Auth::user()->id);
@endphp

@section('content')
    <!-- Container fluid -->

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Profil</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">{{ $user['last_name'] . ' ' . $user['first_name'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">

                @include('layout.alert')

                <!-- user profile first-style start-->
                <div class="col-sm-12">
                    <div class="card hovercard text-center">
                        <div class="cardheader"></div>
                        <div class="info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ttl-info text-end">
                                                <h6><i class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email</h6>
                                                <span>{{ $user['email'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                    <div class="user-designation">
                                        <div class="title"><a data-bs-original-title=""
                                                title="">{{ $user['last_name'] . ' ' . $user['first_name'] }}</a>
                                        </div>
                                        <div class="desc">
                                            {{ $user->roles->count() != 0 ? $user->roles->first()['name'] : 'Aucun' }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Téléphone</h6>
                                                <span>{{ $user['phone'] }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="follow">
                                <div class="row">
                                    <div class="col-6 text-md-end border-right">
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#userModal">Mettre à jour</button>
                                    </div>
                                    <div class="col-6 text-md-start">
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#passwordModal">Mot de passe</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/admin-user/' . $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" name="lastname" value="{{ $user['last_name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="col-form-label">Prénom</label>
                            <input type="text" class="form-control" name="firstname" value="{{ $user['first_name'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user['email'] }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Téléphone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $user['phone'] }}">
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

    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelOne"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('profil/password/' . $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Ancien mot de passe</label>
                            <input type="password" class="form-control" name="lastpassword">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nouveau mot de passe</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Confirmé le mot de passe</label>
                            <input type="password" class="form-control" name="password_confirmed">
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
@endsection

@push('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('admin/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <!--end::Page Vendors-->

    <script>
        $(document).ready(function() {
            $('#kt_datatable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                }
            });
        });
    </script>
@endpush
