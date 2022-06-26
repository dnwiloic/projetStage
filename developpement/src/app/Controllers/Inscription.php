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
        $tab_appr=$mAppr->get_infos_apprs();
        $tab_formation=$mFormation->findAll();
        $tab_inscription=$mInscription->findAll();
        
        foreach($tab_inscription as $key=>$inscription){
            $tab_inscription[$key]['prenom']=$mVisiteur->get_attr_of($inscription['id_apprenant'],'prenom');
            $tab_inscription[$key]['nomV']=$mVisiteur->get_attr_of($inscription['id_apprenant'],'nom');
            $tab_inscription[$key]['nomF']=$mFormation->get_attr_of($inscription['id_formation'],'nom');//nom de la formation
            $tab_inscription[$key]['montant_restant']=(int)$inscription['cout_total'] - (int)$inscription['montant_paye'];
        }

        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($tab_inscription,[
                $col=>SORT_DESC,
                'prenom'=>SORT_DESC
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($tab_inscription,[
                $col=>SORT_ASC,
                'prenom'=>SORT_ASC
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
}
