<?php

namespace App\Controllers;

use App\Models\mouvArgentModel;

helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()


class Entree_argent extends BaseController
{
    protected $type=1;
    public function index($col='id',$typeTri='desc')
    {
        $model=new MouvArgentModel();

        $donnees=$model->get_mvt_argent($this->type);
        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($donnees,[
                $col=>SORT_DESC
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($donnees,[
                $col=>SORT_ASC
            ]);
        }
    
        return view('liste_entreeArgent',['tab'=>$donnees]);
    }
    public function ajouter()
    {
        //les champ disabled ne sont pas envoyer a ce fivhier.

        $model=new mouvArgentModel();
        if( isset($_POST['motif']) && isset($_POST['somme']) && isset($_POST['date']))
        {
            if( $this->validate([
                'motif'=>'required',
                'somme'=>'required',
                'date'=>'required',
                ]) )
                {
                    echo "ajoutons le mvt";
                    $model->add_mvt_argent($_POST['date'],$_POST['somme'],$_POST['motif'],$this->type);
                }
        }
        else
        {
            echo "rien a faire";
            //message d'erreur
        }

        return redirect()->to(base_url('Entree_argent'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new mouvArgentModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    echo "recherchons le mvt";
                    $donnees=$model->recherche($_POST['search'],$this->type);
                    $viewData['tab']=$donnees;
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_entreeArgent',$viewData);
    }
}
