<?php 
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed'); 
 
class Reservasi_model extends CI_Model 
{ 
 
    //manip table reservasi     
    public function simpanReservasi($data)     
    {         
        $this->db->insert('reservasi', $data);     
    } 
 
    public function selectData($table, $where)     
    {         
        return $this->db->get($table, $where);     
    } 
 
    public function updateData($data, $where)     
    {         
        $this->db->update('reservasi', $data, $where);     
    } 
 
    public function deleteData($tabel, $where)
     {         
        $this->db->delete($tabel, $where);     
    } 
 
    public function joinData()     
    {         
        $this->db->select('*');         
        $this->db->from('reservasi');         
        $this->db->join('detail_reservasi', 'detail_reservasi.no_reservasi=reservasi.no_reservasi', 'Right');
        return $this->db->get()->result_array();     
    } 
 
    //manip tabel detai reservasi     
    public function simpanDetail($idbooking, $nopinjam)     
    {         
        $sql = "INSERT INTO detail_reservasi (no_reservasi,id_kamar) 
                    SELECT reservasi.no_reservasi,booking_detail.id_kamar 
                    FROM reservasi, booking_detail 
                    WHERE booking_detail.id_booking=$idbooking AND reservasi.no_reservasi='$noreservasi'";         
        $this->db->query($sql);     
    } 
}

/* End of file ModelPinjam.php */