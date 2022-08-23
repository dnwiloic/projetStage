<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\formateurModel;
use App\Models\formationModel;

class Formation extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $mFormateur=new formateurModel();
        $mformation=new formationModel();
        $formateurs=$mFormateur->get_formateurs();
        $formations=$mformation->get_formations();

        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($formations,[
                $col=>SORT_DESC
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($formations,[
                $col=>SORT_ASC
            ]);
        }
        return view('liste_formation',['tab_formation'=>$formations,'tab_formateur'=>$formateurs]);
    }
    public function ajouter()
    {
        
        $mformation=new formationModel();
        echo "11";
        if( isset($_POST['nomF']) && isset($_POST['formateur']) && isset($_POST['prix']) && isset($_POST['duree']) && isset($_POST['cmt']))
        {
            
            if( $this->validate([
                'nomF'=>'required',
                'formateur'=>'required',
                'prix'=>'required',
                ]))
                {
                    echo "ajout de la formation";
                    $formation=['nom'=>$_POST['nomF'],'prix'=>$_POST['prix'],'duree'=>$_POST['duree'],'commentaire'=>$_POST['cmt'],'id_formateur'=>(int)$_POST['formateur']];
                    var_dump($mformation->save($formation));
                    echo "ajout avec succes";
                }
        }
        else
        {
            echo "echec";
        }

        return redirect()->to(base_url('formation'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new formationModel();
        $mFormateur=new formateurModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_formation']=$donnees;
                    $viewData['tab_formateur']=$mFormateur->get_formateurs();
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_formation',$viewData);
    }
}
