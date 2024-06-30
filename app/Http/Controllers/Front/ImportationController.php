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
        $entreprises = Entreprise::whereNot('nif', NULL)->get();
        return view('front.importation.form', compact('activities', 'entreprises'));
    }

    public function create(Request $request)
    {
        if ($request->entreprise_id && $request->entreprise_id != 0) {
            $entreprise = Entreprise::find($request->entreprise_id);
        } else {
            $rules = [
                'company_name' => ['required'],
                'postal_code' => ['required'],
                'phone' => ['required'],
                'commune' => ['required'],
                'hood' => ['required'],
                'number_commercant' => ['required'],
                'number_statistic' => ['required'],
                'rccm' => ['required'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('error', $errors->first())->withInput();
            }

            $entreprise = Entreprise::where('company_name', $request->company_name)->first();

            if ($entreprise == null) {
                $entreprise = new Entreprise();
            }

            $entreprise->company_name = $request->company_name;
            $entreprise->gerant = $request->gerant;
            $entreprise->postal_code = $request->postal_code;
            $entreprise->commune = $request->commune;
            $entreprise->arrond = $request->arrond;
            $entreprise->hood = $request->hood;
            $entreprise->phone = $request->phone;
            $entreprise->email = $request->email;
            $entreprise->number_commercant = $request->number_commercant;
            $entreprise->number_statistic = $request->number_statistic;
            $entreprise->business_circuit = $request->business_circuit;
            $entreprise->number_agrement = $request->number_agrement;
            $entreprise->rccm = $request->rccm;
            $entreprise->transitaire = $request->transitaire;
            $entreprise->adress_transitaire = $request->adress_transitaire;
            $entreprise->phone_transitaire = $request->phone_transitaire;
            $entreprise->provider = $request->provider;
            $entreprise->adress_provider = $request->adress_provider;

            if ($request->activity_id) {
                $entreprise->activity_id = $request->activity_id;
            } else {
                $entreprise->activity = $request->activity;
            }
            $entreprise->save();
        }

        $importation = new Importation();

        $importation->type_product = $request->type_product;
        $importation->country_origin = $request->country_origin;
        $importation->country_from = $request->country_from;
        $importation->destination = $request->destination;
        $importation->dock_loading = $request->dock_loading;
        $importation->dock_unloading = $request->dock_unloading;
        $importation->zone = $request->zone;
        $importation->value = $request->value;
        $importation->type_transaport = $request->type_transaport;
        $importation->weight = $request->weight;
        $importation->quantity = $request->quantity;
        $importation->facture_number = $request->facture_number;
        $importation->transitaire = $request->transitaire;
        $importation->phone_transitaire = $request->phone_transitaire;
        $importation->entreprise_id = $entreprise->id;
        $importation->date_start = $request->date_start;
        $importation->date_end = $request->date_end;
        $importation->status = "pending";

        if ($request->file('facture_url')) {
            $picture = FileController::importation($request->file('facture_url'), 'facture');
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->facture_url =  $url;
        }

        if ($request->file('business_url')) {
            $picture = FileController::importation($request->file('business_url'), 'fiche');
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->business_url =  $url;
        }

        if ($request->file('cni_url')) {
            $picture = FileController::importation($request->file('cni_url'), 'cni');
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->cni_url =  $url;
        }

        if ($request->file('tresor_url')) {
            $picture = FileController::importation($request->file('tresor_url'), 'tresor');
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message'])->withInput();
            }

            $url = $picture['url'];
            $importation->tresor_url =  $url;
        }

        if ($importation->save()) {
            return back()->with('success', "Votre déclaration a été soumise avec succès. Nous vous contacterons au plus tôt.");
        }
    }
}
