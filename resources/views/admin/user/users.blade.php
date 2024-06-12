@extends('layout.admin')

@push('styles')
    <link href="{{ asset('admin/css/vendors/datatables.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <!-- Container fluid -->
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Utilisateurs</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Gestion des utilisateurs</li>
                        <li class="breadcrumb-item active">Utilisateurs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <div class="container-fluid">
        <div class="row">

            @include('layout.alert')

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="list-product-header">
                            <div>
                                <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                    data-bs-target="#securityModal"><i class="fa fa-plus"></i>Ajouter un utilisateurs</a>
                            </div>
                        </div>
                        <div class="list-product">
                            <table class="table" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom Complet</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Rôle</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user['last_name'] . ' ' . $user['first_name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['phone'] }}</td>
                                            <td>{{ $user->roles->count() != 0 ? $user->roles->first()['name'] : 'Aucun' }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#cardModal{{ $user->id }}">Modifer</button>
                                                <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cardModalCenter{{ $user->id }}">
                                                    Supprimer
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tr>
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admn/user-create') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" name="last_name">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Prénom</label>
                            <input type="text" class="form-control" name="first_name">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Téléphone</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>

                        <div class="mb-3">
                            <label for="role_id" class="col-form-label">Rôle</label>
                            <select id="selectOne" class="form-control" name="role_id">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select>
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

    @foreach ($users as $user)
        <div class="modal fade" id="cardModal{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelOne" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour un utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/user-update/' . $user->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Nom</label>
                                <input type="text" class="form-control" name="last_name"
                                    value="{{ $user['last_name'] }}">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Prénom</label>
                                <input type="text" class="form-control" name="first_name"
                                    value="{{ $user['first_name'] }}">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user['email'] }}">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Téléphone</label>
                                <input type="tel" class="form-control" name="phone" value="{{ $user['phone'] }}">
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="col-form-label">Rôle</label>
                                <select id="selectOne" class="form-control" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->roles->count() != 0 && $user->roles->first()->id == $role->id ? 'checked' : '' }}>
                                            {{ $role['name'] }}</option>
                                    @endforeach
                                </select>
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

    @foreach ($roles as $role)
        <!-- Modal -->
        <div class="modal fade" id="cardModalCenter{{ $role->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suppression</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce utilisateur ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <a href="{{ url('admin/delete-role/' . $role->id) }}">
                            <button type="button" class="btn btn-danger">Supprimer</button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
