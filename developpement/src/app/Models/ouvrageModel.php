<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\visiteurModel;

class ouvrageModel extends Model
{
    protected $table      = 'ouvrage';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','titre','nom_auteur','edition','nombre_de_page'];

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