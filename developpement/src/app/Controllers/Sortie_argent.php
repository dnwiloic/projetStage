<?php

namespace App\Controllers;

use App\Models\mouvArgentModel;

helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()


class Sortie_argent extends BaseController
{
    protected $type=-1;
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
    
        return view('liste_sortieArgent',['tab'=>$donnees]);
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
                    if($model->add_mvt_argent($_POST['date'],$_POST['somme'],$_POST['motif'],$this->type))
                        session()->setFlashdata("success","Enregistrement reussi");
                    else
                        session()->setFlashdata("fail","Erreur lors de l'enregistrement");
                }
                else
                    session()->setFlashdata("fail","Le formulaire mal rempli");
        }
        else
        {
            //message d'erreur
            session()->setFlashdata("fail","Certains parametres requis n'ont pas été envoyés");
        }

        return redirect()->to(base_url('Sortie_argent'));
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
                    $donnees=$model->recherche($_POST['search'],$this->type);
                    $viewData['tab']=$donnees;
                }
                else
                    session()->setFlashdata("notify",'Le motif de recherche fourni est une chaine vide');
        }
        else
            session()->setFlashdata("notify","Aucun motif de recherche n'a été defini");


        return view('liste_entreeArgent',$viewData);
    }
}
