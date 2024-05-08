<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\DeclarationType;
use App\Models\Logistic;
use App\Models\ProductType;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function activite()
    {
        $activites = Activity::where('deleted', NULL)->get();
        return view('admin.setting.activite', compact('activites'));
    }

    public function createActivite(Request $request)
    {
        $activity = new Activity();
        $activity->name = $request->name;
        $activity->type = $request->type;
        if ($activity->save()) {
            return back()->with('success', 'Activité créé avec succès.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function updateActivite(Request $request, $activity)
    {
        $activity = Activity::find($activity);
        if (isset($_POST['delete'])) {
            $activity->deleted = true;
            $activity->deleted_at = now();
            if ($activity->save()) {
                return back()->with('success', "L'activité a été supprimée.");
            } else {
                return back()->with('error', "L'activité n'a pas été supprimée.");
            }
        } else {
            $activity->name = $request->name;
            $activity->type = $request->type;
            if ($activity->save()) {
                return back()->with('success', 'Activité mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }

    public function declaration()
    {
        $declarations = DeclarationType::where('deleted', NULL)->get();
        return view('admin.setting.declaration', compact('declarations'));
    }

    public function createDeclaration(Request $request)
    {
        $declaration = new DeclarationType();
        $declaration->name = $request->name;
        if ($declaration->save()) {
            return back()->with('success', 'Type de déclaration créé avec succès.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function updateDeclaration(Request $request, $declaration)
    {
        $declaration = DeclarationType::find($declaration);
        if (isset($_POST['delete'])) {
            $declaration->deleted = true;
            $declaration->deleted_at = now();
            if ($declaration->save()) {
                return back()->with('success', "Type de déclaration a été supprimée.");
            } else {
                return back()->with('error', "Le type de déclaration n'a pas été supprimée.");
            }
        } else {
            $declaration->name = $request->name;
            if ($declaration->save()) {
                return back()->with('success', 'Type de déclaration mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }

    public function product()
    {
        $products = ProductType::where('deleted', NULL)->get();
        return view('admin.setting.product', compact('products'));
    }

    public function createProduct(Request $request)
    {
        $product = new ProductType();
        $product->name = $request->name;
        if ($product->save()) {
            return back()->with('success', 'Type de produit créé avec succès.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function updateProduct(Request $request, $product)
    {
        $product = ProductType::find($product);
        if (isset($_POST['delete'])) {
            $product->deleted = true;
            $product->deleted_at = now();
            if ($product->save()) {
                return back()->with('success', "Le type de produit a été supprimée.");
            } else {
                return back()->with('error', "Le type de produit n'a pas été supprimée.");
            }
        } else {
            $product->name = $request->name;
            if ($product->save()) {
                return back()->with('success', 'Type de produit mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }

    public function logistic()
    {
        $logistics = Logistic::where('deleted', NULL)->get();
        return view('admin.setting.logistic', compact('logistics'));
    }

    public function createLogistic(Request $request)
    {
        $logistic = new Logistic();
        $logistic->name = $request->name;
        if ($logistic->save()) {
            return back()->with('success', 'Moyen logisitque créé avec succès.');
        } else {
            return back()->with('error', 'Un problème est survenu.');
        }
    }

    public function updateLogistic(Request $request, $logistic)
    {
        $logistic = Logistic::find($logistic);
        if (isset($_POST['delete'])) {
            $logistic->deleted = true;
            $logistic->deleted_at = now();
            if ($logistic->save()) {
                return back()->with('success', "Le moyen logisitque a été supprimée.");
            } else {
                return back()->with('error', "Le moyen logisitque n'a pas été supprimée.");
            }
        } else {
            $logistic->name = $request->name;
            if ($logistic->save()) {
                return back()->with('success', 'Moyen logisitque mis à jour avec succès.');
            } else {
                return back()->with('error', 'Un problème est survenu.');
            }
        }
    }
}
