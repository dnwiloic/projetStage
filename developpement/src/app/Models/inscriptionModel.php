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

    public function get_inscriptions(){
        $rqt=$this->db->query('CALL get_v_inscription()');
        return $rqt->getResultArray();
    }

    public function recherche($chaine)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        $rst = $this->db->query("SELECT * FROM v_inscription WHERE
        nomA like '%$chaine%' OR prenomA LIKE '%$chaine%' OR
        nomF like '%$chaine%' OR montant_paye LIKE '%$chaine%' OR 
        ABS(cout_total+montant_paye) like '%$chaine%' OR date_inscription LIKE '%$chaine%' OR 
        date_debut like '%$chaine%' OR date_fin LIKE '%$chaine%' OR 
        commentaire LIKE '%$chaine%';
        ");

        return $rst->getResultArray();
    }
}