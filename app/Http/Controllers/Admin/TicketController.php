<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        $events = Event::all();
        return view('admin.ticket.index', compact('events'));
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
        $totalRecords = Ticket::select('count(*) as allcount')->where('deleted', NULL)->count();
        $totalRecordswithFilter = Ticket::select('count(*) as allcount')
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('tickets.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('tickets.price', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)->count();

        // Fetch records
        $records = Ticket::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('tickets.name', 'like', '%' . $searchValue . '%')
                    ->orWhere('tickets.price', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)
            ->select('tickets.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['event']);

            $id = $record->id;

            $actions = '<button style="padding: 10px !important" type="button" class="btn btn-info modal_edit_action" data-bs-toggle="modal"
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
                "event_id" => $record->event->title,
                "name" => $record->name,
                "price" => round($record->price) . ' FCFA',
                "quantity" => $record->quantity,
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
        $ticket = Ticket::find($request->id);

        $title = "";
        if ($request->action == "view") {
        } elseif ($request->action == "edit") {
            $ticket->load(['event']);
            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le ticket N° : ' . $ticket->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('admin/update/ticket/' . $ticket->id) . '" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="modal-body">
                        <div class="form theme-form">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Évènement</label>
                                        <input class="form-control" value="' . $ticket->event->title . '" type="text" placeholder="Nom *"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Nom</label>
                                        <input class="form-control" name="name" type="text" value="' . $ticket->name . '" placeholder="Nom *"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Prix</label>
                                        <input class="form-control" name="price" type="number" value="' . $ticket->price . '" placeholder="Prix *"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label>Quantité</label>
                                        <input class="form-control" name="quantity" type="number" value="' . $ticket->quantity . '" placeholder="0*"
                                            required>
                                    </div>
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
                <h5 class="modal-title" id="exampleModalLabelOne">Supprimer le ticket N° : ' . $ticket->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('admin/update/ticket/' . $ticket->id) . '" method="POST">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <input type="hidden" name="delete" value="true">
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce ticket ?
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
        $ticket = new Ticket();

        $ticket->name = $request->name;
        $ticket->price = $request->price;
        $ticket->quantity = $request->quantity;
        $ticket->event_id = $request->event_id;

        if ($ticket->save()) {
            return back()->with('success', 'Ticket créé avec succès.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function update(Request $request, $ticket)
    {
        $ticket = Ticket::find($ticket);
        if (isset($_POST['delete'])) {
            $ticket->deleted = true;
            $ticket->deleted_at = now();
            if ($ticket->save()) {
                return back()->with('success', "Le ticket a été supprimée.");
            } else {
                return back()->with('error', "Le ticket n'a pas été supprimée.");
            }
        } else {
            $ticket->name = $request->name;
            $ticket->price = $request->price;
            $ticket->quantity = $request->quantity;

            if ($ticket->save()) {
                return back()->with('success', 'Ticket mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }
}
