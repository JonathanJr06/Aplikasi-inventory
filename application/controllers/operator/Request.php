<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
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

    // List all your items
    public function index($offset = 0)
    {
        $data['title']      = 'Request Barang';
        $data['subtitle']   = '';

        $data['master_data_barang']     = $this->m_model->get_desc('tb_master_data_barang');
        $data['category']               = $this->m_model->get_desc('tb_category');
        $data['brand']                  = $this->m_model->get_desc('tb_brand');
        $data['uom']                    = $this->m_model->get_desc('tb_uom');
        $data['issuing']                = $this->m_model->get_desc('tb_issuing');
        $data['request']                = $this->m_model->get_desc('tb_request');


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/request');
        $this->load->view('templates/footer');
    }

    // Add a new item
    public function add()
    {
        $tanggal        = $_POST['tanggal'];
        $category               = $_POST['category'];
        $kd_barang               = $_POST['kd_barang'];
        $nama_barang       = $_POST['nama_barang'];
        $jumlah       = $_POST['jumlah'];
        $id_uom            = $_POST['id_uom'];
        $keterangan            = $_POST['keterangan'];

        $data = array(
            'tanggal'         => $tanggal,
            'category'        => $category,
            'kd_barang'       => $kd_barang,
            'nama_barang'     => $nama_barang,
            'jumlah'          => $jumlah,
            'id_uom'          => $id_uom,
            'keterangan'           => $keterangan,
        );



        $this->m_model->insert($data, 'tb_request');
        $this->session->set_flashdata('pesan', 'Data Request Barang Berhasil Ditambahkan!');
        redirect('operator/request');
    }

    //Update one item
    public function update($id = NULL)
    {
        $tanggal        = $_POST['tanggal'];
        $category               = $_POST['category'];
        $kd_barang               = $_POST['kd_barang'];
        $nama_barang       = $_POST['nama_barang'];
        $jumlah       = $_POST['jumlah'];
        $id_uom            = $_POST['id_uom'];
        $keterangan            = $_POST['keterangan'];

        $data = array(
            'tanggal'         => $tanggal,
            'category'        => $category,
            'kd_barang'       => $kd_barang,
            'nama_barang'     => $nama_barang,
            'jumlah'          => $jumlah,
            'id_uom'          => $id_uom,
            'keterangan'           => $keterangan,
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_request');
        $this->session->set_flashdata('pesan', 'Data Request Barang Berhasil Diupdate!');
        redirect('operator/request');
    }

    //Delete one item
    public function delete($id = NULL)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_request');
        $this->session->set_flashdata('pesan', 'Data Request Berhasil dihapus!');
        redirect('operator/request');
    }
}

/* End of file Request.php */
