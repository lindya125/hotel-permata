<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    //manajemen kamar
    public function index()
    {
        $data['title'] = 'Data Kamar';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kamar'] = $this->Kamar_model->getKamar()->result_array();
        $data['kategori'] = $this->Kamar_model->getKategori()->result_array();

        $this->form_validation->set_rules('type_kamar', 'Type Kamar', 'required|min_length[3]', [
            'required' => 'Type Kamar harus diisi',
            'min_length' => 'Type Kamar terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama kamar harus diisi',
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[5]|numeric', [
            'required' => 'Harga harus diisi',
            'min_length' => 'Harga terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        // $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
        //     'required' => 'Nama penerbit harus diisi',
        //     'min_length' => 'Nama penerbit terlalu pendek'
        // ]);
        // $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
        //     'required' => 'Tahun terbit harus diisi',
        //     'min_length' => 'Tahun terbit terlalu pendek',
        //     'max_length' => 'Tahun terbit terlalu panjang',
        //     'numeric' => 'Hanya boleh diisi angka'
        // ]);
        // $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
        //     'required' => 'Nama ISBN harus diisi',
        //     'min_length' => 'Nama ISBN terlalu pendek',
        //     'numeric' => 'Yang anda masukan bukan angka'
        // ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/kamar/index', $data);
            $this->load->view('templates/admin/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'type_kamar' => $this->input->post('type_kamar', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'harga' => $this->input->post('harga', true),
                // 'penerbit' => $this->input->post('penerbit', true),
                // 'tahun_terbit' => $this->input->post('tahun', true),
                // 'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'check_in' => 0,
                'check_out' => 0,
                'image' => $gambar
            ];

            $this->Kamar_model->simpanKamar($data);
            redirect('kamar');
        }
    }

    public function hapusBuku()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->Kamar_model->hapusBuku($where);
        redirect('kamar');
    }

    public function ubahKamar()
    {
        $data['title'] = 'Ubah Data Kamar';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kamar'] = $this->Kamar_model->kamarWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->Kamar_model->joinKategoriKamar(['kamar.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->Kamar_model->getKategori()->result_array();

        $this->form_validation->set_rules('type_kamar', 'Type Kamar', 'required|min_length[3]', [
            'required' => 'Judul Buku harus diisi',
            'min_length' => 'Judul buku terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Nama kamar harus diisi',
        ]);
        $this->form_validation->set_rules('harga', 'Nama Pengarang', 'required|min_length[3]|numeric', [
            'required' => 'Harga harus diisi',
            'min_length' => 'Harga terlalu pendek',
            'numeric' => 'Hanya boleh diisi angka'
        ]);
        // $this->form_validation->set_rules('penerbit', 'Nama Penerbit', 'required|min_length[3]', [
        //     'required' => 'Nama penerbit harus diisi',
        //     'min_length' => 'Nama penerbit terlalu pendek'
        // ]);
        // $this->form_validation->set_rules('tahun', 'Tahun Terbit', 'required|min_length[3]|max_length[4]|numeric', [
        //     'required' => 'Tahun terbit harus diisi',
        //     'min_length' => 'Tahun terbit terlalu pendek',
        //     'max_length' => 'Tahun terbit terlalu panjang',
        //     'numeric' => 'Hanya boleh diisi angka'
        // ]);
        // $this->form_validation->set_rules('isbn', 'Nomor ISBN', 'required|min_length[3]|numeric', [
        //     'required' => 'Nama ISBN harus diisi',
        //     'min_length' => 'Nama ISBN terlalu pendek',
        //     'numeric' => 'Yang anda masukan bukan angka'
        // ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/kamar/ubah_kamar', $data);
            // $this->load->view('templates/admin/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'type_kamar' => $this->input->post('type_kamar', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'harga' => $this->input->post('harga', true),
                // 'penerbit' => $this->input->post('penerbit', true),
                // 'tahun_terbit' => $this->input->post('tahun', true),
                // 'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'image' => $gambar
            ];

            $this->Kamar_model->updateKamar($data, ['id' => $this->input->post('id')]);
            redirect('kamar');
        }
    }

    //manajemen kategori
    public function kategori()
    {
        $data['title'] = 'Kategori Buku';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->Kamar_model->getKategori()->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Type Kamar harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/kamar/kategori', $data);
            $this->load->view('templates/admin/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori', TRUE)
            ];

            $this->Kamar_model->simpanKategori($data);
            redirect('kamar/kategori');
        }
    }

    public function ubahKategori()
    {
        $data['title'] = 'Ubah Data Kategori';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->Kamar_model->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();


        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin/header', $data);
            $this->load->view('templates/admin/sidebar', $data);
            $this->load->view('templates/admin/topbar', $data);
            $this->load->view('admin/kamar/ubah_kategori', $data);
            $this->load->view('templates/admin/footer');
        } else {

            $data = [
                'kategori' => $this->input->post('kategori', true)
            ];

            $this->Kamar_model->updateKategori(['id' => $this->input->post('id')], $data);
            redirect('kamar/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->Kamar_model->hapusKategori($where);
        redirect('kamar/kategori');
    }
}
