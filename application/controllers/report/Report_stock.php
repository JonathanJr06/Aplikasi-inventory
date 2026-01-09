<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Report_stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Pdf');
        if (!$this->session->userdata('level')) {
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']        = 'Laporan';
        $data['subtitle']    = 'Semua data laporan Barang akan muncul disini';

        // $data['santri']    = $this->m_model->get_desc('tb_santri');
        // //$data['santrii']	= $this->m_model->get_desc('tb_santri')->result_array();
        // $data['agama']    = $this->m_model->get_desc('tb_agama');
        // $data['absensi']    = $this->m_model->get_desc('tb_absensi');
        // $data['kelas']    = $this->m_model->get_desc('tb_kelas');
        // $data['pembayaran']    = $this->m_model->get_desc('tb_pembayaran');

        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->m_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $url_cetak = 'report_stock/cetak';
            $label = 'Semua Data Laporan Santri';
        } else { // Jika terisi
            $transaksi = $this->m_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $url_cetak = 'report_stock/cetak?tgl_awal=' . $tgl_awal . '&tgl_akhir=' . $tgl_akhir;
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
        }
        $data['transaksi'] = $transaksi;
        $data['url_cetak'] = base_url('index.php/report/' . $url_cetak);
        $data['label'] = $label;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('report/report_stock');
        $this->load->view('templates/footer');
    }

    public function cetak()
    {
        $tgl_awal = $this->input->get('tgl_awal'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = $this->input->get('tgl_akhir'); // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            $transaksi = $this->m_model->view_all();  // Panggil fungsi view_all yang ada di TransaksiModel
            $label = 'Semua Data';
        } else { // Jika terisi
            $transaksi = $this->m_model->view_by_date($tgl_awal, $tgl_akhir);  // Panggil fungsi view_by_date yang ada di TransaksiModel
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
        }
        $data1 =  $label;
        $data = $transaksi;
        // $data['label'] = $label;
        // $data['transaksi'] = $transaksi;
        // ob_start();
        // $this->load->view('print', $data);
        // $html = ob_get_contents();
        // ob_end_clean();
        // require './assets/libraries/html2pdf/autoload.php'; // Load plugin html2pdfnya
        // $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');  // Settingan PDFnya
        // $pdf->WriteHTML($html);
        // $pdf->Output('Data Transaksi.pdf', 'D');
        //

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Laporan Data Barang ', 0, 1, 'C');
        $pdf->Cell(0, 7,  $data1, 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 6, 'No', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Date ', 1, 0, 'C');
        $pdf->Cell(37, 6, 'Kode Barang', 1, 0, 'C');
        $pdf->Cell(34, 6, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(34, 6, 'Kategori', 1, 0, 'C');
        $pdf->Cell(24, 6, 'Stock', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 10);

        $gangguan =  $data;
        //$where = array('id' => $id);
        //$gangguan = $this->db->get('tb_pelatihankaryawan')->result();
        $no = 0;
        foreach ($gangguan as $data) {
            $no++;
            $pdf->Cell(10, 6, $no, 1, 0, 'C');
            $pdf->Cell(20, 6, $data->date, 1, 0);
            $pdf->Cell(37, 6, $data->kd_barang, 1, 0);
            $pdf->Cell(34, 6, $data->nama_barang, 1, 0);
            $this->db->where('id', $data->id_category);
            foreach ($this->db->get('tb_category')->result() as $a) {

                $pdf->Cell(34, 6, $a->category, 1, 0);
            }
            $pdf->Cell(24, 6, $data->stock, 1, 1);
        }
        $pdf->Output();
    }

    public function update($id)
    {
        $id_santri             = $_POST['id_santri'];
        $pembayaran            = $_POST['pembayaran'];
        $deskripsi             = $_POST['deskripsi'];
        $total                  = $_POST['total'];
        $tgl_mulai              = $_POST['tgl_mulai'];
        $tgl_akhir               = $_POST['tgl_akhir'];
        $denda                = $_POST['denda'];
        $keterangan             = $_POST['keterangan'];

        $data = array(
            'id_santri'  => $id_santri,
            'pembayaran' => $pembayaran,
            'deskripsi' => $deskripsi,
            'total'     => $total,
            'tgl_mulai' => $tgl_mulai,
            'tgl_akhir' => $tgl_akhir,
            'denda'     => $denda,
            'keterangan' => $keterangan,
        );
        $where = array('id' => $id);

        $this->m_model->update($where, $data, 'tb_pembayaran');
        $this->session->set_flashdata('pesan', 'Data pembayaran Berhasil Ditambahkan!');
        redirect('admin/keuangan/pembayaran');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_pembayaran');
        $this->session->set_flashdata('pesan', 'Data pembayaran Berhasil Dihapus!');
        redirect('admin/keuangan/pembayaran');
    }
}
