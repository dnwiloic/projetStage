<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()

use App\Models\visiteModel;
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

    public function recherche()
    {
        $viewData=[];
        $model=new visiteurModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_visiteurs']=$donnees;
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_visiteur',$viewData);
    }
}
