<?php
namespace App\Models;
use CodeIgniter\Model;
class M_rak extends Model
{
    protected $table = 'tbl_rak';
    public function getDataRak($where = false)
    {
        if ($where === false) {

            $builder = $this->db->table($this->table);
            $builder->select('*');
            $builder->orderBy('id_rak', 'ASC');
            return $builder->get();

        } else {

            $builder = $this->db->table($this->table);
            $builder->where($where);
            return $builder->get();
        }
    }

    public function saveDataRak($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateDataRak($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }

    public function deleteDataRak($where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->delete();
    }

    public function autoNumber()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_rak');
        $builder->orderBy('id_rak', 'DESC');
        $builder->limit(1);
        return $builder->get();
    }
}