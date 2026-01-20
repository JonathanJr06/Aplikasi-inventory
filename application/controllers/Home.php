<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        // Cek apakah user sudah login sebagai Administrator
        if ($this->session->userdata('level') == 'Administrator') {
            redirect('admin/dashboard');
        } else {
            $data['title']  = 'Login';
            $digit1 = mt_rand(1, 20);
            $digit2 = mt_rand(1, 20);

            $this->session->set_userdata(array('captcha' => $digit1 + $digit2));
            $data['captcha'] = "$digit1 + $digit2 = ?";

            $data['aplikasi'] = $this->m_model->get_desc('tb_aplikasi')->result_array();
            $this->load->view('login', $data);
        }
    }

    public function auth()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $jawaban  = $this->input->post('jawaban', TRUE);

        if (!empty($jawaban)) {
            if ($jawaban == $this->session->userdata('captcha')) {
                $where = array('username' => $username);
                $cek = $this->m_model->get_where($where, 'tb_user');

                if ($cek->num_rows() > 0) {
                    $row = $cek->row_array();
                    if (password_verify($password, $row['password'])) {
                        
                        // Set data user ke session
                        $this->session->set_userdata($row);
                        
                        // PENTING: Kunci sesi agar tersimpan sebelum redirect
                        session_write_close(); 

                        if ($row['level'] == 'Administrator') {
                            redirect('admin/dashboard');
                        } else {
                            // Untuk level Operator/Manager diarahkan ke home_dashboard
                            redirect('home_dashboard/dashboard');
                        }
                    } else {
                        $this->session->set_flashdata('pesan', 'Password anda salah!');
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('pesan', 'Username tidak ditemukan!');
                    redirect('home');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Hitung captcha dengan benar!');
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Captcha harap diisi!');
            redirect('home');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }
}
