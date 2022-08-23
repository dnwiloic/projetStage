<?php

namespace App\Controllers;
helper('array');//chargement du helper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\apprenantModel;
use App\Models\visiteurModel;

class Apprenant extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $modelApprenant = new apprenantModel();
        $modelVisiteur = new visiteurModel();
        $result=$modelApprenant->get_apprenants();
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
        return view('liste_apprenant', ['tab_visiteurs' => $modelVisiteur->findAll(),'tab_appr'=>$result]);
    }
    public function ajouter()
    {
        //les champ disabled ne sont pas envoyer a ce fivhier.

        $modelApprenant=new apprenantModel();
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
                    echo "   ici";
                    //recuperation de l'id du visiteur que l'ont vient d'enregistrer et ajout de la visite
                    $id_visiteur=(int)$modelVisiteur->get_id($visiteur);
                    $apprenant=['matricule'=>"mat-".$id_visiteur , 'id_visiteur'=>$id_visiteur];
                    var_dump($modelApprenant->save($apprenant));
                }
        }
        else if( isset($_POST['visiteur']))
        {
            $id_visiteur=$_POST['visiteur'];
            $apprenant=['id_visiteur'=>$id_visiteur, 'matricule'=>"mat-$id_visiteur"];
            var_dump($modelApprenant->save($apprenant));
        }
        else
        {
            echo "rien a faire";
        }

        return redirect()->to(base_url('apprenant'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new apprenantModel();
        $visiteurModel=new visiteurModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_appr']=$donnees;
                    $viewData['tab_visiteurs']=$visiteurModel->findAll();
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_apprenant',$viewData);
    }
}
