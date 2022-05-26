<?php

namespace App\Controllers;
use App\Models\visiteurModel;

class Visiteur extends BaseController
{
    public function index()
    {
        $modelVisiteur=new visiteurModel();
        
        $result=$modelVisiteur->findAll();

        return view('liste_visiteur',['tab_visiteurs'=>$result]);
    }
}
