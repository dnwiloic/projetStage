<?php

namespace App\Models;

use CodeIgniter\Model;

class empruntModel extends Model
{
    protected $table      = 'emprunt';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','id_ouvrage','id_abonne','date_emprunt','date_retour_prevu','date_retour_effectif','feelback'];

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