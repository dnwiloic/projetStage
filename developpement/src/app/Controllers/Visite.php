<?php

namespace App\Controllers;

use App\Models\employerModel;
use App\Models\visiteModel;
use App\Models\visiteurModel;

class Visite extends BaseController
{
    public function index()
    {
        $visiteModel=new visiteModel();
        $empMod=new employerModel();
        $visiteurModel=new visiteurModel();

        $visites=$visiteModel->findAll();
        return view('welcome_message');
    }
}
