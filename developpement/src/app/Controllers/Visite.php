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
        $empModel=new employerModel();
        $visiteurModel=new visiteurModel();
        $tab=array();
        $toShow=array();
        $visites=$visiteModel->findAll();

        foreach($visites as $visite)
        {
            
            $toShow['employer']=$empModel->get_attr_of((int)$visite->id_employer,"login");
            $toShow['visiteur']=$visiteurModel->get_attr_of((int)$visite->id_visiteur,"nom")." ".$visiteurModel->get_attr_of((int)$visite->id_visiteur,"prenom");
            $toShow['date']=$visite->date;
            $toShow['heure_debut']=$visite->heure_debut;
            $toShow['heure_fin']=$visite->heure_fin;
            $toShow['raison']=$visite->raison;
            array_push($tab, $toShow );
        }
        return view('liste_visite',['visites'=>$tab]);
    }
}
