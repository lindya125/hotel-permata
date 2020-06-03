<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar_model extends CI_Model {

    public function getKamar()
    {
        return $this->db->get('kamar');
    }

    public function getKamarPag($limit, $start)
    {
        return $this->db->get('kamar', $limit, $start)->result_array();
    }

    public function countAllKamar()
    {
        return $this->db->get('kamar')->num_rows();
    }

    public function kamarWhere($where)
    {
        return $this->db->get_where('kamar', $where);
    }

    public function simpanKamar($data = null) 
    { 
        $this->db->insert('kamar',$data); 
    }

    public function updateKamat($data = null, $where= null)
    {
        $this->db->update('kamar',$data, $where);
    }

    public function hapusKamar($where = null)
    {
        $this->db->delete('kamar', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('kamar');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriKamar($where)
    {
        $this->db->select('*');
        $this->db->from('kamar');
        $this->db->join('kategori', 'kategori.id = kamar.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }

}

/* End of file Hotel_model.php */
