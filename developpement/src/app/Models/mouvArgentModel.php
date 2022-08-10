<?php

namespace App\Models;

use CodeIgniter\Model;

class mouvArgentModel extends Model
{
    protected $table      = 'mouvement_argent';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'date', 'somme', 'motif', 'type'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function get_mvt_argent($type)
    {
        if ((int)$type == -1) {
            $rst = $this->db->query("CALL get_sorties_argent();");
            return $rst->getResultArray();
        } else if ((int)$type == 1) {
            $rst = $this->db->query("CALL get_entrees_argent();");
            return $rst->getResultArray();
        } else {
            $rst = $this->db->query("SELECT * FROM mouvement_argent;");
            return $rst->getResultArray();
        }
    }

    public function add_mvt_argent($date, $somme, $motif, $type)
    {
        //this function help to add a money trade
        /* -- params --
           $date: the trade date
           $somme: the trade amount
           $motif: the trade reason
           $type: == -1 if is outgoing
                      1 if is incoming
        */
        if ((int)$type == -1) {
            $rst = $this->db->query("CALL add_sortie_argent('$date','$somme' ,'$motif');");
        } else if ((int)$type == 1) {
            $rst = $this->db->query("CALL add_entree_argent('$date','$somme','$motif');");
        } else {
            //une erreur est generer
        }
    }

    public function recherche($chaine, $type)
    {
        //rechreche le mvt en fonction de toutes les colonnes 
        /* -- params --
           $chaine: element a rechercher
           $type: == -1 if is outgoing
                      1 if is incoming
        */
        if ((int)$type == -1) {
            $rst = $this->db->query("SELECT * FROM mouvement_argent WHERE
            type='Sortie' AND ( date like %$chaine% OR somme like %$chaine% OR
            motif like %$chaine% );
            ");

            return $rst->getResultArray();
        } else if ((int)$type == 1) {
            $rst = $this->db->query("SELECT * FROM mouvement_argent WHERE
            type='Entrée' AND ( date like %$chaine% OR somme like %$chaine% OR
            motif like %$chaine% );
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
