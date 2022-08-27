<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\formateurModel;
use App\Models\visiteurModel;

class Formateur extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $modelFormateur=new formateurModel();
        $modelVisiteur=new visiteurModel();

        $result=$modelVisiteur->findAll();
        $formateurs=$modelFormateur->get_formateurs();
        foreach($result as $key=>$elt)
        {
            $result[$key]['id_visiteur']=$elt['id'];
        }

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
        return view('liste_formateur',['tab_visiteurs'=>$result,'tab_formt'=>$formateurs]);
    }
    public function ajouter()
    {
        //les champ disabled ne sont pas envoyer a ce fivhier.

        $modelFormateur=new formateurModel();
        $modelVisiteur=new visiteurModel();
        if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['cni']) && isset($_POST['tel']) )
        {
            if( $this->validate([
                'nom'=>'required',
                'prenom'=>'required',
                'cni'=>'required',
                'tel'=>'required',
                ]) )
                {
                    echo "ajoutons le visiteur";
                    $visiteur=['nom'=>$_POST['nom'],'prenom'=>$_POST['prenom'], 'cni'=>$_POST['cni'], 'tel'=>(int)$_POST['tel'] ];
                   
                    var_dump( $modelVisiteur->save($visiteur));
                    //recuperation de l'id du visiteur que l'ont vient d'enregistrer et ajout de la visite
                    $id_visiteur=(int)$modelVisiteur->get_id($visiteur);
                    $formateur=['id_visiteur'=>$id_visiteur];
                    if($modelFormateur->save($formateur))
                        session()->setFlashdata("success","Enseignant enregistré avec succès");
                    else
                        session()->setFlashdata("fail","Erreur lors de l'enregistrement de l'Enseignant");
                }
                else
                    session()->setFlashdata("fail","Le formulaire mal rempli");
        }
        else if( isset($_POST['visiteur']))
        {
            $id_visiteur=$_POST['visiteur'];
            $formateur=['id_visiteur'=>$id_visiteur];
            if($modelFormateur->save($formateur))
                session()->setFlashdata("success","Enseignant enregistré avec succès");
            else
                session()->setFlashdata("fail","Erreur lors de l'enregistrement de l'Enseignant");
        }
        else
        {
            session()->setFlashdata("fail","Certains parametres requis n'ont pas été envoyés");
        }

        return redirect()->to(base_url('formateur'));
    }

    

    public function recherche()
    {
        $viewData=[];
        $model=new formateurModel();
        $modelVisiteur=new visiteurModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_formt']=$donnees;
                    $viewData['tab_visiteurs']=$modelVisiteur->findAll();
                }
                else
                    session()->setFlashdata("notify",'Le motif de recherche fourni est une chaine vide');
        }
        else
            session()->setFlashdata("notify","Aucun motif de recherche n'a été defini");


        return view('liste_formateur',$viewData);
    }
}
