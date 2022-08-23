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

    protected $allowedFields = ['id','nom','prenom','cni','tel'];

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

    public function recherche($chaine)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
            $rst = $this->db->query("SELECT * FROM visiteur WHERE
            nom like '%$chaine%' OR prenom like '%$chaine%' OR
            cni like '%$chaine%' OR tel like '%$chaine%' ;
            ");

            return $rst->getResultArray();
        
    }
}