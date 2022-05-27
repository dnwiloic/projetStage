<?php

namespace App\Controllers;

use App\Models\employerModel;
use App\Controllers\Visite;

class Connexion extends BaseController
{
    public function index()
    {
        return view('connexionView');
    }

    public function connexion()
    {
        $modelEmployer=new employerModel();

        if(isset($_POST["login"]) && isset($_POST["password"]))
        {
            if( $modelEmployer->verify_user($_POST["login"],sha1($_POST["password"]) ) )
            {
                return redirect()->to(base_url('visite'));
            }
            else
            {
                return view("connexionView",array('error'=>"invalid login or password"));
            }
        }
        else
        {

        }
    }
}
