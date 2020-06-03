<?php
if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Reservasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Kamar_model', 'Reservasi_model', 'Booking_model']);
        cek_login();
        cek_user();
    }

    public function index()
    {
        $data['title'] = "Data Reservasi";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['reservasi'] = $this->Reservasi_model->joinData();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/reservasi/data-reservasi', $data);
        $this->load->view('templates/admin/footer');
    }

    public function daftarBooking()
    {
        $data['title'] = "Daftar Booking";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['reservasi'] = $this->db->query("select*from booking")->result_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/booking/daftar-booking', $data);
        $this->load->view('templates/admin/footer');
    }

    public function bookingDetail()
    {
        $id_booking = $this->uri->segment(3);
        $data['title'] = "Booking Detail";
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['agt_booking'] = $this->db->query("select*from booking b, user u where b.id_user=u.id and b.id_booking='$id_booking'")->result_array();
        $data['detail'] = $this->db->query("select id_kamar, type_kamar, harga, stok from booking_detail d, kamar k where d.id_kamar=b.id and d.id_booking='$id_booking'")->result_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/booking/booking-detail', $data);
        $this->load->view('templates/admin/footer');
    }

    public function reservasiAct()
    {
        $id_booking = $this->uri->segment(3);
        $lama = $this->input->post('lama', TRUE);

        $bo = $this->db->query("SELECT*FROM booking WHERE id_booking='$id_booking'")->row();

        $tglsekarang = date('Y-m-d');
        $no_pinjam = $this->Booking_model->kodeotomatis('pinjam', 'no_pinjam');
        $databooking = [
            'no_reservasi'     => $no_reservasi,
            'id_booking'       => $id_booking,
            'tgl_reservasi'    => $tglsekarang,
            'id_user'          => $bo->id_user,
            'tgl_check_in'     => date('Y-m-d', strtotime('+' . $lama . ' days', strtotime($tglsekarang))),
            'tgl_check_out'    => '0000-00-00',
            'status'           => 'Reservasi',
            'total_denda'      => 0
        ];

        $this->Reservasi_model->simpanReservasi($databooking);
        $this->Reservasi_model->simpanDetail($id_booking, $no_pinjam);
        $denda = $this->input->post('denda', TRUE);
        $this->db->query("update detail_pinjam set denda='$denda'");

        //hapus Data booking yang bukunya diambil untuk dipinjam         
        $this->Reservasi_model->deleteData('booking', ['id_booking' => $id_booking]);
        $this->Reservasi_model->deleteData('booking_detail', ['id_booking' => $id_booking]);
        //$this->db->query("DELETE FROM booking WHERE id_booking='$id_booking'"); 

        //update dibooking dan dipinjam pada tabel kamar kaat kamar kang dibooking diambil untuk dipinjam         
        $this->db->query("UPDATE kamar kdetail_pinjam SET kamar kipinjam=kamar kipinjam+1, kamar kibooking=kamar kibooking-1 WHERE kamar kd=detail_pinjam.id_buku AND no_pinjam='$no_pinjam'");

        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Data Peminjaman Berhasil Disimpan</div>');
        redirect(base_url() . 'pinjam');
    }

    public function ubahStatus()
    {
        $id_buku   = $this->uri->segment(3);
        $no_pinjam = $this->uri->segment(4);
        $where     = ['id_buku' => $this->uri->segment(3),];

        $tgl       = date('Y-m-d');
        $status    = 'Kembali';
        //update status menjadi kembali pada saat kamar kikembalikan         
        $this->db->query("UPDATE pinjam, detail_pinjam SET pinjam.status='$status', pinjam.tgl_pengembalian='$tgl' WHERE detail_pinjam.id_buku='$id_buku' AND pinjam.no_pinjam='$no_pinjam'");

        //update stok dan dipinjam pada tabel kamar k        $this->db->query("UPDATE kamar kdetail_pinjam SET kamar kipinjam=kamar kipinjam-1, kamar ktok=kamar ktok+1 WHERE kamar kd=detail_pinjam.id_buku");

        $this->session->set_flashdata('pesan', '<div class="laert alert-message alert-success" role="alert"></div>');
        redirect(base_url('pinjam'));
    }
}
