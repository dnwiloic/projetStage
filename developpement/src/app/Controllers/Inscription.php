<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\apprenantModel;
use App\Models\formationModel;
use App\Models\inscriptionModel;
use App\Models\visiteurModel;

class Inscription extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $mInscription=new inscriptionModel();
        $mAppr=new apprenantModel();
        $mFormation=new formationModel();
        $mVisiteur=new visiteurModel();
        $tab_appr=$mAppr->get_apprenants();
        $tab_formation=$mFormation->get_formations();
        $tab_inscription=$mInscription->get_inscriptions();

        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($tab_inscription,[
                $col=>SORT_DESC,
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($tab_inscription,[
                $col=>SORT_ASC,
            ]);
        }

        return view('liste_inscription',['tab_inscription'=>$tab_inscription,'tab_formation'=>$tab_formation,'tab_appr'=>$tab_appr]);
    }

    public function ajouter()
    {
        $mInscription=new inscriptionModel();
        $mFormation=new formationModel();
        if(isset($_POST['apprenant']) && isset($_POST['formation']) && isset($_POST['mv'])
        && isset($_POST['date_ins']) && isset($_POST['date_debut']) && isset($_POST['cmt']))
        {
            if( $this->validate([
                'apprenant'=>'required',
                'formation'=>'required',
                'mv'=>'required',
                'date_ins'=>'required',
            ]))
            {
                echo "ajout   ";
                $cout_total=(int)$mFormation->get_attr_of($_POST['formation'],'prix') + 5000;//5000 pour les frais d'inscription
                $nbr_semaine=$mFormation->get_attr_of($_POST['formation'],'duree');
                $date_fin = date("Y-m-d", strtotime("+$nbr_semaine week", strtotime($_POST['date_debut'])));
                $inscription=['id_apprenant'=>$_POST['apprenant'],'id_formation'=>$_POST['formation'],
                'montant_paye'=>$_POST['mv'],'cout_total'=>$cout_total,'date_inscription'=>$_POST['date_ins'],
                'date_debut'=>$_POST['date_debut'],'date_fin'=>$date_fin,'commentaire'=>$_POST['cmt']];

                var_dump($mInscription->save($inscription));
            }
            else
            {
                //erreur
            }
        }
        else {
            //erreur
        }
        return redirect()->to(base_url('inscription'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new inscriptionModel();
        $mAppr=new apprenantModel();
        $mFormation=new formationModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_inscription']=$donnees;
                    $viewData['tab_formation']=$mFormation->get_formations();
                    $viewData['tab_appr']=$mAppr->get_apprenants();
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_inscription',$viewData);
    }
}
