<?php
defined('BASEPATH') or exit('No direct script access allowed');

class backupdb extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        } elseif ($this->session->userdata('level') != 'Administrator') {
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']        = 'Backup Database';
        $data['subtitle']     = 'Backup Database akan muncul disini';

        $data['user']       = $this->m_model->get_desc('tb_user');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('admin/backupdb');
        $this->load->view('templates/footer');
    }

    public function do_backupdb()
    {
        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // nama file backup
        $namafile = "dbbackup" . "-" . date("Y-m-d_H-i-s") . ".sql.gz";

        // Load the file helper and write the file to your server
        $this->load->helper('file');

        write_file(FCPATH . '/db_backup/' . $namafile, $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download($namafile, $backup);
    }
}
