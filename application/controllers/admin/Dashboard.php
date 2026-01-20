<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $level = $this->session->userdata('level');
        
        // Cek apakah session level tersedia
        if (empty($level)) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        } 
        
        // Pastikan level adalah Administrator (Gunakan trim untuk keamanan)
        if (trim($level) != 'Administrator') {
            $this->session->set_flashdata('pesan', 'Anda tidak memiliki hak akses!');
            redirect('home');
        }
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data['title'] = 'Dashboard Admin';

        // Mengambil data pelanggan untuk tampilan
        $data['pelanggan'] = $this->db->query('SELECT * FROM tb_pelanggan WHERE id NOT IN (SELECT DISTINCT(idPelanggan) FROM tb_pembayaran WHERE MONTH(tanggal)="' . date('m') . '" AND YEAR(tanggal)="' . date('Y') . '") AND status="Aktif"');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard'); 
        $this->load->view('templates/footer');
    }
}
