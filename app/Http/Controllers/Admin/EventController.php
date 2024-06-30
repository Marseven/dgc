<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //

    public function index()
    {
        return view('admin.event.index');
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
        $totalRecords = Event::select('count(*) as allcount')->where('deleted', NULL)->count();
        $totalRecordswithFilter = Event::select('count(*) as allcount')
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('events.title', 'like', '%' . $searchValue . '%')
                    ->orWhere('events.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('events.place', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)->count();

        // Fetch records
        $records = Event::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('events.title', 'like', '%' . $searchValue . '%')
                    ->orWhere('events.description', 'like', '%' . $searchValue . '%')
                    ->orWhere('events.place', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)
            ->select('events.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $id = $record->id;

            $picture = '<img style="width:50px; height:auto;" src="' . asset($record->picture) . '" />';

            $status = '<span class="badge badge-' . Controller::status($record->status)['type'] . '">' . Controller::status($record->status)['message'] . '</span>';

            $actions = '
            <a href="' . url('admin/registration/' . $record->id) . '">
                            <button style="padding: 10px !important" type="button" class="btn btn-info">
                                <i class="icon-eye"></i>
                            </button>
                        </a>
            <button style="padding: 10px !important" type="button" class="btn btn-primary modal_edit_action" data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModalView">
                                <i class="icon-pencil"></i>
                            </button>
                            <button style="padding: 10px !important" type="button" class="btn btn-danger modal_delete_action" data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModalView">
                                <i class="icon-trash"></i>
                            </button>';

            $data_arr[] = array(
                "id" => $id,
                "picture" => $picture,
                "title" => $record->title,
                "start_time" => date_format(date_create($record->start_time), 'd-m-Y H:i:s'),
                "end_time" => date_format(date_create($record->end_time), 'd-m-Y H:i:s'),
                "place" => $record->place,
                "status" => $status,
                "created_at" => date_format(date_create($record->created_at), 'd-m-Y'),
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
        $event = Event::find($request->id);

        $title = "";
        if ($request->action == "view") {
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour l\'évènement N° : ' . $event->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('admin/update/event/' . $event->id) . '" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="modal-body">
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Titre</label>
                                        <input class="form-control" name="title" type="text" value="' . $event->title . '" placeholder="Titre *"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea4" rows="3" required>' . $event->description . '</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input class="form-control" name="picture" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Date de début</label>
                                        <input class="form-control" type="datetime-local" id="start_time" value="' . $event->start_time . '" name="start_time"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label>Date de fin</label>
                                        <input class="form-control" type="datetime-local" id="end_time" value="' . $event->end_time . '" name="end_time"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div id="date-error" style="color: red; display: none;">La date de début doit être avant la date
                                de fin.</div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Lieu</label>
                                        <input class="form-control" name="place" type="text" value="' . $event->place . '" placeholder="Lieu *"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <label class="col-form-label m-r-10">Actif</label>
                                <div class="media-body text-end">
                                    <label class="switch">
                                    <input type="checkbox" name="status" ' . ($event->status == "active" ? "checked" : "") . ' ><span class="switch-state"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            ';
        } else {

            $body = '
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Supprimer l\'évènement N° : ' . $event->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('admin/update/event/' . $event->id) . '" method="POST">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <input type="hidden" name="delete" value="true">
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cet évènement ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>
                </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

    public function create(Request $request)
    {
        $event = new Event();

        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->place = $request->place;

        if ($request->file('picture')) {
            $picture = FileController::picture($request->file('picture'),);
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }
            $url = $picture['url'];
            $event->picture =  $url;
        }

        $event->user_id = Auth::user()->id;

        if ($event->save()) {
            return back()->with('success', 'Évènement créé avec succès.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function update(Request $request, $event)
    {
        $event = Event::find($event);

        if (isset($_POST['delete'])) {
            $event->deleted = true;
            $event->deleted_at = now();
            if ($event->save()) {
                return back()->with('success', "L'évènement a été supprimée.");
            } else {
                return back()->with('error', "L'évènement n'a pas été supprimée.");
            }
        } else {
            $event->title = $request->title;
            $event->description = $request->description;
            $event->start_time = $request->start_time;
            $event->end_time = $request->end_time;
            $event->place = $request->place;

            $event->status = $request->status == "on" ? "active" : "inactive";

            if ($request->file('picture')) {
                $picture = FileController::picture($request->file('picture'),);
                if ($picture['state'] == false) {
                    return back()->withErrors($picture['message'])->withInput();
                }
                $url = $picture['url'];
                $event->picture =  $url;
            }

            if ($event->save()) {
                return back()->with('success', 'Évènement mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }
}
