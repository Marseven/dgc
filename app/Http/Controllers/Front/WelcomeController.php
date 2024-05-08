<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Activity;
use App\Models\Entreprise;
use App\Models\Importation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        return view('front.welcome');
    }
}
