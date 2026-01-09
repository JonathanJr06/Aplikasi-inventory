<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Uom extends CI_Controller
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
        $data['title']      = 'Data Satuan';
        $data['subtitle']   = 'Semua data satuan akan muncul disini';

        $data['uom']   = $this->m_model->get_desc('tb_uom');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/uom');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $nama_satuan       = $_POST['nama_satuan'];
        $keterangan       = $_POST['keterangan'];
        $data = array(
            'nama_satuan'         => $nama_satuan,
            'keterangan'         => $keterangan,
        );

        $this->m_model->insert($data, 'tb_uom');
        $this->session->set_flashdata('pesan', 'Data Satuan Berhasil Ditambahkan!');
        redirect('operator/uom');
    }

    public function update($id)
    {
        $nama_satuan       = $_POST['nama_satuan'];
        $keterangan       = $_POST['keterangan'];
        $data = array(
            'nama_satuan'         => $nama_satuan,
            'keterangan'         => $keterangan,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_uom');
        $this->session->set_flashdata('pesan', 'Data Satuan Berhasil Diubah!');
        redirect('operator/uom');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_uom');
        $this->session->set_flashdata('pesan', 'Data Satuan Berhasil dihapus!');
        redirect('operator/satuan');
    }
}
