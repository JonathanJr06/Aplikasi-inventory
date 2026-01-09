<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['aplikasi']	= $this->m_model->get_desc('tb_aplikasi');
		$this->load->view('form', $data);
	}
}
