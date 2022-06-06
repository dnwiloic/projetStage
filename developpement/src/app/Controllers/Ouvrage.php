<?php

namespace App\Controllers;

use App\Models\ouvrageModel;

class Ouvrage extends BaseController
{
    public function index()
    {
        $mOuvrage=new ouvrageModel();
        $ouvrages=$mOuvrage->findAll();
        return view('liste_ouvrage', ['tab_livre' => $ouvrages]);
    }
    public function ajouter()
    {
        $mOuvrage=new ouvrageModel();
        if ( isset($_POST['titre']) && isset($_POST['nom_auteur']))
        {
            foreach($_POST as $key=>$val)
            {
                $livre[$key]=$val;
            }
            var_dump( $mOuvrage->save($livre));
        }
        return redirect()->to(base_url('ouvrage'));
    }
}
