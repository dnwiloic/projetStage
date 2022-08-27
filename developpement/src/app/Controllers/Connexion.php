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
        $modelEmployer = new employerModel();
        if (isset($_POST["login"]) && isset($_POST["password"])) {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $userInfo = $modelEmployer->where('login', $login)->first();
            if ($userInfo == null) {
                return view("connexionView", array('error' => "invalid login"));
            } else {
                if ($userInfo['password'] == sha1($password)) {
                    session()->set("userId", $userInfo['id']);
                    session()->setFlashdata("success", "Connexion réussite");
                    return redirect()->to(base_url('visites'));
                } else {
                    return view("connexionView", array('error' => "invalid password"));
                }
            }
        } else {
            session()->setFlashdata("fail", "Echec de connexion");
            redirect()->back();
        }
    }

    public function deconnexion()
    {
        session()->remove("userId");
        return redirect()->to(base_url('connexion'))->with('success', "Déconnexion éffectué");
    }
}
