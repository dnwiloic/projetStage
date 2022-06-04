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
            return $elt[$attr];
        }
        
    }

    public function get_id($vst)
    {
        $visiteur=new visiteurModel();
        return $visiteur->get_id($vst);
    }

    public function get_infos_apprs(){
        $mVisiteur=new visiteurModel();
        $colunm=$this->findColumn('id_visiteur');
        return $mVisiteur->find($colunm);
    }
}