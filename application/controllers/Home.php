<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('level') == 'Administrator') {
            redirect('admin/dashboard');
        } else {
            $data['title']  = 'Login';
            $digit1 = mt_rand(1, 20);
            $digit2 = mt_rand(1, 20);

            $captcha = array('captcha' => $digit1 + $digit2);

            $this->session->set_userdata($captcha);
            $data['captcha'] = "$digit1 + $digit2 = ?";

            $data['aplikasi'] = $this->m_model->get_desc('tb_aplikasi');
            $this->load->view('login', $data);
        }
    }

    public function auth()
    {
        date_default_timezone_set('Asia/Jakarta');

        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $jawaban    = $_POST['jawaban'];

        if (!empty($jawaban)) {
            if ($jawaban == $this->session->userdata('captcha')) {

                $where = array('username' => $username);

                $cek = $this->m_model->get_where($where, 'tb_user');

                if ($cek->num_rows() > 0) {
                    foreach ($cek->result_array() as $row) {

                        if (password_verify($password, $row['password'])) {

                            $datauser = array(
                                'id'            => $row['id'],
                                'nama'          => $row['nama'],
                                'telp'          => $row['telp'],
                                'email'         => $row['email'],
                                'username'      => $row['username'],
                                'skin'          => $row['skin'],
                                'level'         => $row['level'],
                                'foto'          => $row['foto'],
                                'terdaftar'     => $row['terdaftar']
                            );

                            $this->session->set_userdata($datauser);

                            $insertLog = array(
                                'idUser'    => $row['id'],
                                'status'    => 'Login',
                                'ipAddress' => $_SERVER['REMOTE_ADDR'],
                                'device'    => $_SERVER['HTTP_USER_AGENT'],
                                'terdaftar' => date('Y-m-d H:i:s'),
                            );

                            $this->m_model->insert($insertLog, 'tb_log');

                            if ($row['level'] == 'Administrator') {
                                redirect('home_dashboard/dashboard');
                            } else if ($row['level'] == 'Operator') {
                                redirect('home_dashboard/dashboard');
                            } else if ($row['level'] == 'Manager') {
                                redirect('home_dashboard/dashboard');
                            }
                        } else {
                            $this->session->set_flashdata('pesan', 'Password anda salah!');
                            redirect('home');
                        }
                    }
                } else {
                    $this->session->set_flashdata('pesan', 'Username tidak ditemukan!');
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Hitung dengan benar!');
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Captcha harap diisi!');
            redirect('home');
        }
    }

    public function logout()
    {
        date_default_timezone_set('Asia/Jakarta');

        $insertLog = array(
            'idUser'    => $this->session->userdata('id'),
            'status'    => 'Logout',
            'ipAddress' => $_SERVER['REMOTE_ADDR'],
            'device'    => $_SERVER['HTTP_USER_AGENT'],
            'terdaftar' => date('Y-m-d H:i:s'),
        );

        $this->m_model->insert($insertLog, 'tb_log');

        $this->session->sess_destroy();
        redirect('home');
    }
}
