<?php

namespace App\Controllers;
helper('array');//chargement du heper des array. cela me permet d'utiliser array_sort_by_multiple_keys()
use App\Models\abonneModel;
use App\Models\employerModel;
use App\Models\empruntModel;
use App\Models\ouvrageModel;

class Emprunt extends BaseController
{
    public function index($col='id',$typeTri='desc')
    {
        $mEmprunt=new empruntModel();
        $mLivre=new ouvrageModel();
        $mAbn=new abonneModel();
        

        $tab_emprunt=$mEmprunt->get_emprunts();
        $tab_abn=$mAbn->get_abn_eligible();
        
        $tab_livre=$mLivre->findAll();
        
       //tri
       if($typeTri=="desc"){
        array_sort_by_multiple_keys($tab_emprunt,[
            $col=>SORT_DESC
        ]);
    }
    else
    {
        array_sort_by_multiple_keys($tab_emprunt,[
            $col=>SORT_ASC
        ]);
    }
        return view('liste_emprunt',['tab_emprunt'=>$tab_emprunt,'tab_abn'=>$tab_abn,'tab_livre'=>$tab_livre]);
    }
    public function ajouter()
    {
        $mEmprunt=new empruntModel();
       
        if( isset($_POST['abn']) && isset($_POST['livre']) && isset($_POST['date_emp']))
        {
            if( $this->validate([
                'abn'=>'required',
                'livre'=>'required',
                'date_emp'=>'required'
                ]) )
                {
                    echo "ajoutons l'emprunt";
                    $emp=['id_abonne'=>$_POST['abn'],'id_ouvrage'=>$_POST['livre'], 'date_emprunt'=>$_POST['date_emp']];
                    
                    //calcul de la date de retour prevu
                    $date_retour_prevu=date("Y-m-d", strtotime("+ 1 month ", strtotime($_POST['date_emp'])));
                    
                    $emp['date_retour_prevu']=$date_retour_prevu;
                        
                    if(isset($_POST['date_retour']))
                    {
                        $emp['date_retour_effectif']=$_POST['date_retour'];
                    }

                    var_dump($emp);
                    echo "<br>";
                    var_dump($mEmprunt->save($emp));

                    return redirect()->to(base_url('emprunt'));
                }
        }
    }

    public function recherche()
    {
        $viewData=[];
        $model=new empruntModel();
        $mLivre=new ouvrageModel();
        $mAbn=new abonneModel();
        if( isset($_POST['search']))
        {
            if( $this->validate([
                'search'=>'required',
                ]) )
                {
                    $donnees=$model->recherche($_POST['search']);
                    $viewData['tab_emprunt']=$donnees;
                    $viewData['tab_abn']=$mAbn->get_abn_eligible();
                    $viewData['tab_livre']=$mLivre->findAll();
                }
                else
                    $viewData['warnings']->array_push(['Le motif de recherche fourni est une chaine vide']);
        }
        else
            $viewData['errors']->array_push(["Aucun motif de recherche n'a été defini"]);


        return view('liste_emprunt',$viewData);
    }
}
