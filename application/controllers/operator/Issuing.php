<?php

defined('BASEPATH') or exit('No Direct script access Allowed');

class Issuing extends CI_Controller
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
        $data['title']      = 'Barang Keluar';
        $data['subtitle']   = '';

        $data['master_data_barang']     = $this->m_model->get_desc('tb_master_data_barang');
        $data['category']               = $this->m_model->get_desc('tb_category');
        $data['brand']                  = $this->m_model->get_desc('tb_brand');
        $data['uom']                    = $this->m_model->get_desc('tb_uom');
        $data['issuing']                = $this->m_model->get_desc('tb_issuing');


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/issuing');
        $this->load->view('templates/footer');
    }

    public function insert_issuing()
    {
        $date                       = $_POST['date'];
        $id_category                = $_POST['id_category'];
        $id_master_data_barang       = $_POST['id_master_data_barang'];
        $jumlah                     = $_POST['jumlah'];
        $id_uom                     = $_POST['id_uom'];
        $supplier                   = $_POST['supplier'];
        $keterangan                 = $_POST['keterangan'];

        $data = array(

            'date'                      => $date,
            'id_category'               => $id_category,
            'id_master_data_barang'     => $id_master_data_barang,
            'id_uom'                    => $id_uom,
            'jumlah'                    => $jumlah,
            'supplier'                  => $supplier,
            'keterangan'                => $keterangan
        );
        $this->m_model->insert($data, 'tb_issuing');
        $this->session->set_flashdata('pesan', 'Data Keterangan Barang Keluar Berhasil Ditambahkan!');
        redirect('operator/issuing');
    }

    public function updateIssuing($id)
    {
        $date                       = $_POST['date'];
        $id_category                = $_POST['id_category'];
        $id_master_data_barang       = $_POST['id_master_data_barang'];
        $jumlah                     = $_POST['jumlah'];
        $id_uom                     = $_POST['id_uom'];
        $supplier                   = $_POST['supplier'];
        $keterangan                 = $_POST['keterangan'];

        $data = array(

            'date'                      => $date,
            'id_category'               => $id_category,
            'id_master_data_barang'     => $id_master_data_barang,
            'id_uom'                    => $id_uom,
            'jumlah'                    => $jumlah,
            'supplier'                  => $supplier,
            'keterangan'                => $keterangan
        );

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_issuing');
        $this->session->set_flashdata('pesan', 'Data Barang Keluar Berhasil Diupdate!');
        redirect('operator/issuing');
    }

    public function detail_issuing($idIssuing)
    {
        $data['title']      = 'Detail Barang Keluar';
        $data['subtitle']   = '';

        $data['idIssuing']        = $idIssuing;
        $this->db->where('id', $idIssuing);
        $data['issuing']          = $this->m_model->get_desc('tb_issuing');
        $this->db->where('idIssuing', $idIssuing);
        $data['productissuing']        = $this->m_model->get_desc('tb_productissuing');
        $data['masterDatabarang']        = $this->m_model->get_desc('tb_master_data_barang');
        $data['Uom']                    = $this->m_model->get_desc('tb_uom');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/detailissuing');
        $this->load->view('templates/footer');
    }


    public function form_receiving()
    {
        $data['title']      = 'Receiving';
        $data['subtitle']   = 'Insert receiving transaction';

        $data['master_data_barang']     = $this->m_model->get_desc('tb_master_data_barang');
        $data['category']               = $this->m_model->get_desc('tb_category');
        $data['brand']                  = $this->m_model->get_desc('tb_brand');
        $data['uom']                    = $this->m_model->get_desc('tb_uom');
        $data['receiving']              = $this->m_model->get_desc('tb_receiving');


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/form_receiving');
        $this->load->view('templates/footer');
    }

    public function updateReceiving($id)
    {
        $no_receiving  = $_POST['no_receiving'];
        $date           = $_POST['date'];
        $supplier       = $_POST['supplier'];
        $remarks        = $_POST['remarks'];

        $data = array(
            'no_receiving'  => $no_receiving,
            'date'          => $date,
            'supplier'      => $supplier,
            'remarks'       => $remarks
        );
        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_receiving');
        $this->session->set_flashdata('pesan', 'Data receiving Berhasil Diubah!');
        redirect('operator/receiving');
    }

    public function insertDetailissuing($idissuing)
    {
        $idissuing                  = $idissuing;
        $id_master_data_barang        = $_POST['id_master_data_barang'];
        $id_uom                        = $_POST['id_uom'];
        $jumlah                       = $_POST['jumlah'];

        $data = array(
            'idissuing'                => $idissuing,
            'id_master_data_barang'      => $id_master_data_barang,
            'id_uom'                     => $id_uom,
            'jumlah'                    => $jumlah,
        );
        $this->m_model->insert($data, 'tb_productissuing');
        $this->session->set_flashdata('pesan', 'Data Barang Keluar Berhasil Ditambahkan!');

        redirect("operator/issuing/detail_issuing/$idissuing");
    }

    public function updateDetailReceiving($id, $idReceiving)
    {
    }
    public function deleteDetailIssuing($id, $Issuing)
    {
        $where = array('id' => $id);
        $this->m_model->delete($where, 'tb_productissuing');
        $this->session->set_flashdata('pesan', 'Data Barang Keluar Berhasil dihapus!');
        redirect("operator/issuing/detail_issuing/$Issuing");
    }

    public function delete($id)
    {
        $where = array('id' => $id);
        $this->m_model->delete($where, 'tb_issuing');
        $this->session->set_flashdata('pesan', 'Data Keterangan Barang Berhasil dihapus!');
        redirect('operator/issuing');
    }
}
