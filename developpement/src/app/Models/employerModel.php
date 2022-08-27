<?php

namespace App\Models;

use CodeIgniter\Model;

class employerModel extends Model
{
    protected $table      = 'employer';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['login', 'password'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verify_user($login, $password)
    {
        $result = $this->db->query("SELECT id FROM employer WHERE login='$login' AND password='$password'");
        $ids = $result->getResult();
        if (empty($ids)) {
            return false;
        }

        foreach ($ids as $id) {
            // echo "$id->login";
        }

        return true;
    }

    public function get_attr_of($id, $attr)
    {
        $elt = $this->find($id);
        return $elt[$attr];
    }

    public function recherche($chaine, $type)
    {
        //rechreche en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
        */
        if ((int)$type == -1) {
            $rst = $this->db->query("SELECT * FROM mouvement_argent WHERE
            type='Sortie' AND ( date like '%$chaine%' OR somme LIKE '%$chaine%' OR
            motif like '%$chaine%' );
            ");

            return $rst->getResultArray();
        } else if ((int)$type == 1) {
            $rst = $this->db->query("SELECT * FROM mouvement_argent WHERE
            type='Entrée' AND ( date like '%$chaine%' OR somme LIKE '%$chaine%' OR
            motif like '%$chaine%' );
            ");

            return $rst->getResultArray();
        } else {
            $rst = $this->db->query("SELECT * FROM mouvement_argent WHERE
            date like %$chaine% OR somme like %$chaine% OR
            motif like %$chaine% ;
            ");

            return $rst->getResultArray();
        }
    }
}