<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Master_data_barang extends CI_Controller
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
        $data['title']      = 'Data Stock Barang';
        $data['subtitle']   = 'Gudang APS';

        $data['master_data_barang']   = $this->m_model->get_desc('tb_master_data_barang');
        $data['category']   = $this->m_model->get_desc('tb_category');
        $data['brand']   = $this->m_model->get_desc('tb_brand');
        $data['uom']   = $this->m_model->get_desc('tb_uom');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/master_data_barang');
        $this->load->view('templates/footer');
    }

    public function detailmasterdata($idmasterdatabarang)
    {
        $data['title']      = 'Detail Master Data Barang';
        $data['subtitle']   = 'Detail Semua master data barang akan muncul disini';

        $data['masterdatabarang']    = $idmasterdatabarang;
        $this->db->where('id', $idmasterdatabarang);
        $data['masterdatabarang']   = $this->m_model->get_desc('tb_master_data_barang');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/detailmasterdatabarang');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $kd_barang        = $_POST['kd_barang'];
        $date               = $_POST['date'];
        $nama_barang       = $_POST['nama_barang'];
        $id_category       = $_POST['id_category'];
        // $id_brand          = $_POST['id_brand'];
        $id_uom            = $_POST['id_uom'];
        // $move_type         = $_POST['move_type'];
        // $price             = $_POST['price'];
        // $img               = $_FILES['img'];
        // $remark            = $_POST['remark'];
        $stock            = $_POST['stock'];

        $data = array(
            'kd_barang'         => $kd_barang,
            'date'              => $date,
            'nama_barang'       => $nama_barang,
            'id_category'       => $id_category,
            // 'id_brand'          => $id_brand,
            'id_uom'            => $id_uom,
            // 'move_type'         => $move_type,
            // 'price'             => $price,
            // 'img'               => $img,
            // 'remarks'           => $remark,
            'stock'           => $stock,
        );



        $this->m_model->insert($data, 'tb_master_data_barang');
        $this->session->set_flashdata('pesan', 'Data Stock Barang Berhasil Ditambahkan!');
        redirect('operator/master_data_barang');
    }

    public function delete($id)
    {
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_master_data_barang');
        $this->session->set_flashdata('pesan', 'Data Stock Barang Berhasil dihapus!');
        redirect('operator/master_data_barang');
    }

    public function update($id)
    {
        $kd_barang        = $_POST['kd_barang'];
        $date               = $_POST['date'];
        $nama_barang       = $_POST['nama_barang'];
        $id_category       = $_POST['id_category'];
        // $id_brand          = $_POST['id_brand'];
        $id_uom            = $_POST['id_uom'];
        // $move_type         = $_POST['move_type'];
        // $price             = $_POST['price'];
        // $img               = $_FILES['img'];
        // $remark            = $_POST['remark'];
        $stock            = $_POST['stock'];

        $data = array(
            'kd_barang'         => $kd_barang,
            'date'              => $date,
            'nama_barang'       => $nama_barang,
            'id_category'       => $id_category,
            // 'id_brand'          => $id_brand,
            'id_uom'            => $id_uom,
            // 'move_type'         => $move_type,
            // 'price'             => $price,
            // 'img'               => $img,
            // 'remarks'           => $remark,
            'stock'           => $stock,
        );


        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_master_data_barang');
        $this->session->set_flashdata('pesan', 'Data Stock Barang Berhasil Diubah!');
        redirect('operator/master_data_barang');
    }

    public function detailmasterdatabarang($id)
    {
    }
}
