<?php

namespace App\Controllers;

use App\Models\apprenantModel;
use App\Models\visiteurModel;

class Apprenant extends BaseController
{
    public function index()
    {
        $modelApprenant = new apprenantModel();
        $modelVisiteur = new visiteurModel();
        $ids = $modelApprenant->findColumn('id_visiteur');
        if ($ids == NULL) {
            $result = array();
        } else {
            $result = $modelVisiteur->find($ids);
        }
        foreach($result as $key=>$elt)
        {
            $result[$key]['matricule']=$modelApprenant->get_attr_of($elt['id'],'matricule');
        }
        return view('liste_apprenant', ['tab_visiteurs' => $result]);
    }
}
