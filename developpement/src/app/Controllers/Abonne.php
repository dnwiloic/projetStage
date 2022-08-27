<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()

use App\Models\abonneModel;
use App\Models\visiteurModel;

class Abonne extends BaseController
{
    public function index($col='id_visiteur',$typeTri='desc')
    {
        $mAbonne =new abonneModel();
        $modelVisiteur = new visiteurModel();
        $visiteurs = $modelVisiteur->findAll();
        // on ajooute la colonne "id_visiteur" pour le visite.js puisse prendre en compte ces elements
        foreach($visiteurs as $key=>$vst)
        {
            $visiteurs[$key]['id_visiteur']=$vst['id'];
        } 
        $abonnes= $mAbonne->get_abonnes();
        
        //tri
        if($typeTri=="desc"){
            array_sort_by_multiple_keys($abonnes,[
                $col=>SORT_DESC
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($abonnes,[
                $col=>SORT_ASC
            ]);
        }
        return view('liste_abonne', ['tab_visiteurs' => $visiteurs,'tab_abn'=>$abonnes]);
    }
    public function ajouter()
    {
        //les champ disabled ne sont pas envoyer a ce fivhier.

        $mAbonne=new abonneModel();
        $modelVisiteur=new visiteurModel();
        if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['cni']) && isset($_POST['tel'])
            && isset($_POST['montant_verse']) && isset($_POST['date_ins']))
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
                
                //calcul de la date d'expiration
                $date_exp=date("Y-m-d", strtotime("+ 1 year ", strtotime($_POST['date_ins'])));
                
                $abonne=['id_visiteur'=>$id_visiteur,'montant_verse'=>(int)$_POST['montant_verse'] , 'date_inscription'=>$_POST['date_ins'],
                    'cout_abonnement'=>15000, 'date_expiration'=>$date_exp];
                    
                if(isset($_POST['cout_total']))
                {
                    $abonne[ 'cout_abonnement']=(int)$_POST['cout_total'];
                }
                if(isset($_POST['cmg']))
                {
                    $abonne[ 'carte_membre_genere']=(bool)$_POST['cmg'];
                }
                if($mAbonne->save($abonne))
                    session()->setFlashdata("success","Abonnement enregistré avec succès");
                else
                    session()->setFlashdata("fail","Erreur lors de l'enregistrement de l'abonnement");
            }
            else
                session()->setFlashdata("fail","Le formulaire mal rempli");
        }
        else if( isset($_POST['visiteur']) && isset($_POST['montant_verse']) && isset($_POST['date_ins']))
        {
            $id_visiteur=$_POST['visiteur'];

            //calcul de la date d'expiration
            $date_exp=date("Y-m-d", strtotime("+ 1 year ", strtotime($_POST['date_ins'])));

            $abonne=['id_visiteur'=>$id_visiteur,'montant_verse'=>(int)$_POST['montant_verse'] , 'date_inscription'=>$_POST['date_ins'],
            'cout_abonnement'=>15000, 'date_expiration'=>$date_exp];
            if(isset($_POST['cout_total']))
            {
                $abonne[ 'cout_abonnement']=(int)$_POST['cout_total'];
            }
            if(isset($_POST['cmg']))
            {
                $abonne[ 'carte_membre_genere']=(bool)$_POST['cmg'];
            }
            if($mAbonne->save($abonne))
                session()->setFlashdata("success","Abonnement enregistré avec succès");
            else
                session()->setFlashdata("fail","Erreur lors de l'enregistrement de l'abonnement");
        }
        else
            session()->setFlashdata("fail","Certains parametres requis n'ont pas été envoyés");

        return redirect()->to(base_url('abonne'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new abonneModel();
        $modelVisiteur=new visiteurModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_abn']=$donnees;
                    $viewData['tab_visiteurs']=$modelVisiteur->findAll();
                }
                else
                    session()->setFlashdata("notify",'Le motif de recherche fourni est une chaine vide');
        }
        else
            session()->setFlashdata("notify","Aucun motif de recherche n'a été defini");

        return view('liste_abonne',$viewData); 
    }
}
