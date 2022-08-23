<?php

namespace App\Models;

use CodeIgniter\Model;

class visiteModel extends Model
{
    protected $table      = 'visite';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ["id","id_visiteur","id_employer","date","heure_debut","heure_fin","raison"];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function setReturnType($newType)
    {
        $this->returnType=$newType;
    }

    public function get_visites(){
        $rqt=$this->db->query('CALL get_visites()');
        return $rqt->getResultArray();
    }

    public function recherche($chaine)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        
        $rst = $this->db->query("SELECT * FROM v_visite WHERE
        nom like '%$chaine%' OR prenom like '%$chaine%' OR
        login like '%$chaine%' OR raison like '%$chaine%' OR
        date like '%$chaine%' OR heure_debut like '%$chaine%'
        OR heure_fin like '%$chaine%';
        ");

        return $rst->getResultArray();
        
    }
}