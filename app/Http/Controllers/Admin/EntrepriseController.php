<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Entreprise;
use App\Models\Importation;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    //
    public function index()
    {
        $entreprises = Entreprise::count();
        $importations = Importation::count();
        $activites = Activity::count();
        return view('admin.dashboard', compact('entreprises', 'importations', 'activites'));
    }

    public function entreprise()
    {
        $entreprises = Entreprise::all();
        return view('admin.entreprise', compact('entreprises'));
    }

    public function importation()
    {
        $importations = Importation::all();
        return view('admin.importation', compact('importations'));
    }

    public function activite()
    {
        $activites = Activity::all();
        return view('admin.activite', compact('activites'));
    }

    public function export($id)
    {
        $importation = Importation::with('entreprise', 'entreprise.activity')->find($id);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('pdf.declaration', compact('importation'));

        $outputPath = 'Declaration_' . $id . '.pdf';

        return $pdf->download($outputPath);
    }
}
