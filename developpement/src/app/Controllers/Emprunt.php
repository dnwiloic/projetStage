<?php

namespace App\Controllers;

use App\Models\abonneModel;
use App\Models\employerModel;
use App\Models\empruntModel;
use App\Models\ouvrageModel;

class Emprunt extends BaseController
{
    public function index()
    {
        $mEmprunt=new empruntModel();
        $mLivre=new ouvrageModel();
        $mAbn=new abonneModel();
        

        $tab_emprunt=$mEmprunt->findAll();
        foreach($tab_emprunt as $key=>$elt)
        {
            $tab_emprunt[$key]['emprunteur']=$mAbn->get_attr_of($elt['id_abonne'],'prenom')." ".$mAbn->get_attr_of($elt['id_abonne'],'nom');
            $tab_emprunt[$key]['livre']="<strong>".$mLivre->get_attr_of($elt['id_ouvrage'],'titre')."</strong> de ".$mLivre->get_attr_of($elt['id_ouvrage'],'nom_auteur');
        }
        $tab_abn=$mAbn->get_abn_eligible();
        

        foreach($tab_abn as $key=>$value)
        {
            $tab_abn[$key]['nom']=$mAbn->get_attr_of($value['id_visiteur'],'nom');
            $tab_abn[$key]['prenom']=$mAbn->get_attr_of($value['id_visiteur'],'prenom');
        }
        $tab_livre=$mLivre->findAll();
        
       
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
}
