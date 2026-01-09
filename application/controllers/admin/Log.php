<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Log extends CI_Controller
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
		$data['title']		= 'Data Log';
		$data['subtitle']	= 'Semua log akan muncul disini';

		$data['log']		= $this->m_model->get_desc('tb_log');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('admin/log');
		$this->load->view('templates/footer');
	}
}
