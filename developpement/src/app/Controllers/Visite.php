<?php

namespace App\Controllers;

use App\Models\employerModel;
use App\Models\visiteModel;
use App\Models\visiteurModel;

class Visite extends BaseController
{
    public function index()
    {
        $visiteModel = new visiteModel();
        $empModel = new employerModel();
        $visiteurModel = new visiteurModel();
        $tab = array();
        $toShow = array();
        $visites = $visiteModel->findAll();
        foreach($visites as $visite)
        {
            $toShow['id']=$visite->id;
            $toShow['id_visiteur']=$visite->id_visiteur;
            $toShow['employer']=$empModel->get_attr_of((int)$visite->id_employer,"login");
            $toShow['visiteur']=$visiteurModel->get_attr_of((int)$visite->id_visiteur,"nom")." ".$visiteurModel->get_attr_of((int)$visite->id_visiteur,"prenom");
            $toShow['nom']=$visiteurModel->get_attr_of((int)$visite->id_visiteur,"nom");
            $toShow['prenom']=$visiteurModel->get_attr_of((int)$visite->id_visiteur,"prenom");
            $toShow['cni']=$visiteurModel->get_attr_of((int)$visite->id_visiteur,"cni");
            $toShow['tel']=$visiteurModel->get_attr_of((int)$visite->id_visiteur,"tel");
            $toShow['date']=$visite->date;
            $toShow['heure_debut']=$visite->heure_debut;
            $toShow['heure_fin']=$visite->heure_fin;
            $toShow['raison']=$visite->raison;
            array_push($tab, $toShow );
        }
        return view('liste_visite', ['visites' => $tab]);
    }

    public function ajouter()
    {
        $visiteurModel=new visiteurModel();
        $visiteModel=new visiteModel();
        if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['cni']) && isset($_POST['tel']) &&
        isset($_POST['date']) && isset($_POST['hd']) && isset($_POST['raison']) )
        {
           if( $this->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'cni'=>'required',
            'tel'=>'required',
            'date'=>'required|valid_date',
            'hd'=>'required'
            ])  )
            {
                $visiteur=['nom'=>$_POST['nom'],'prenom'=>$_POST['prenom'], 'cni'=>$_POST['cni'], 'tel'=>(int)$_POST['tel'] ];
                var_dump($visiteurModel->save($visiteur)) ;
                var_dump($visiteur) ;
                //recuperation de l'id du visiteur que l'ont vient d'enregistrer et ajout de la visite
                $visite=['date'=>$_POST['date'],'heure_debut'=>$_POST['hd'], 'raison'=>$_POST['raison'], 'id_visiteur'=>(int)$visiteurModel->get_id($visiteur),'id_employer'=>1 ];
                var_dump($visiteModel->save($visite));
            }
        }
        else if(isset($_POST['visiteur']) && isset($_POST['date']) && isset($_POST['hd']) && isset($_POST['raison']) )
        {
            $visite=['date'=>$_POST['date'],'heure_debut'=>$_POST['hd'], 'raison'=>$_POST['raison'], 'id_visiteur'=>(int)$_POST['visiteur'],'id_employer'=>1 ];
                var_dump($visiteModel->save($visite));
        }
        else if( isset($_POST['hf'] ) && isset($_POST['idv'] ) )
        {
            echo 'id_visite: ';
            echo $_POST['idv'];
            $visiteModel->update((int)$_POST['idv'],['heure_fin'=>$_POST['hf']]);
        }
        echo "fin";

        return redirect()->to(base_url('visite'));
    }
}

