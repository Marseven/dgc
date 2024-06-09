<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Importation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportationController extends Controller
{
    //
    public function index()
    {
        return view('admin.importation.importation');
    }

    public function item(Importation $importation)
    {
        return view('admin.importation.item', compact('importation'));
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
        $totalRecords = Importation::select('count(*) as allcount')->where('deleted', NULL)->count();
        $totalRecordswithFilter = Importation::select('count(*) as allcount')
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('importations.facture_number', 'like', '%' . $searchValue . '%')
                    ->orWhere('importations.country_from', 'like', '%' . $searchValue . '%')
                    ->orWhere('importations.transitaire', 'like', '%' . $searchValue . '%')
                    ->orWhere('importations.destination', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)->count();

        // Fetch records
        $records = Importation::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('importations.facture_number', 'like', '%' . $searchValue . '%')
                    ->orWhere('importations.country_from', 'like', '%' . $searchValue . '%')
                    ->orWhere('importations.transitaire', 'like', '%' . $searchValue . '%')
                    ->orWhere('importations.destination', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)
            ->select('importations.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['entreprise']);

            $id = $record->id;

            $facture_number = '<a target="_blank"
            href="' . asset($record->facture_url) . '">' . ($record->facture_number ?? 'Télécharger') . '</a>';

            $actions = '
                        <a href="' . url('admin/importation/' . $record->id) . '">
                            <button style="padding: 10px !important" type="button" class="btn btn-info">
                                <i class="icon-eye"></i>
                            </button>
                        </a>
                        <a href="' . url('admin/export/' . $record->id) . '">
                            <button style="padding: 10px !important" type="button" class="btn btn-primary">
                                <i class="icon-download"></i>
                            </button>
                        </a>';

            $data_arr[] = array(
                "id" => $id,
                "societe" => $record->entreprise->company_name,
                "type_product" => $record->type_product,
                "country_from" => $record->type_product,
                "destination" => $record->type_product,
                "facture_number" => $facture_number,
                "value" => $record->value . ' FCFA',
                "weight" => $record->weight . ' T',
                "transitaire" => $record->transitaire,
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

    public function update(Request $request, Importation $importation)
    {
        $importation->type_product = $request->type_product;
        $importation->country_origin = $request->country_origin;
        $importation->country_from = $request->country_from;
        $importation->destination = $request->destination;
        $importation->dock_loading = $request->dock_loading;
        $importation->dock_unloading = $request->dock_unloading;
        $importation->value = $request->value;
        $importation->type_transaport = $request->type_transaport;
        $importation->weight = $request->weight;
        $importation->quantity = $request->quantity;
        $importation->facture_number = $request->facture_number;
        $importation->transitaire = $request->transitaire;
        $importation->zone = $request->zone;
        $importation->phone_transitaire = $request->phone_transitaire;

        if ($request->file('facture_url')) {
            $picture = FileController::importation($request->file('facture_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $url = $picture['url'];
            $importation->facture_url =  $url;
        }

        if ($request->file('business_url')) {
            $picture = FileController::importation($request->file('business_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->business_url =  $url;
        }

        if ($request->file('cni_url')) {
            $picture = FileController::importation($request->file('cni_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->cni_url =  $url;
        }

        if ($request->file('tresor_url')) {
            $picture = FileController::importation($request->file('tresor_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->tresor_url =  $url;
        }

        if ($importation->save()) {
            return back()->with('success', "La déclaration a été mise à jour avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function export($id)
    {
        $importation = Importation::with('entreprise', 'entreprise.activity_ent')->find($id);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.importation', compact('importation'));

        $outputPath = 'Declaration_Importation_' . $id . '.pdf';

        return $pdf->download($outputPath);
    }
}
