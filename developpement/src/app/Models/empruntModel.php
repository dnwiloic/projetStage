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

    public function get_emprunts(){
        $rqt=$this->db->query('CALL get_v_emprunt()');
        return $rqt->getResultArray();
    }

    public function recherche($chaine)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        $rst = $this->db->query("SELECT * FROM v_emprunt WHERE
        nom like '%$chaine%' OR prenom like '%$chaine%' OR
        titre like '%$chaine%' OR date_emprunt like '%$chaine%' OR
        date_retour_prevu like '%$chaine%' OR date_retour_prevu like '%$chaine%' OR
        feelback like '%$chaine%';
        ");

        return $rst->getResultArray();
    }
}