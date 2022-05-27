<?php

namespace App\Models;

use CodeIgniter\Model;

class visiteurModel extends Model
{
    protected $table      = 'visiteur';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','nom','prenom','CNI','tel'];

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
        $rst=$this->db->query('SELECT id FROM visiteur WHERE tel='.$vst['tel']);
        return($rst->getResult()[0]->id);
    }
}