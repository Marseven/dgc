<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Activity;
use App\Models\Entreprise;
use App\Models\Importation;
use App\Models\Stock;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    //
    public function index()
    {
        $entreprises = Entreprise::count();
        $importations = Importation::count();
        $stocks = Stock::count();
        return view('admin.dashboard', compact('entreprises', 'importations', 'stocks'));
    }

    public function entreprise()
    {
        $entreprises = Entreprise::all();
        return view('admin.entreprise.entreprise', compact('entreprises'));
    }

    public function ajaxList(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
        $_GET['search'] = $search_arr['value'];

        // Total records
        $totalRecords = Entreprise::select('count(*) as allcount')->where('deleted', NULL)->count();
        $totalRecordswithFilter = Entreprise::select('count(*) as allcount')
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('entreprises.company_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')
                    ->orWhere('entreprises.number_commercant', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)->count();

        // Fetch records
        $records = Entreprise::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('entreprises.company_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')
                    ->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')
                    ->orWhere('entreprises.number_commercant', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)
            ->select('entreprises.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $id = $record->id;

            $record->load(['activity']);

            $localisation = $record->localisation ?? $record->hood;

            $actions = '
                        <button style="padding: 10px !important" type="button"
                        class="btn btn-info modal_view_action"
                        data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView">
                            <i class="icon-eye"></i>
                            </button>
                        <button style="padding: 10px !important" type="button"
                            class="btn btn-primary modal_edit_action"
                            data-bs-toggle="modal"
                            data-id="' . $record->id . '"
                            data-bs-target="#cardModalView">
                                <i class="icon-pencil"></i>
                                </button>';

            $data_arr[] = array(
                "id" => $id,
                "company_name" => $record->company_name,
                "phone" => $record->phone,
                "postal_code" => $record->postal_code,
                "activity" => $record->activity->name,
                "localisation" => $localisation,
                "created_at" => $record->created_at,
                "actions" => $actions,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        return response()->json($response);
    }

    public function ajaxItem(Request $request)
    {
        $entreprise = Entreprise::find($request->id);
        $entreprise->load(['activity']);

        $title = "";
        if ($request->action == "view") {
            $body = '
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Entreprise N° ' . $entreprise->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row"><div class="col-6 mb-5"><h6 class="text-uppercase fs-5 ls-2">Raison Sociale</h6>
                    <p class="text-uppercase mb-0">' . $entreprise->company_name . '</p>
                </div>
                <div class="row"><div class="col-6 mb-5"><h6 class="text-uppercase fs-5 ls-2">Activité</h6>
                    <p class="text-uppercase mb-0">' . $entreprise->activity->name . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Téléphone </h6>
                    <p class="mb-0">' . $entreprise->phone . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Email </h6>
                    <p class="mb-0">' . ($entreprise->email ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Localisation </h6>
                    <p class="mb-0">' . ($entreprise->localisation ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">BP </h6>
                    <p class="mb-0">' . $entreprise->postal_code . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Commune </h6>
                    <p class="mb-0">' . ($entreprise->commune ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Quartier </h6>
                    <p class="mb-0">' . ($entreprise->hood ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Fiche circuit </h6>
                    <p class="mb-0">' . ($entreprise->business_circuit ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">N° Commerçant </h6>
                    <p class="mb-0">' . $entreprise->number_commercant . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">N° Statistique </h6>
                    <p class="mb-0">' . ($entreprise->number_statistic ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">RCCM </h6>
                    <p class="mb-0">' . $entreprise->rccm . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">NIF </h6>
                    <p class="mb-0">' . ($entreprise->nif ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Forme Juridique </h6>
                    <p class="mb-0">' . ($entreprise->legal_status ?? "-") . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Date de création
                    </h6>
                    <p class="mb-0">' . ($entreprise->date_create != null ?  date_format(date_create($entreprise->date_create), 'd-m-Y') : date_format(date_create($entreprise->created_at), 'd-m-Y')) . '</p>
                </div>
            </div>
            ';
        } elseif ($request->action == "edit") {
            $activities = Activity::where('type', 'entreprise')->where('deleted', NULL)->get();
            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour l\'entreprise N° ' . $entreprise->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <form action="' . url('update/entreprise/' . $entreprise->id) . '" method="POST">
                <div class="modal-body">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="company_name">Raison Sociale *</label>
                                <input class="form-control" id="company_name" type="text" value="' . $entreprise->company_name . '" name="company_name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Activité de l\'entreprise : </label>
                            <select name="activity_id" class="form-control form-control-solid form-control-lg">';

            foreach ($activities as $activity) {
                $body .= '<option ' . ($activity->id == $entreprise->activity->id ? 'selected' : '') . ' value="' . $activity->id . '">' . $activity->name . '</option>';
            }

            $body .= '    </select>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="phone">Téléphone *</label>
                                <input class="form-control" id="phone" type="text" value="' . $entreprise->phone . '" name="phone" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="email">Email *</label>
                                <input class="form-control" id="email" type="email" value="' . $entreprise->email . '" name="email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="postal_code">BP *</label>
                                <input class="form-control" id="postal_code" type="text" value="' . $entreprise->postal_code . '" name="postal_code" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="localisation">Localisation </label>
                                <input class="form-control" id="localisation" type="text" value="' . $entreprise->localisation . '" name="localisation">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="commune">Commune </label>
                                <input class="form-control" id="commune" type="text" value="' . $entreprise->commune . '" name="commune">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="hood">Quartier</label>
                                <input class="form-control" id="hood" type="text" value="' . $entreprise->hood . '" name="hood">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="business_circuit">Fiche Circuit</label>
                                <input class="form-control" id="business_circuit" type="text" value="' . $entreprise->business_circuit . '" name="business_circuit">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="number_commercant">N° Commerçant *</label>
                                <input class="form-control" id="number_commercant" type="text" value="' . $entreprise->number_commercant . '" name="number_commercant" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="number_statistic">N° Statistique *</label>
                                <input class="form-control" id="number_statistic" type="text" value="' . $entreprise->number_statistic . '" name="number_statistic">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="rccm">RCCM *</label>
                                <input class="form-control" id="rccm" type="text" value="' . $entreprise->rccm . '" name="rccm" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="nif">NIF</label>
                                <input class="form-control" id="nif" type="text" value="' . $entreprise->nif . '" name="nif">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="legal_status">Forme Juridique</label>
                                <input class="form-control" id="legal_status" type="text" value="' . $entreprise->legal_status . '" name="legal_status">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="date_create">Date de Création</label>
                                <input class="form-control" id="date_create" type="date" value="' . $entreprise->date_create . '" name="date_create">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
            </form>';
        } else {
            $body = '
            <form method="POST" action="' . url('admin/entreprise/' . $request->id) . '">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="delete" value="true">
                <button class="btn btn-danger" type="submit">Supprimer</button>
            </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

    public function update(Request $request, Entreprise $entreprise)
    {
        $entreprise->company_name = $request->company_name;
        $entreprise->postal_code = $request->postal_code;
        $entreprise->phone = $request->phone;
        $entreprise->localisation = $request->localisation;
        $entreprise->number_commercant = $request->number_commercant;
        $entreprise->number_statistic = $request->number_statistic;
        $entreprise->rccm = $request->rccm;
        $entreprise->activity_id = $request->activity_id;
        $entreprise->email = $request->email;
        $entreprise->commune = $request->commune;
        $entreprise->hood = $request->hood;
        $entreprise->business_circuit = $request->business_circuit;
        $entreprise->nif = $request->nif;
        $entreprise->date_create = $request->date_create;
        $entreprise->legal_status = $request->legal_status;

        if ($entreprise->save()) {
            return back()->with('success', "La déclaration a été mise à jour avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }
}
