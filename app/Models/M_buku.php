<?php
namespace App\Models;
use CodeIgniter\Model;
class M_buku extends Model
{
    protected $table = 'tbl_buku';

    // =========================
    // GET DATA (BASIC)
    // =========================
    public function getDataBuku($where = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        if ($where !== false) {
            $builder->where($where);
        }
        $builder->orderBy('judul_buku','ASC');
        return $builder->get();
    }

    // =========================
    // GET DATA + JOIN
    // =========================
    public function getDataBukuJoin($where = false)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join(
            'tbl_kategori',
            'tbl_kategori.id_kategori = tbl_buku.id_kategori',
            'LEFT'
        );
        $builder->join(
            'tbl_rak',
            'tbl_rak.id_rak = tbl_buku.id_rak',
            'LEFT'
        );
        if ($where !== false) {
            $builder->where($where);
        }
        $builder->orderBy('tbl_buku.judul_buku','ASC');
        return $builder->get();
    }

    // =========================
    // INSERT DATA
    // =========================
    public function saveDataBuku($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function updateDataBuku($data, $where)
    {
        $builder = $this->db->table($this->table);
        $builder->where($where);
        return $builder->update($data);
    }

    // =========================
    // AUTO NUMBER
    // =========================
    public function autoNumber()
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_buku');
        $builder->orderBy('id_buku','DESC');
        $builder->limit(1);
        return $builder->get();
    }
}