<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\visiteurModel;

class Visiteur extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $modelVisiteur=new visiteurModel();
        
        $result=$modelVisiteur->findAll();

        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($result,[
                $col=>SORT_DESC
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($result,[
                $col=>SORT_ASC
            ]);
        }

        return view('liste_visiteur',['tab_visiteurs'=>$result]);
    }
}
