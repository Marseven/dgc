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
                            <button style="padding: 10px !important" type="button" class="btn btn-secondary">
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
                "value" => $record->value,
                "weight" => $record->weight,
                "transitaire" => $record->transitaire,
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
        $importation = Importation::find($request->id);

        $title = "";
        if ($request->action == "view") {
            $importation->load(['user', 'service', 'cashbox', 'rubrique']);

            $title = "Transaction N°" . $importation->id;
            $body = ' <div class="row"><div class="col-6 mb-5"><h6 class="text-uppercase fs-5 ls-2">Type</h6>
                <p class="text-uppercase mb-0">' . $importation->type . '</p>
            </div>
            <div class="row"><div class="col-6 mb-5"><h6 class="text-uppercase fs-5 ls-2">Rubrique</h6>
                <p class="text-uppercase mb-0">' . $importation->rubrique->name . '</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Description </h6>
                <p class="mb-0">' . $importation->reason . '</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Montant
                </h6>
                <p class="mb-0">' . Controller::format_amount($importation->amount) . ' FCFA</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Date
                </h6>
                <p class="mb-0">' .  date_format(date_create($importation->date_cash), 'd-m-Y') . '</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Service
                </h6>
                <p class="mb-0">' . $importation->service->name . '</p>
            </div>
            ';
            if ($importation->piece_url) {
                $body .= '<div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Pièce Jointe
                    </h6>
                    <p class="mb-0"><a target="_blank" href="' . asset($importation->piece_url) . '"
                    class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                    data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end">Télécharger
                    <i class="ki-duotone ki-cloud-download">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i></a></p>
                </div>';
            }
            $body .= '<div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Ajouté par
                </h6>
                <p class="mb-0">' . $importation->user->lastname . ' ' . $importation->user->firstname . '</p>
            </div>';

            $body .= '</div>';
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour la déclaration N° : ' . $importation->id . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' . url('update/importation/' . $importation->id) . '" method="POST">
                <div class="modal-body">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="type_product">Nature des marchandises *</label>
                                <input class="form-control" id="type_product" type="text" value="' . $importation->type_product . '" name="type_product" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="country_origin">Pays d\'origine *</label>
                                <input class="form-control" id="country_origin" type="text" value="' . $importation->country_origin . '" name="country_origin" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="country_from">Pays de Provenance *</label>
                                <input class="form-control" id="country_from" type="text" value="' . $importation->country_from . '" name="country_from" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="destination">Destination *</label>
                                <input class="form-control" id="destination" type="text" value="' . $importation->destination . '" name="destination" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="dock_loading">Port d\'embarquement *</label>
                                <input class="form-control" id="dock_loading" type="text" value="' . $importation->type_product . '" name="dock_loading" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="dock_unloading">Port de débarquement *</label>
                                <input class="form-control" id="dock_unloading" type="text" value="' . $importation->dock_unloading . '" name="dock_unloading" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="value">Valeur de la marchandise *</label>
                                <input class="form-control" id="value" type="text" value="' . $importation->value . '" name="value" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="type_transaport">Moyen de transport *</label>
                                <input class="form-control" id="type_transaport" type="text" value="' . $importation->type_transaport . '" name="type_transaport" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="facture_number">N° de Facture pro-forma *</label>
                                <input class="form-control" id="facture_number" type="text" value="' . $importation->facture_number . '" name="facture_number" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="weight">Tonnage *</label>
                                <input class="form-control" id="weight" type="number" value="' . $importation->weight . '" name="weight" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="quantity">Quantité *</label>
                                <input class="form-control" id="quantity" type="number" value="' . $importation->quantity . '" name="quantity" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-style-1">
                                <label class="form-label" for="transitaire">Transitaire *</label>
                                <input class="form-control" id="transitaire" type="text" value="' . $importation->transitaire . '" name="transitaire" required>
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
            <form method="POST" action="' . url('admin/importation/' . $request->id) . '">
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

        if ($request->file('facture_url')) {
            $picture = FileController::importation($request->file('facture_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $url = $picture['url'];
            $importation->facture_url =  $url;
        }

        if ($importation->save()) {
            return back()->with('success', "La déclaration a été mise à jour avec succès.");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function export($id)
    {
        $importation = Importation::with('entreprise', 'entreprise.activity')->find($id);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.importation', compact('importation'));

        $outputPath = 'Declaration_Importation_' . $id . '.pdf';

        return $pdf->download($outputPath);
    }
}
