<?php

namespace App\Models;

use CodeIgniter\Model;

class employerModel extends Model
{
    protected $table      = 'visite';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ["id","id_visiteur","id_employer","date","heure_debut","heure_fin","raison"];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

}