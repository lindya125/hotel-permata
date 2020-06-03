<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Kamar_model', 'Reservasi_model', 'Booking_model']);
    }

    public function laporan_kamar()
    {
        $data['title'] = 'Laporan Data Kamar';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kamar'] = $this->Kamar_model->getKamar()->result_array();
        $data['kategori'] = $this->Kamar_model->getKategori()->result_array();

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/sidebar', $data);
        $this->load->view('templates/admin/topbar', $data);
        $this->load->view('admin/kamar/laporan_kamar', $data);
        $this->load->view('templates/admin/footer');
    }

    public function cetak_laporan_kamar()
    {
        $data['title'] = 'Laporan Data Kamar';
        $data['kamar']     = $this->Kamar_model->getKamar()->result_array();
        $data['kategori'] = $this->Kamar_model->getKategori()->result_array();

        $this->load->view('admin/kamar/laporan_print_kamar', $data);
    }

    public function laporan_buku_pdf()
    {
        // $this->load->library('dompdf_gen');

        $data['buku'] = $this->Kamar_model->getBuku()->result_array();

        // $this->load->view('buku/laporan_pdf_buku', $data);

        // $paper_size     = 'A4'; //Ukuran kertas
        // $orientation    = 'landscape'; //tipe format kertas potrait atau landscape
        // $html           = $this->output->get_output();

        // $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan

        $this->load->library('dompdf_gen');
        // $this->load->view('buku/laporan_pdf_buku', $data);

        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        // $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $this->dompdf->load_html($html);
        // $this->dompdf->render();
        $this->dompdf->stream("laporan_data_kamar.pdf", array('Attachment' => 0));
        $this->load->view('kamar/laporan_pdf_kamar', $data);
    }

    public function export_excel()
    {
        $data = array('title' => 'Laporan Buku', 'buku' => $this->Kamar_model->getBuku()->result_array());
        $this->load->view('buku/export_excel_buku', $data);
    }


    public function laporan_pinjam()
    {
        $data['title'] = 'Laporan Data Peminjaman';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['laporan'] = $this->db->query("select * from pinjam p,detail_pinjam d,           
        buku b,user u where d.id_buku=b.id and p.id_user=u.id           
        and p.no_pinjam=d.no_pinjam")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('pinjam/laporan-pinjam', $data);
        $this->load->view('templates/footer');
    }
}
