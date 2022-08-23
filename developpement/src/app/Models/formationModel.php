<?php

namespace App\Models;

use CodeIgniter\Model;

class formationModel extends Model
{
    protected $table      = 'formation';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','nom','prix','duree','commentaire','id_formateur'];

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

    public function get_formations(){
        $rqt=$this->db->query('CALL get_v_formations()');
        return $rqt->getResultArray();
    }

    public function recherche($chaine)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        
        $rst = $this->db->query("SELECT * FROM v_formation WHERE
        nom like '%$chaine%' OR prix like '%$chaine%' OR
        duree like '%$chaine%' OR commentaire like '%$chaine%' 
        OR nom_formateur like '%$chaine%' OR prenom like '%$chaine%';
        ");

        return $rst->getResultArray();
        
    }
}