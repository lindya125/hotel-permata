<?php

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Kamar_model', 'User_model', 'Booking_model']);
    }

    public function index()
    {
        $data = [
            'judul' => "Homepage",
            'kamar' => $this->Kamar_model->getKamar()->result(),
        ];
        //jika sudah login dan jika belum login         
        if ($this->session->userdata('email')) {
            $user = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();

            $data['user'] = $user['name'];

            $this->load->view('templates/user/header', $data);
            $this->load->view('user/kamar/daftarkamar', $data);
            $this->load->view('templates/user/modal');
            $this->load->view('templates/user/footer', $data);
        } else {
            $data['user'] = 'Pengunjung';
            $this->load->view('templates/user/header', $data);
            $this->load->view('user/kamar/daftarkamar', $data);
            $this->load->view('templates/user/modal');
            $this->load->view('templates/user/footer', $data);
        }
    }


    public function detailKamar()
    {
        $id = $this->uri->segment(3);
        $kamar = $this->Kamar_model->joinKategoriKamar(['kamar.id' => $id])->result();

        $data['user'] = "Pengunjung";
        $data['judul'] = "Detail Kamar";

        foreach ($kamar as $fields) {
            $data['type_kamar']      = $fields->type_kamar;
            $data['harga']           = $fields->harga;
            // $data['penerbit']   = $fields->penerbit;
            $data['kategori']        = $fields->kategori;
            // $data['stok']            = $fields->stok;
            // $data['isbn']            = $fields->isbn;
            $data['gambar']          = $fields->image;
            $data['check_out']       = $fields->check_out;
            $data['check_in']        = $fields->check_in;
            $data['stok']            = $fields->stok;
            $data['id']              = $id;
        }

        $this->load->view('templates/user/header', $data);
        $this->load->view('user/kamar/detail-kamar', $data);
        $this->load->view('templates/user/modal');
        $this->load->view('templates/user/footer');
    }
}