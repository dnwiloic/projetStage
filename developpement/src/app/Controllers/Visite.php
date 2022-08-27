<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\employerModel;
use App\Models\visiteModel;
use App\Models\visiteurModel;

class Visite extends BaseController
{
    public function index( $col='date',$typeTri='desc')
    {
        $visiteModel = new visiteModel();
        $visiteurModel = new visiteurModel();
        $visiteurs=$visiteurModel->findAll();
        foreach($visiteurs as $key=>$vst)
        {
            $visiteurs[$key]['id_visiteur']=$vst['id'];
        } 
        
        $tab=$visiteModel->get_visites();

        if($typeTri=="desc"){
            array_sort_by_multiple_keys($tab,[
                $col=>SORT_DESC,
                'date'=>SORT_DESC,
                'heure_debut'=>SORT_DESC 
            ]);
        }
        else
        {
            array_sort_by_multiple_keys($tab,[
                $col=>SORT_ASC,
                'date'=>SORT_DESC,
                'heure_debut'=>SORT_DESC 
            ]);
        }
        return view('liste_visite', ['visites' => $tab,'tab_visiteur'=>$visiteurs]);
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
                $visiteurModel->save($visiteur);
                //recuperation de l'id du visiteur que l'ont vient d'enregistrer et ajout de la visite
                $visite=['date'=>$_POST['date'],'heure_debut'=>$_POST['hd'], 'raison'=>$_POST['raison'], 'id_visiteur'=>(int)$visiteurModel->get_id($visiteur),'id_employer'=>(int)session()->get("userId") ];
                if($visiteModel->save($visite))
                    session()->setFlashdata("success","visite enregistré avec succès");
                else
                    session()->setFlashdata("fail","Erreur lors de l'enregistrement de la visite");
            }
            else
                session()->setFlashdata("fail","Le formulaire mal rempli");
        }
        else if(isset($_POST['visiteur']) && isset($_POST['date']) && isset($_POST['hd']) && isset($_POST['raison']) )
        {
            $visite=['date'=>$_POST['date'],'heure_debut'=>$_POST['hd'], 'raison'=>$_POST['raison'], 'id_visiteur'=>(int)$_POST['visiteur'],'id_employer'=>(int)session()->get("userId") ];
                if($visiteModel->save($visite))
                    session()->setFlashdata("success","visite enregistré avec succès");
                else
                    session()->setFlashdata("fail","Erreur lors de l'enregistrement de la visite");
        }
        else if( isset($_POST['hf'] ) && isset($_POST['idv'] ) )
        {
            if($visiteModel->update((int)$_POST['idv'],['heure_fin'=>$_POST['hf']]))
                session()->setFlashdata("success","Heure de fin enregistré avec succès");
            else
                session()->setFlashdata("fail","Erreur lors de l'enregistrement de l'heure de fin");
        }
        else
            session()->setFlashdata("fail","Certains parametres requis n'ont pas été envoyés");

        return redirect()->to(base_url('visite'));
    }

    public function recherche()
    {
        $viewData=[];
        $model=new visiteModel();
        $modelVisiteur= new visiteurModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['visites']=$donnees;
                    $viewData['tab_visiteur']=$modelVisiteur->findAll();
                }
                else
                    session()->setFlashdata("notify",'Le motif de recherche fourni est une chaine vide');
        }
        else
            session()->setFlashdata("notify","Aucun motif de recherche n'a été defini");


        return view('liste_visite',$viewData);
    }
}

