<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        } elseif ($this->session->userdata('level') != 'Operator') {
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']      = 'Data Kategori';
        $data['subtitle']   = 'Semua data Kategori akan muncul disini';

        $data['category']   = $this->m_model->get_desc('tb_category');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/kategori');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $category        = $_POST['category'];
        $data = array(
            'category'         => $category,
        );

        $this->m_model->insert($data, 'tb_category');
        $this->session->set_flashdata('pesan', 'Data Kategori Berhasil Ditambahkan!');
        redirect('operator/kategori');
    }

    public function update($id)
    {
        $category        = $_POST['category'];
        $data = array(
            'category'         => $category,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_category');
        $this->session->set_flashdata('pesan', 'Data Kategori Berhasil Diubah!');
        redirect('operator/kategori');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_category');
        $this->session->set_flashdata('pesan', 'Data Kategori Berhasil dihapus!');
        redirect('operator/kategori');
    }
}
