<?php

namespace App\Controllers;

use App\Models\abonneModel;
use App\Models\apprenantModel;
use App\Models\visiteurModel;

class Abonne extends BaseController
{
    public function index()
    {
        $mAbonne =new abonneModel();
        $modelVisiteur = new visiteurModel();
        $ids = $mAbonne->findColumn('id_visiteur');
        $visiteurs = $modelVisiteur->findAll();
        // on ajooute la colonne "id_visiteur" pour le visite.js puisse prendre en compte ces elements
        foreach($visiteurs as $key=>$vst)
        {
            $visiteurs[$key]['id_visiteur']=$vst['id'];
        } 
        $abonnes= $mAbonne->findAll();
        foreach($abonnes as $key=>$elt)
        {
            $abonnes[$key]['nom']=$modelVisiteur->get_attr_of($elt['id_visiteur'],'nom');
            $abonnes[$key]['prenom']=$modelVisiteur->get_attr_of($elt['id_visiteur'],'prenom');
            $abonnes[$key]['cni']=$modelVisiteur->get_attr_of($elt['id_visiteur'],'cni');
            $abonnes[$key]['tel']=$modelVisiteur->get_attr_of($elt['id_visiteur'],'tel');
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
                    echo "\n";
                    var_dump($abonne);
                    var_dump($mAbonne->save($abonne));
                    echo "   ici";
                }
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
            var_dump($mAbonne->save($abonne));
        }
        else
        {
            echo "rien a faire";
        }

        return redirect()->to(base_url('abonne'));
    }
}
