<?php

namespace App\Models;

use CodeIgniter\Model;

class inscriptionModel extends Model
{
    protected $table      = 'inscription';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','id_apprenant','id_formation','montant_paye','date_inscription','date_debut','date_fin','commentaire'];

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
}