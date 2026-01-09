<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level')){
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		}
	}

	public function index()
	{
		$data['title']		= 'Data Pelanggan';
		$data['subtitle']	= 'Semua data pelanggan akan muncul disini';

		$data['pelanggan']	= $this->m_model->get_desc('tb_pelanggan');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/pelanggan');
		$this->load->view('admin/templates/footer');
    }

    public function delete($id)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_pelanggan');
		$this->session->set_flashdata('pesan', 'Data Pelanggan Berhasil Dihapus!');
		redirect('admin/pelanggan');
	}

	public function insert()
	{
		date_default_timezone_set("Asia/Jakarta");
		$nama			= $_POST['nama'];
		$telp			= $_POST['telp'];
		$tgltagihan		= $_POST['tgltagihan'];
		$alamat			= $_POST['alamat'];
		$nominal		= $_POST['nominal'];
		$status			= $_POST['status'];
		$terdaftar 		= date('Y-m-d H:i:s');

		$data = array(
			'nama' 			=> $nama,
			'telp' 			=> $telp,
			'alamat' 		=> $alamat,
			'tgltagihan' 	=> $tgltagihan,
			'nominal' 		=> $nominal,
			'status' 		=> $status,
			'terdaftar' 	=> $terdaftar,
		);

		$this->m_model->insert($data, 'tb_pelanggan');
		$this->session->set_flashdata('pesan', 'Data Pelanggan Berhasil Ditambahkan!');
		redirect('admin/pelanggan');
	}

	public function update($id)
	{
		$nama			= $_POST['nama'];
		$telp			= $_POST['telp'];
		$tgltagihan		= $_POST['tgltagihan'];
		$alamat			= $_POST['alamat'];
		$nominal		= $_POST['nominal'];
		$status			= $_POST['status'];

		$data = array(
			'nama' 			=> $nama,
			'telp' 			=> $telp,
			'alamat' 		=> $alamat,
			'tgltagihan' 	=> $tgltagihan,
			'nominal' 		=> $nominal,
			'status' 		=> $status,
		);

		$where = array('id' => $id);

		$this->m_model->update($where, $data, 'tb_pelanggan');
		$this->session->set_flashdata('pesan', 'Data Pelanggan Berhasil Diubah!');
		redirect('admin/pelanggan');
	}
}