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
                    <h4>Rôles</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('admin/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Gestion des utilisateurs</li>
                        <li class="breadcrumb-item active">Rôles</li>
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
                                    data-bs-target="#securityModal"><i class="fa fa-plus"></i>Ajouter un rôle</a>
                            </div>
                        </div>
                        <div class="list-product">
                            <table class="table" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type d'utilisateur</th>
                                        <th>Libellé</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->user_type['name'] }}</td>
                                            <td>{{ $role['name'] }}</td>
                                            <td>{{ $role['description'] }}</td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-dark" data-bs-toggle="modal"
                                                    data-bs-target="#cardModal{{ $role->id }}">Modifer</button>
                                                <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#cardModalCenter{{ $role->id }}">
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
                    <h5 class="modal-title" id="exampleModalLabelOne">Créer un rôle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/role') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_type_id" class="col-form-label">Type d'utilisateur</label>
                            <select id="selectOne" class="form-control" name="user_type_id">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}">{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="col-form-label">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>

                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">Privilèges</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-500 fw-semibold">
                                        @foreach ($privileges as $pr)
                                            <!--begin::Table row-->
                                            <tr>
                                                <!--begin::Label-->
                                                <td class="text-gray-500">{{ $pr['name'] }}</td>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <td>
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex">
                                                        <!--begin::Checkbox-->
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $pr->id }}" name="privileges[]" />
                                                        </label>
                                                        <!--end::Checkbox-->

                                                    </div>
                                                    <!--end::Wrapper-->
                                                </td>
                                                <!--end::Options-->
                                            </tr>
                                            <!--end::Table row-->
                                        @endforeach


                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($roles as $role)
        <div class="modal fade" id="cardModal{{ $role->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabelOne" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour un rôle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('admin/role/edit/' . $role->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_type_id" class="col-form-label">Type d'utilisateur</label>
                                <select id="selectOne" class="form-control" name="user_type_id">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->id == $role->user_type->id ? 'selected' : '' }}>
                                            {{ $type['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Nom</label>
                                <input type="text" class="form-control" name="name" value="{{ $role['name'] }}">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">Description</label>
                                <textarea class="form-control" name="description">{{ $role['description'] }}</textarea>
                            </div>

                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">Privilèges</label>
                                <!--end::Label-->
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-500 fw-semibold">
                                            @foreach ($privileges as $pr)
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-500">{{ $pr['name'] }}</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="{{ $pr->id }}"
                                                                    {{ App\Http\Controllers\Admin\RoleController::check_object($pr, $role->privileges) ? 'checked' : '' }}
                                                                    name="privileges[]" />
                                                            </label>
                                                            <!--end::Checkbox-->

                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->
                                            @endforeach


                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
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
                        Êtes-vous sûr de vouloir supprimer ce rôle ?
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
