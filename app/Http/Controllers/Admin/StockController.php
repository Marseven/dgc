<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Activity;
use App\Models\DeclarationType;
use App\Models\Logistic;
use App\Models\ProductType;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //
    public function index()
    {
        return view('admin.stock.stock');
    }

    public function item(Stock $stock)
    {
        $activities_st = Activity::where('type', 'stock')->where('deleted', NULL)->get();
        $declarations = DeclarationType::where('deleted', NULL)->get();
        $products = ProductType::where('deleted', NULL)->get();
        $logistics = Logistic::where('deleted', NULL)->get();
        $stock->load(['entreprise', 'type_declaration', 'type_product', 'logistic', 'activity']);
        return view('admin.stock.item', compact('stock', 'activities_st', 'products', 'logistics', 'declarations'));
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
        $totalRecords = Stock::select('count(*) as allcount')->where('deleted', NULL)->count();
        $totalRecordswithFilter = Stock::select('count(*) as allcount')
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('stocks.id', 'like', '%' . $searchValue . '%')
                    ->orWhere('stocks.ville', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)->count();

        // Fetch records
        $records = Stock::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue = isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('stocks.id', 'like', '%' . $searchValue . '%')
                    ->orWhere('stocks.ville', 'like', '%' . $searchValue . '%');
            })->where('deleted', NULL)
            ->select('stocks.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['entreprise', 'entreprise.activity_ent', 'type_declaration', 'type_product', 'logistic', 'activity_st']);

            $id = $record->id;

            $actions = '
                        <a href="' . url('admin/stock/' . $record->id) . '">
                            <button style="padding: 10px !important" type="button"
                                class="btn btn-info">
                                <i class="icon-eye"></i>
                            </button>
                        </a>
                        <a href="' . url('export/stock/' . $record->id) . '">
                        <button style="padding: 10px !important" type="button"
                            class="btn btn-primary">
                            <i class="icon-download"></i>
                        </button></a>';

            $data_arr[] = array(
                "id" => $id,
                "societe" => $record->entreprise->company_name,
                "activity" => $record->activity_st->name,
                "declaration" => $record->type_declaration->name,
                "product" => $record->type_product->name,
                "ville" => $record->ville,
                "logistic" => $record->logistic->name,
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
        $stock = Stock::find($request->id);

        $title = "";
        if ($request->action == "view") {
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour la déclaration N° : ' . $stock->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('update/stock/' . $stock->id) . '" method="POST">
                <div class="modal-body">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="type_product">Nature des marchandises *</label>
                                <input class="form-control" id="type_product" type="text" value="' . $stock->type_product . '" name="type_product" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="country_origin">Pays d\'origine *</label>
                                <input class="form-control" id="country_origin" type="text" value="' . $stock->country_origin . '" name="country_origin" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="country_from">Pays de Provenance *</label>
                                <input class="form-control" id="country_from" type="text" value="' . $stock->country_from . '" name="country_from" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="destination">Destination *</label>
                                <input class="form-control" id="destination" type="text" value="' . $stock->destination . '" name="destination" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="dock_loading">Port d\'embarquement *</label>
                                <input class="form-control" id="dock_loading" type="text" value="' . $stock->type_product . '" name="dock_loading" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="dock_unloading">Port de débarquement *</label>
                                <input class="form-control" id="dock_unloading" type="text" value="' . $stock->dock_unloading . '" name="dock_unloading" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="value">Valeur de la marchandise *</label>
                                <input class="form-control" id="value" type="text" value="' . $stock->value . '" name="value" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="type_transaport">Moyen de transport *</label>
                                <input class="form-control" id="type_transaport" type="text" value="' . $stock->type_transaport . '" name="type_transaport" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="facture_number">N° de Facture pro-forma *</label>
                                <input class="form-control" id="facture_number" type="text" value="' . $stock->facture_number . '" name="facture_number" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="weight">Tonnage *</label>
                                <input class="form-control" id="weight" type="number" value="' . $stock->weight . '" name="weight" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="quantity">Quantité *</label>
                                <input class="form-control" id="quantity" type="number" value="' . $stock->quantity . '" name="quantity" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="transitaire">Transitaire *</label>
                                <input class="form-control" id="transitaire" type="text" value="' . $stock->transitaire . '" name="transitaire" required>
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
            <form method="POST" action="' . url('stock/' . $request->id) . '">
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

    public function update(Request $request, Stock $stock)
    {
        $stock->service = $request->service;
        $stock->referent = $request->referent;
        $stock->referent_contact = $request->referent_contact;
        $stock->activity_id = $request->activity_id;
        $stock->declaration_type_id = $request->declaration_type_id;
        $stock->product_type_id = $request->product_type_id;
        $stock->logistic_id = $request->logistic_id;
        $stock->province = $request->province;
        $stock->ville = $request->ville;

        if ($request->file('file_product_url')) {
            $picture = FileController::stock($request->file('file_product_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $url = $picture['url'];
            $stock->file_product_url =  $url;
        }

        if ($stock->save()) {
            return back()->with('success', "La déclaration a été mise à jour avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function export($id)
    {
        $stock = Stock::with('entreprise', 'type_declaration', 'type_product', 'logistic', 'activity')->find($id);
        $activities_st = Activity::where('type', 'stock')->where('deleted', NULL)->get();
        $declarations = DeclarationType::where('deleted', NULL)->get();
        $products = ProductType::where('deleted', NULL)->get();
        $logistics = Logistic::where('deleted', NULL)->get();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.stock', compact('stock', 'activities_st', 'products', 'logistics', 'declarations'));

        $outputPath = 'Declaration_Stock_' . $id . '.pdf';

        return $pdf->download($outputPath);
    }

    public function note(Request $request, Stock $stock)
    {
        $stock->note_administration = $request->note;

        if ($stock->save()) {
            return back()->with('success', "Note ajoutée avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }
}
