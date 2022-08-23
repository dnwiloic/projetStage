<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\visiteurModel;

class apprenantModel extends Model
{
    protected $table      = 'apprenant';
    protected $primaryKey = 'id_visiteur';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_visiteur','matricule'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    

    public function get_attr_of($id,$attr)
    {
        if( $attr != 'matricule')
        {  
            $visiteur=new visiteurModel();
            return $visiteur->get_attr_of($id,$attr);
        }
        else
        {
            $elt=$this->find($id);
            if($elt==null)
            {
                return ;
            }
            return $elt['matricule'];
        }
        
    }

    public function get_id($vst)
    {
        $visiteur=new visiteurModel();
        return $visiteur->get_id($vst);
    }

    public function get_apprenants(){
        $rqt=$this->db->query('CALL get_visiteurs_apprenants()');
        return $rqt->getResultArray();
    }

    public function recherche($chaine)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        $rst = $this->db->query("SELECT * FROM visiteur_apprenant WHERE
        nom like '%$chaine%' OR prenom LIKE '%$chaine%' OR
        cni like '%$chaine%' OR matricule LIKE '%$chaine%'
        OR tel LIKE '%$chaine%';
        ");

        return $rst->getResultArray();
    }
}