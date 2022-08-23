<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\ouvrageModel;

class Ouvrage extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $mOuvrage=new ouvrageModel();
        $ouvrages=$mOuvrage->findAll();

        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($ouvrages,[
                $col=>SORT_DESC
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($ouvrages,[
                $col=>SORT_ASC
            ]);
        }
        return view('liste_ouvrage', ['tab_livre' => $ouvrages]);
    }
    public function ajouter()
    {
        $mOuvrage=new ouvrageModel();
        if ( isset($_POST['titre']) && isset($_POST['nom_auteur']))
        {
            foreach($_POST as $key=>$val)
            {
                $livre[$key]=$val;
            }
            var_dump( $mOuvrage->save($livre));
        }
        return redirect()->to(base_url('ouvrage'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new ouvrageModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_livre']=$donnees;
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_ouvrage',$viewData);
    }
}
