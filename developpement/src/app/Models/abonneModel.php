<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\visiteurModel;

class abonneModel extends Model
{
    protected $table      = 'abonne';
    protected $primaryKey = 'id_visiteur';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_visiteur','montant_verse','cout_abonnement','date_inscription','date_expiration','carte_membre_genere'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    

    public function get_attr_of($id,$attr)
    {
        $elt=$this->find($id);
        return $elt[$attr];
    }

    public function get_id($vst)
    {
        $visiteur=new visiteurModel();
        return $visiteur->get_id($vst);
    }

    public function get_infos_abn(){
        $mVisiteur=new visiteurModel();
        $colunm=$this->findColumn('id_visiteur');
        return $mVisiteur->find($colunm);
    }
}