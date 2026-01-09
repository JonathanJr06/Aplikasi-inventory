<?php
defined('BASEPATH') or exit('No direct script access allowed');

class O_Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data['title']    = 'Dashboard Operator';

        $data['bulanKemarin']        = date('F Y', strtotime('-1 month'));
        $data['belumbayarKemarin']    = $this->db->query('SELECT * FROM tb_pelanggan WHERE id NOT IN (SELECT DISTINCT(idPelanggan) FROM tb_pembayaran WHERE MONTH(tanggal)="' . date('m', strtotime('-1 month')) . '" AND YEAR(tanggal)="' . date('Y') . '") AND status="Aktif"');
        $data['pelanggan']            = $this->db->query('SELECT * FROM tb_pelanggan WHERE id NOT IN (SELECT DISTINCT(idPelanggan) FROM tb_pembayaran WHERE MONTH(tanggal)="' . date('m') . '" AND YEAR(tanggal)="' . date('Y') . '") AND status="Aktif"');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('operator/o_dashboard');
        $this->load->view('templates/footer');
    }
}
