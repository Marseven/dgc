<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Activity;
use App\Models\Entreprise;
use App\Models\Importation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportationController extends Controller
{
    //
    public function index()
    {
        $activities = Activity::where('type', 'entreprise')->where('deleted', NULL)->get();
        $entreprises = Entreprise::where('business_circuit', NULL)->get();
        return view('front.importation.form', compact('activities', 'entreprises'));
    }

    public function create(Request $request)
    {
        if ($request->entreprise_id && $request->entreprise_id != 0) {
            $entreprise = Entreprise::find($request->entreprise_id);
        } else {
            $rules = [
                'company_name' => ['required', 'unique:entreprises'],
                'postal_code' => ['required'],
                'phone' => ['required'],
                'localisation' => ['required'],
                'number_commercant' => ['required'],
                'number_statistic' => ['required'],
                'rccm' => ['required'],
                'activity_id' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('error', $errors->first());
            }

            $entreprise = new Entreprise();

            $entreprise->company_name = $request->company_name;
            $entreprise->postal_code = $request->postal_code;
            $entreprise->phone = $request->phone;
            $entreprise->localisation = $request->localisation;
            $entreprise->number_commercant = $request->number_commercant;
            $entreprise->number_statistic = $request->number_statistic;
            $entreprise->rccm = $request->rccm;
            $entreprise->activity_id = $request->activity_id;
            $entreprise->save();
        }

        $importation = new Importation();

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
        $importation->entreprise_id = $entreprise->id;

        if ($request->file('facture_url')) {
            $picture = FileController::importation($request->file('facture_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $url = $picture['url'];
            $importation->facture_url =  $url;
        }

        if ($importation->save()) {
            return back()->with('success', "Votre déclaration a été soumise avec succès. Nous vous contacterons au plus tôt.");
        }
    }
}
