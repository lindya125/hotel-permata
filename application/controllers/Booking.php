<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model(['Booking_model', 'User_model']);
    }

    public function index()
    {
        $id = ['bo.id_user' => $this->uri->segment(3)];
        $id_user = $this->session->userdata('id_user');
        $data['booking'] = $this->Booking_model->joinOrder($id)->result();
        $user = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();

        foreach ($user as $a) {
            $data = [
                'image'         => $user['image'],
                'user'          => $user['name'],
                'email'         => $user['email'],
                'date_created'  => $user['date_created']
            ];
        }
        $dtb = $this->Booking_model->showtemp(['id_user' => $id_user])->num_rows();

        if ($dtb < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massage alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url());
        } else {
            $data['temp'] = $this->db->query("select image, type_kamar, id_kamar from temp where id_user='$id_user'")->result_array();
        }

        $data['judul'] = "Data Booking";
        $this->load->view('templates/user/header', $data);
        $this->load->view('user/booking/data-booking', $data);
        $this->load->view('templates/user/modal');
        $this->load->view('templates/user/footer');
    }

    public function tambahBooking()
    {
        $id_kamar = $this->uri->segment(3);
        //memilih data buku yang untuk dimasukkan ke tabel temp/keranjang melalui variabel $isi
        $d = $this->db->query("Select*from kamar where id='$id_kamar'")->row();
        //berupa data2 yang akan disimpan ke dalam tabel temp/keranjang
        $isi = [
            'id_kamar'       => $id_kamar,
            'type_kamar'    => $d->type_kamar,
            'id_user'       => $this->session->userdata('id_user'),
            'email_user'    => $this->session->userdata('email'),
            'tgl_booking'   => date('Y-m-d H:i:s'),
            'image'         => $d->image,
            'type_kamar'       => $d->harga
            // 'penerbit'      => $d->penerbit,
            // 'tahun_terbit'  => $d->tahun_terbit
        ];

        //cek apakah buku yang di klik booking sudah ada di keranjang40
        $temp = $this->Booking_model->getDataWhere('temp', ['id_kamar' => $id_kamar])->num_rows();
        $userid = $this->session->userdata('id_user');

        //cek jika sudah memasukan 3 buku untuk dibooking dalam keranjang
        $tempuser = $this->db->query("select*from temp where id_user ='$userid'")->num_rows();

        //cek jika masih ada booking buku yang belum diambil
        $databooking = $this->db->query("select*from booking where id_user='$userid'")->num_rows();
        if ($databooking > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih Ada booking buku sebelumnya yang belum diambil.<br> Abmil Buku yang dibooking atau tunggu 1x24 Jam untuk bisa booking kembali </div>');
            redirect(base_url());
        }

        //jika buku yang diklik booking sudah ada di keranjang
        if ($temp > 0) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Buku ini Sudah anda booking </div>');
            redirect(base_url() . 'home');
        }
        //jika buku yang akan dibooking sudah mencapai 3 item
        if ($tempuser == 3) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking Buku Tidak Boleh Lebih dari 3</div>');
            redirect(base_url() . 'home');
        }

        //membuat tabel temp jika belum ada
        $this->Booking_model->createTemp();
        $this->Booking_model->insertData('temp', $isi);

        //pesan ketika berhasil memasukkan buku ke keranjang
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Buku berhasil ditambahkan ke keranjang </div>');
        redirect(base_url() . 'home');
    }

    public function hapusbooking()
    {
        $id_kamar = $this->uri->segment(3);
        $id_user = $this->session->userdata('id_user');
        $this->Booking_model->deleteData(['id_kamar' => $id_kamar], 'temp');
        $kosong = $this->db->query("select*from temp where id_user='$id_user'")->num_rows();
        if ($kosong < 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-massage alert-danger" role="alert">Tidak Ada Buku dikeranjang</div>');
            redirect(base_url());
        } else {
            redirect(base_url() . 'booking');
        }
    }

    public function bookingSelesai($where)
    {
        //mengupdate stok dan dibooking di tabel buku saat proses booking diselesaikan
        $this->db->query("UPDATE kamar, temp SET kamar.check_out=kamar.check_out+1, kamar.stok=kamar.stok-1 WHERE kamar.id=temp.id_kamar");
        $tglsekarang = date('Y-m-d');
        $isibooking = [
            'id_booking'    => $this->Booking_model->kodeOtomatis('booking', 'id_booking'),
            'tgl_booking'   => date('Y-m-d H:m:s'),
            'batas_check_out'   => date('Y-m-d', strtotime('+2 days', strtotime($tglsekarang))),
            'id_user'       => $where
        ];

        //menyimpan ke tabel booking dan detail booking, dan mengosongkan tabel temporari
        $this->Booking_model->insertData('booking', $isibooking);
        $this->Booking_model->simpanDetail($where);
        $this->Booking_model->kosongkanData('temp');
        redirect(base_url() . 'booking/info');
    }

    public function info()
    {
        $where = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('nama');
        $data['judul'] = "Selesai Booking";
        $data['useraktif'] = $this->User_model->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kamar ka where d.id_booking=bo.id_booking and d.id_kamar=ka.id and bo.id_user='$where'")->result_array();

        $this->load->view('templates/user/header', $data);
        $this->load->view('user/booking/info-booking', $data);
        $this->load->view('templates/user/modal');
        $this->load->view('templates/user/footer');
    }

    public function exportToPdf()
    {
        $id_user = $this->session->userdata('id_user');
        $data['user'] = $this->session->userdata('name');
        $data['judul'] = "Cetak Bukti Booking";
        $data['useraktif'] = $this->User_model->cekData(['id' => $this->session->userdata('id_user')])->result();
        $data1 = $this->db->query("select*from booking bo, booking_detail d, kamar ka where d.id_booking=bo.id_booking and d.id_kamar=ka.id and bo.id_user='$id_user'")->num_rows();
        if ($data1 < 1) {

            $this->session->set_flashdata('pesan', '<div class="alert alert-massege alert-danger" role="alert")>Tidak Ada Data Booking, Silahkan Lakukan Booking Terlebih Dahulu</div>');

            redirect(base_url());
        } else {

            $data['items'] = $this->db->query("select*from booking bo, booking_detail d, kamar ka where d.id_booking=bo.id_booking and d.id_kamar=ka.id and bo.id_user='$id_user'")->result_array();

            $this->load->library('dompdf_gen');
            $this->load->view('user/booking/bukti-pdf', $data);

            $paper_size = 'A4'; // ukuran kertas
            $orientation = 'landscape'; //tipe format kertas potrait atau landscape
            $html = $this->output->get_output();
            $this->dompdf->set_paper($paper_size, $orientation);
            //Convert to PDF
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream("bukti-booking-$id_user.pdf", array('Attachment' => 0));
        }
        // nama file pdf yang di hasilkan
    }
}

/* End of file Booking.php */
