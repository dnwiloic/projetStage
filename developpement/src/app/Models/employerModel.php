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
        $result = $this->db->query("SELECT id , login FROM employer WHERE login='$login' AND password='$password'");
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
}