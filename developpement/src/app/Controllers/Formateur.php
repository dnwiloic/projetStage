<?php

namespace App\Controllers;

use App\Models\formateurModel;
use App\Models\visiteurModel;

class Formateur extends BaseController
{
    public function index()
    {
        $modelFormateur=new formateurModel();
        $modelVisiteur=new visiteurModel();

        $result=$modelVisiteur->find($modelFormateur->findColumn('id_visiteur'));
        return view('liste_formateur',['tab_visiteurs'=>$result]);
    }
}
