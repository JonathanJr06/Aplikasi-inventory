<?php
defined('BASEPATH') or exit('No Direct script access Allowed');

class Detailmasterdatabarang extends CI_Controller
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
        $data['title']      = 'Detail Master Data Barang';
        $data['subtitle']   = 'Detail Semua master data barang akan muncul disini';

        $data['master_data_barang']   = $this->m_model->get_desc('tb_master_data_barang');
        $data['category']   = $this->m_model->get_desc('tb_category');
        $data['brand']   = $this->m_model->get_desc('tb_brand');
        $data['uom']   = $this->m_model->get_desc('tb_uom');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/detailmasterdatabarang');
        $this->load->view('templates/footer');
    }
}
