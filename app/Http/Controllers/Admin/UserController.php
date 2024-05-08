<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserType;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function userType()
    {
        $types = UserType::all();
        return view('admin.user.usertype', compact('types'));
    }

    public function profil()
    {
        return view('admin.user.profil');
    }

    public function users()
    {

        $users = User::with(['roles'])->where('deleted', NULL)->get();
        $types = UserType::all();
        $roles = Role::all();

        return view('admin.user.users', compact('users', 'types', 'roles'));
    }

    protected function validator(array $data)
    {

        //les rules de l'utilisateur
        $rules = [
            'email' => ['required', 'email', 'unique:users,email', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => [
                'required',
                'string',
                'max:15',
            ],
            'role_id' => ['required', 'integer', 'exists:roles,id']
        ];

        return Validator::make($data, $rules);
    }

    public function store(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' =>  Hash::make("bjkhbcebjkekznejn&&&?###jksçoà"),
            'role_id' => $request->role_id,
            'user_type_id' => 1,
        ]);

        if ($user) {
            UserRole::create([
                'role_id' => $request->role_id,
                'user_id' => $user->id,
            ]);
            $user->sendPasswordResetNotification(app('auth.password.broker')->createToken($user));
            return back()->with('success', "l'utilisateur a été créé avec succès.");
        } else {
            return back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function edit(Request $request)
    {
        //
        $user = User::find($request->id);


        if ($user) {

            if ($request->action == "edit") {
                $body = '
                <!--begin::Form-->
                    <form id="kt_modal_add_user_form" class="form" method="post" action="' . url('admin/user-update/' . $request->id) . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">

                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_user_header"
                            data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Prénom</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="firstname" value="' . $user->first_name . '"
                                    class="form-control form-control-solid mb-3 mb-lg-0" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nom</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="lastname" value="' . $user->last_name . '"
                                    class="form-control form-control-solid mb-3 mb-lg-0" />
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" value="' . $user->email . '" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Téléphone</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="tel" id="_phone" name="phone" value="' . $user->phone . '" class="form-control form-control-solid mb-3 mb-lg-0" />
                                <input id="_phone_code" type="hidden" name="phone_code" value="' . $user->phone_code . '" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-10">
                            <button type="reset" class="btn btn-light me-3"
                                data-kt-users-modal-action="cancel">Annuler</button>
                            <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">Soumettre</span>
                                <span class="indicator-progress">Patientez ...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                    ';
            } elseif ($request->action == "delete") {

                $body = '
                  <!--begin::Form-->
                  <form id="kt_modal_add_permission_form" class="form" action="' . url('admin/user-update/' . $request->id) . '" method="POST">
                      <input type="hidden" name="_token" value="' . csrf_token() . '">
                      <input type="hidden" name="delete" value="true">

                      <!--begin::Input group-->
                      <div class="fv-row mb-7">
                          <!--begin::Label-->
                          <p>test</p>
                          <!--end::Label-->
                      </div>
                      <!--end::Input group-->

                      <!--begin::Actions-->
                      <div class="text-center pt-15">
                          <button type="submit" class="btn btn-danger">
                              <span class="indicator-label">Supprimer</span>
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
            $user = [];
        }
    }

    public function assign(Request $request)
    {
        //
        $body = '';

        $roles = Role::all();
        $user = User::find($request->id);

        if ($user) {

            if ($request->action == "assign") {

                $body = '
                <!--begin::Form-->
                <form id="kt_modal_assign_user_form" class="form" method="POST" action="' . url('admin/user-assign-role/') . '">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="user_id" value="' . $user->id . '">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Rôles</label>
                            <!--end::Label-->
                            <!--begin::Roles-->';
                foreach ($roles as $role) {
                    $body .= '<!--begin::Input row-->
                    <div class="d-flex fv-row">
                        <!--begin::Radio-->
                        <div class="form-check form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input class="form-check-input me-3" name="role_id" type="radio"
                                value="' . $role->id . '" id="kt_modal_update_role_option_' . $role->id . '" ' . ($user->roles[0]->id == $role->id ? 'checked' : '') . ' />
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label" for="kt_modal_update_role_option_' . $role->id . '">
                                <div class="fw-bold text-gray-800">' . $role->name . '</div>
                                <div class="text-gray-600">' . $role->description . '</div>
                            </label>
                            <!--end::Label-->
                        </div>
                        <!--end::Radio-->
                    </div>
                    <!--end::Input row-->
                    <div class="separator separator-dashed my-5"></div>';
                }

                $body .= '</div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">Annuler</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Soumettre</span>
                            <span class="indicator-progress">Patientez ...
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
            $user = [];
        }
    }

    public function update(Request $request, User $user)
    {


        if ($request->has('delete') && $request->delete == true) {

            $object = $user->delete();

            if ($object) {
                return back()->with('success', "Utilisateur supprimé avec succès.");
            } else {
                return back()->with('error', "une erreur s'est produite");
            }
        }

        $user->last_name = $request->lastname;
        $user->first_name = $request->firstname;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($user->save()) {
            UserRole::create([
                'role_id' => $request->role_id,
                'user_id' => $user->id,
            ]);
            return back()->with('success', "L'utilisateur a été mis à jour avec succès.");
        } else {
            return back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function updateProfil(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($user->save()) {
            return back()->with('success', "Profil mis à jour");
        } else {
            return back()->with('error', "une erreur s'est produite.");
        }
    }

    public function assignRole(Request $request)
    {
        $rules = [
            'user_id' => ['required', 'integer', 'exists:users,id,deleted,NULL'],
            'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL', Rule::unique('user_roles')->where('user_id', $request->user_id)],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), $errors);
        }

        $object = UserRole::create($request->all());

        if ($object) {
            return back()->with('success', "Rôle a été assigné avec succès.");
        } else {
            return back()->with('error', 'Une erreur s\'est produite.');
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        // Vérifier que l'ancien mot de passe est correct
        if (!Hash::check($request->lastpassword, $user->password)) {
            return back()->with('error', "L'ancien mot de passe est incorrect.");
        }

        // Vérifier que le nouveau mot de passe et la confirmation sont identiques
        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', "Le nouveau mot de passe et la confirmation ne correspondent pas.");
        }

        // Mettre à jour le mot de passe de l'utilisateur
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', "Mot de passe mis à jour avec succès.");
    }
}
