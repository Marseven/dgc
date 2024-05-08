<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\RolePrivilege;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    //

    public function index()
    {
        $privileges = Privilege::all();
        $types = UserType::all();
        $roles = Role::all();

        return view('admin.user.role', compact('roles', 'privileges', 'types'));
    }

    public function save(Request $request)
    {
        $object = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_type_id' => $request->user_type_id
        ]);

        if ($object) {
            if (!empty($request->privileges)) {
                foreach ($request->privileges as $pr) {
                    RolePrivilege::create([
                        'privilege_id' => $pr,
                        'role_id' => $object->id,
                        'user_type_id' => $request->user_type_id
                    ]);
                }
            }

            return back()->with('success', "Rôle créé avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function delete($id)
    {
        $object_pr = RolePrivilege::where('role_id', $id)->delete();
        $object = Role::where('id', $id)->delete();

        if ($object) {
            return back()->with('success', "Rôle supprimé avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request)
    {
        //
        $role = Role::find($request->id);

        $privileges = Privilege::all();
        $types = UserType::all();

        if ($role) {
            if ($request->action == "edit") {

                $body = '
                <!--begin::Form-->
                <form id="kt_modal_add_role_form" class="form" action="' . url('admin/role/edit/' . $role->id) . '"
                    method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header"
                        data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Type d\'utilisateur</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-control form-control-solid" name="user_type_id" required>';
                foreach ($types as $type) {
                    $body .= '<option ' . ($type->id == $role->user_type->id ? 'selected' : '') . '  value="' . $type->id . '">' . $type->name . '</option>';
                }

                $body .= ' </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Libellé</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Libellé" value="' . $role->name . '"
                                name="name" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Description</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" name="description" required>' . $role->description . '</textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label
                                class="fs-5 fw-bold form-label mb-2">Privilèges</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                        <!--begin::Table row-->
                                        <tr>
                                            <td class="text-gray-800">
                                            Privilèges administrateurs
                                                <span class="ms-2" data-bs-toggle="popover"
                                                    data-bs-trigger="hover" data-bs-html="true"
                                                    data-bs-content="Allows a full access to the system">
                                                    <i class="ki-duotone ki-information fs-7">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </span>
                                            </td>
                                            <td>
                                                <!--begin::Checkbox-->
                                                <label
                                                    class="form-check form-check-custom form-check-solid me-9">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="" id="kt_roles_select_all" />
                                                    <span class="form-check-label"
                                                        for="kt_roles_select_all">Tout Sélectionner</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </td>
                                        </tr>
                                        <!--end::Table row-->';

                foreach ($privileges as $pr) {
                    $body .= '<!--begin::Table row-->
                                            <tr>
                                                <!--begin::Label-->
                                                <td class="text-gray-800">' . $pr->name . '</td>
                                                <!--end::Label-->
                                                <!--begin::Options-->
                                                <td>
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex">
                                                        <!--begin::Checkbox-->
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="' . $pr->id . '"  ' . (RoleController::check_object($pr, $role->privileges) ? 'checked' : '') . '
                                                                name="privileges[]" />
                                                        </label>
                                                        <!--end::Checkbox-->

                                                    </div>
                                                    <!--end::Wrapper-->
                                                </td>
                                                <!--end::Options-->
                                            </tr>
                                            <!--end::Table row-->';
                }



                $body .= ' </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Soumettre</span>
                            <span class="indicator-progress">Patientez...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->';
            }

            $response = array(
                "body" => $body,
            );

            return response()->json($response);
        } else {
            $role = [];
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->user_type_id = $request->user_type_id;

        if ($role->save()) {
            $role->load(['privileges']);

            $privileges = Privilege::all();

            foreach ($role->privileges as $prp) {
                if (!in_array($prp->id, $request->privileges)) {
                    RolePrivilege::where([
                        'privilege_id' => $prp->id,
                        'role_id' => $role->id,
                    ])->delete();
                }
            }

            foreach ($request->privileges as $pr) {
                $isPrivilegeAssigned = false;
                foreach ($role->privileges as $prp) {
                    if ($prp->id == $pr) {
                        $isPrivilegeAssigned = true;
                        break;
                    }
                }

                if (!$isPrivilegeAssigned) {
                    RolePrivilege::create([
                        'privilege_id' => $pr,
                        'role_id' => $role->id,
                        'user_type_id' => $role->user_type->id,
                    ]);
                }
            }

            return back()->with('success', "Rôle mis à jour avec succès.");
        } else {
            return back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function assignRole(Request $request, $id)
    {
    }

    //role
    public function privileges()
    {
        $privileges = Privilege::all();
        $types = UserType::all();

        return view('admin.user.privilege', compact('privileges', 'types'));
    }

    public function savePrivilege(Request $request)
    {

        $object = Privilege::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_type_id' => $request->user_type_id
        ]);

        if ($object) {
            return back()->with('success', "Privilege créé avec succès.");
        } else {
            return back()->with('error', "{{ $object->message ??  'Une erreur s\'est produite.' }}");
        }

        return back()->with('error', "Une erreur s'est produite.");
    }

    public function editPrivilege(Request $request)
    {
        //
        $privilege = Privilege::find($request->id);

        //user_types
        $types = UserType::all();

        if ($privilege) {

            if ($request->action == "edit") {

                $body = '
                <!--begin::Form-->
                <form id="kt_modal_add_role_form" class="form" action="' . url('admin/privilege/edit/' . $privilege->id) . '"
                    method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header"
                        data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Type d\'utilisateur</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-control form-control-solid" name="user_type_id" required>';
                foreach ($types as $type) {
                    $body .= '<option ' . ($type->id == $privilege->user_type_id ? 'selected' : '') . '  value="' . $type->id . '">' . $type->name . '</option>';
                }

                $body .= ' </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Libellé</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Libellé" value="' . $privilege->name . '"
                                name="name" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Description</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" name="description" required>' . $privilege->description . '</textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-roles-modal-action="cancel">Fermer</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Soumettre</span>
                            <span class="indicator-progress">Patientez...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->';
            }

            $response = array(
                "body" => $body,
            );

            return response()->json($response);
        } else {
            $role = [];
        }
    }

    public function updatePrivilege(Request $request, $id)
    {

        $privilege = Privilege::find($id);
        $privilege->name = $request->name;
        $privilege->description = $request->description;

        if ($privilege->save()) {
            return back()->with('success', "privilege mis à jour avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }

        return back()->with('error', "Une erreur s'est produite.");
    }


    static function check_object($object, $array)
    {
        $prExiste = false;

        foreach ($array as $ar) {
            if ($object->id == $ar->id) {
                $prExiste = true;
                break; // Sortir de la boucle dès que la correspondance est trouvée
            }
        }

        return $prExiste;
    }
}
