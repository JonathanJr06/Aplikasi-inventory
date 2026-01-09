<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_model extends CI_Model
{
	public function getTable()
	{
		$this->db->select('tb_productreceiving.*, tb_uom.keterangan');
		$this->db->from('tb_productreceiving');
		$this->db->join('tb_uom', 'tb_uom.id = tb_productreceiving.id_uom');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_where($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function insert($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_desc($table)
	{
		$this->db->ORDER_BY('id', 'desc');
		return $this->db->get($table);
	}
	public function getAll()
	{
		return $this->db->get('tb_master_data_barang')->result();
	}

	public function delete($where, $table)
	{
		$this->db->delete($table, $where);
	}

	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function view_all()
	{
		return $this->db->get('tb_master_data_barang')->result(); // Tampilkan semua data transaksi
	}

	public function view_all_receiving()
	{
		return $this->db->get('tb_receiving')->result(); // Tampilkan semua data transaksi
	}

	public function view_all_issuing()
	{
		return $this->db->get('tb_issuing')->result(); // Tampilkan semua data transaksi
	}
	public function view_by_date($tgl_awal, $tgl_akhir)
	{
		$tgl_awal = $this->db->escape($tgl_awal);
		$tgl_akhir = $this->db->escape($tgl_akhir);
		$this->db->where('DATE(date) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir); // Tambahkan where tanggal nya
		return $this->db->get('tb_master_data_barang')->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
	}

	public function view_by_date_receiving($tgl_awal, $tgl_akhir)
	{
		$tgl_awal = $this->db->escape($tgl_awal);
		$tgl_akhir = $this->db->escape($tgl_akhir);
		$this->db->where('DATE(date) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir); // Tambahkan where tanggal nya
		return $this->db->get('tb_receiving')->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
	}

	public function view_by_date_issuing($tgl_awal, $tgl_akhir)
	{
		$tgl_awal = $this->db->escape($tgl_awal);
		$tgl_akhir = $this->db->escape($tgl_akhir);
		$this->db->where('DATE(date) BETWEEN ' . $tgl_awal . ' AND ' . $tgl_akhir); // Tambahkan where tanggal nya
		return $this->db->get('tb_issuing')->result(); // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
	}
}
