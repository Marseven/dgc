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

            $actions = '<a href="' . url('admin/ticket/' . $record->id) . '">
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
}
