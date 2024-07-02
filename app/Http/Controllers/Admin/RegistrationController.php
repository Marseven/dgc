<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compagnie;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    //
    public function index($event)
    {
        $event = Event::find($event);
        return view('admin.registration.index', compact('event'));
    }

    public function ajaxListAttendee(Request $request, $event)
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
        // Récupérer le nombre total d'enregistrements sans filtre
        $totalRecords = Registration::whereNull('deleted')->count();

        // Récupérer le nombre total d'enregistrements avec filtre
        $searchValue = isset($_GET['search']) ? $_GET['search'] : '';

        $totalRecordswithFilter = Registration::join('attendees', 'registrations.attendee_id', '=', 'attendees.id')
            ->where(function ($query) use ($searchValue) {
                $query->where('attendees.first_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('attendees.last_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('attendees.phone', 'like', '%' . $searchValue . '%');
            })
            ->whereNull('registrations.deleted')
            ->where('registrations.event_id', $event)
            ->count();

        // Récupérer les enregistrements avec pagination et tri
        $records = Registration::join('attendees', 'registrations.attendee_id', '=', 'attendees.id')
            ->where(function ($query) use ($searchValue) {
                $query->where('attendees.first_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('attendees.last_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('attendees.phone', 'like', '%' . $searchValue . '%');
            })
            ->whereNull('registrations.deleted')
            ->where('registrations.event_id', $event)
            ->orderBy($columnName, $columnSortOrder)
            ->select('registrations.*', 'attendees.first_name', 'attendees.last_name', 'attendees.phone', 'attendees.email')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['ticket']);

            $id = $record->id;

            $data_arr[] = array(
                "id" => $id,
                "last_name" => $record->last_name,
                "first_name" => $record->first_name,
                "phone" => $record->phone,
                "email" => $record->email,
                "ticket" => $record->ticket->name,
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

    public function ajaxListCompagnie(Request $request, $event)
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
        $totalRecords = Compagnie::select('count(*) as allcount')->where('deleted', NULL)->count();
        $totalRecordswithFilter = Compagnie::select('count(*) as allcount')
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('compagnies.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('compagnies.manager', 'like', '%' . $searchValue . '%')
                    ->orWhere('compagnies.phone', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)->where('compagnies.event_id', $event)->count();

        // Fetch records
        $records = Compagnie::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('compagnies.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('compagnies.manager', 'like', '%' . $searchValue . '%')
                    ->orWhere('compagnies.phone', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)
            ->where('compagnies.event_id', $event)
            ->select('compagnies.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $id = $record->id;

            $status = '<span class="badge badge-' . Controller::status($record->status)['type'] . '">' . Controller::status($record->status)['message'] . '</span>';

            $actions = '<button style="padding: 10px !important" type="button" class="btn btn-info modal_view_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView">
                                            <i class="icon-eye"></i>
                                        </button> ';

            if ($record->status == 'pending') {
                $actions .= ' <button style="padding: 10px !important" type="button" class="btn btn-primary modal_edit_action" data-bs-toggle="modal"
                            data-id="' . $record->id . '"
                            data-bs-target="#cardModalView">
                                                <i class="icon-pencil"></i>
                                            </button>';
            }

            $actions .= ' <button style="padding: 10px !important" type="button" class="btn btn-danger modal_delete_action" data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModalView">
                                            <i class="icon-trash"></i>
                                        </button>';

            $data_arr[] = array(
                "id" => $id,
                "name" => $record->name,
                "manager" => $record->manager,
                "address" => $record->address,
                "phone" => $record->phone,
                "email" => $record->email,
                "activity" => $record->activity,
                "status" => $status,
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
        $compagnie = Compagnie::find($request->id);

        $title = "";
        if ($request->action == "view") {
            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">La Demande N° : ' . $compagnie->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Nom de l\'entreprise </h6>
                            <p class="text-uppercase mb-0">' . $compagnie->name . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Représentant </h6>
                            <p class="mb-0">' . $compagnie->manager . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Email</h6>
                            <p class="mb-0">' . $compagnie->email . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Téléphone</h6>
                            <p class="mb-0">' . $compagnie->phone . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Activité</h6>
                            <p class="mb-0">' . $compagnie->activity . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Forme juridique</h6>
                            <p class="mb-0">' . $compagnie->legal_status . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Site Web</h6>
                            <p class="mb-0"><a target="_blank"
                            href="' . $compagnie->website . '">' . $compagnie->website . '<a></p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">N° Fiche Circuit</h6>
                            <p class="mb-0">' . $compagnie->business_circuit . '</p>
                        </div>
                        <div class="col-6 mb-5">
                            <h6 class="text-uppercase fs-5 ls-2">Fiche Circuit</h6>
                            <p class="mb-0"><a target="_blank"
                            href="' . asset($compagnie->business_url) . '">Voir la fiche circuit<a></p>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Adresse</h6>
                                <p class="mb-0">' . $compagnie->address . '</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Ville</h6>
                                <p class="mb-0">' . $compagnie->city . '</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Province</h6>
                                <p class="mb-0">' . $compagnie->state . '</p>
                            </div>
                            <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">Pays</h6>
                                <p class="mb-0">' . $compagnie->country . '</p>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-6 mb-5">
                                <h6 class="text-uppercase fs-5 ls-2">BP</h6>
                                <p class="mb-0">' . $compagnie->postal_code . '</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                </div>';
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour la demande N° : ' . $compagnie->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('admin/update/registration/' . $compagnie->id) . '" method="POST">
                <div class="modal-body">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Statut</label>
                            <select id="selectOne" class="form-control" name="status">
                                <option value="accepted">Accepté</option>
                                <option value="rejected">Rejetté</option>
                                <option value="missing_file">Dossier incomplet</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
            </form>';
        } else {

            $body = '
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Supprimer la demande N° : ' . $compagnie->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('admin/update/registration/' . $compagnie->id) . '" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="delete" value="true">
                    Êtes-vous sûr de vouloir supprimer cette demande ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
            ';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

    public function update(Request $request, $compagnie)
    {
        $compagnie = Compagnie::find($compagnie);

        if (isset($_POST['delete'])) {
            $compagnie->deleted = true;
            $compagnie->deleted_at = now();
            if ($compagnie->save()) {
                return back()->with('success', "La demande a été supprimée.");
            } else {
                return back()->with('error', "La demande n'a pas été supprimée.");
            }
        } else {
            $compagnie->status = $request->status;

            if ($compagnie->save()) {
                return back()->with('success', 'Demande mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }
}
