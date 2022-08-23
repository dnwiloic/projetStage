<?php

namespace App\Models;

use App\Controllers\Visiteur;
use CodeIgniter\Model;
use App\Models\visiteurModel;

use function PHPSTORM_META\map;

class formateurModel extends Model
{
    protected $table      = 'formateur';
    protected $primaryKey = 'id_visiteur';

    protected $useAutoIncrement = false;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_visiteur'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    

    public function get_attr_of($id,$attr)
    {
        $visiteur=new visiteurModel();
        return $visiteur->get_attr_of($id,$attr);
    }

    public function get_id($vst)
    {
        $visiteur=new visiteurModel();
        return $visiteur->get_id($vst);
    }

    public function get_infos_formateurs(){
        $mVisiteur=new visiteurModel();
        $colunm=$this->findColumn('id_visiteur');
        foreach($colunm as $elt)
        {
            $result[$elt]=$mVisiteur->find($elt);
        }
        return $result;
    }

    public function get_formateurs(){
        $rqt=$this->db->query('CALL get_visiteurs_formateurs()');
        return $rqt->getResultArray();
    }

    public function recherche($chaine)
    {
        //rechreche le formateur en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        $rst = $this->db->query("SELECT * FROM visiteur_formateur WHERE
        nom like '%$chaine%' OR prenom like '%$chaine%' OR
        cni like '%$chaine%' OR tel like '%$chaine%' ;
        ");

        return $rst->getResultArray();
    }
}