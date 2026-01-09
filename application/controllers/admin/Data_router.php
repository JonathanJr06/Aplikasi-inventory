<?php

defined('BASEPATH') OR exit('No Direct script access Allowed');

class Data_router extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('level')){
            $this->session->set_flashdata('pesan','Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index(){
        $data['title']      = 'Data IP Router';
        $data['subtitle']   = 'Semua data IP Router akan muncul disini';

        $data['iprouter']   = $this->m_model->get_desc('tb_iprouter');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/data_router');
        $this->load->view('admin/templates/footer');

    }

    public function delete($id){
        $where  = array('id' => $id);
        $this->m_model->delete($where, 'tb_iprouter');
        $this->session->set_flashdata('pesan','Data Router Berhasil dihapus!');
        redirect('admin/data_router');
    }

    public function insert(){
        $router			= $_POST['router'];
		$ip_router		= $_POST['ip_router'];
		$nama	    	= $_POST['nama'];
		$alamat			= $_POST['alamat'];
		$status			= $_POST['status'];

		$data = array(
			'router' 		=> $router,
			'ip_router' 	=> $ip_router,
			'nama' 		    => $nama,
			'alamat' 	    => $alamat,
			'status' 		=> $status,
		);

		$this->m_model->insert($data, 'tb_iprouter');
		$this->session->set_flashdata('pesan', 'Data Pelanggan Berhasil Ditambahkan!');
		redirect('admin/data_router');
	}
    
    public function update($id){

        $router			= $_POST['router'];
		$ip_router		= $_POST['ip_router'];
		$nama	    	= $_POST['nama'];
		$alamat			= $_POST['alamat'];
		$status			= $_POST['status'];

		$data = array(
			'router' 		=> $router,
			'ip_router' 	=> $ip_router,
			'nama' 		    => $nama,
			'alamat' 	    => $alamat,
			'status' 		=> $status,
		);

        $where = array('id' => $id);
        $this->m_model->update($where, $data, 'tb_iprouter');
		$this->session->set_flashdata('pesan', 'Data Router Berhasil Diubah!');
		redirect('admin/data_router');
    }

}



?>