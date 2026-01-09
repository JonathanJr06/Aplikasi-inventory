<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

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
		$data['title']		= 'Data Pembayaran';
		$data['subtitle']	= 'Semua data pembayaran akan muncul disini';

		$data['pelanggan']	= $this->m_model->get_desc('tb_pelanggan');
		$data['pembayaran']	= $this->m_model->get_desc('tb_pembayaran');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/pembayaran');
		$this->load->view('admin/templates/footer');
    }

	public function cari()
	{
		$idPelanggan = $_POST['idPelanggan'];

		redirect("admin/pembayaran/detailpembayaran/$idPelanggan");
	}

	public function detailpembayaran($idPelanggan)
	{
		$data['title']		= 'Detail Pembayaran';
		$data['subtitle']	= 'Semua detail pembayaran pelanggan yang dipilih akan muncul disini';

		$data['idPelanggan']	= $idPelanggan;
		$this->db->where('id', $idPelanggan);
		$data['pelanggan']		= $this->m_model->get_desc('tb_pelanggan');
		$this->db->where('idPelanggan', $idPelanggan);
		$data['pembayaran']		= $this->m_model->get_desc('tb_pembayaran');

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/detailpembayaran');
		$this->load->view('admin/templates/footer');
	}

    public function delete($id, $idPelanggan)
	{
		$where = array('id' => $id);

		$this->m_model->delete($where, 'tb_pembayaran');
		$this->session->set_flashdata('pesan', 'Data Pembayaran Berhasil Dihapus!');
		
		redirect("admin/pembayaran/detailpembayaran/$idPelanggan");
	}

	public function insert($idPelanggan)
	{
		date_default_timezone_set("Asia/Jakarta");

		$idPelanggan	= $idPelanggan;
		$idUser			= $this->session->userdata('id');
		$tanggal		= $_POST['tanggal'];
		$nominal		= $_POST['nominal'];
		$terdaftar 		= date('Y-m-d H:i:s');

		$data = array(
			'idPelanggan' 	=> $idPelanggan,
			'idUser' 		=> $idUser,
			'tanggal' 		=> $tanggal,
			'nominal' 		=> $nominal,
			'terdaftar' 	=> $terdaftar,
		);

		$this->m_model->insert($data, 'tb_pembayaran');
		$this->session->set_flashdata('pesan', 'Data Pembayaran Berhasil Ditambahkan!');

		redirect("admin/pembayaran/detailpembayaran/$idPelanggan");
	}

	public function update($id, $idPelanggan)
	{
		$tanggal		= $_POST['tanggal'];
		$nominal		= $_POST['nominal'];

		$data = array(
			'tanggal' 		=> $tanggal,
			'nominal' 		=> $nominal
		);

		$where = array('id' => $id);

		$this->m_model->update($where, $data, 'tb_pembayaran');
		$this->session->set_flashdata('pesan', 'Data Pembayaran Berhasil Diubah!');

		redirect("admin/pembayaran/detailpembayaran/$idPelanggan");
	}
}