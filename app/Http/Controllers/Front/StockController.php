<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Activity;
use App\Models\DeclarationType;
use App\Models\Entreprise;
use App\Models\stock;
use App\Models\Logistic;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    //
    public function index()
    {
        $activities = Activity::where('type', 'entreprise')->where('deleted', NULL)->get();
        $activities_st = Activity::where('type', 'stock')->where('deleted', NULL)->get();
        $entreprises = Entreprise::whereNot('business_circuit', NULL)->get();
        $declarations = DeclarationType::where('deleted', NULL)->get();
        $products = ProductType::where('deleted', NULL)->get();
        $logistics = Logistic::where('deleted', NULL)->get();
        return view('front.stock.form', compact('activities', 'entreprises', 'declarations', 'products', 'logistics', 'activities_st'));
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
                'commune' => ['required'],
                'number_commercant' => ['required'],
                'business_circuit' => ['required'],
                'rccm' => ['required'],
                'nif' => ['required'],
                'hood' => ['required'],
                'email' => ['required'],
                'legal_status' => ['required'],
                'date_create' => ['required'],
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
            $entreprise->email = $request->email;
            $entreprise->commune = $request->commune;
            $entreprise->hood = $request->hood;
            $entreprise->number_commercant = $request->number_commercant;
            $entreprise->business_circuit = $request->business_circuit;
            $entreprise->rccm = $request->rccm;
            $entreprise->nif = $request->nif;
            $entreprise->date_create = $request->date_create;
            $entreprise->legal_status = $request->legal_status;
            $entreprise->activity_id = $request->activity_id;

            $entreprise->save();
        }

        $stock = new Stock();

        $stock->service = $request->service;
        $stock->referent = $request->referent;
        $stock->referent_contact = $request->referent_contact;
        $stock->activity_id = $request->activity_id;
        $stock->declaration_type_id = $request->declaration_type_id;
        $stock->product_type_id = $request->product_type_id;
        $stock->logistic_id = $request->logistic_id;
        $stock->province = $request->province;
        $stock->ville = $request->ville;
        $stock->entreprise_id = $entreprise->id;

        if ($request->file('file_product_url')) {
            $picture = FileController::stock($request->file('file_product_url'));
            if ($picture['state'] == false) {
                return back()->withErrors($picture['message']);
            }

            $url = $picture['url'];
            $stock->file_product_url =  $url;
        }

        if ($stock->save()) {
            return back()->with('success', "Votre déclaration a été soumise avec succès. Nous vous contacterons au plus tôt.");
        }
    }
}
