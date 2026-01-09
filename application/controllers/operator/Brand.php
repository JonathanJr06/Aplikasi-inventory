<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Brand extends CI_Controller
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
        $data['title']      = 'Data Brand';
        $data['subtitle']   = 'Semua data brand akan muncul disini';

        $data['brand']   = $this->m_model->get_desc('tb_brand');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/brand');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $brand        = $_POST['brand'];
        $data = array(
            'brand'         => $brand,
        );

        $this->m_model->insert($data, 'tb_brand');
        $this->session->set_flashdata('pesan', 'Data Brand Berhasil Ditambahkan!');
        redirect('operator/brand');
    }

    public function update($id)
    {
        $brand        = $_POST['brand'];
        $data = array(
            'brand'         => $brand,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_brand');
        $this->session->set_flashdata('pesan', 'Data Brand Berhasil Diubah!');
        redirect('operator/brand');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_brand');
        $this->session->set_flashdata('pesan', 'Data Brand Berhasil dihapus!');
        redirect('operator/brand');
    }
}
