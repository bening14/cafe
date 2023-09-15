<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Crud", "crud");
    }

    public function index()
    {
        if ($this->session->userdata('idkamu') != '') {

            if ($this->session->userdata('level') == 'superuser') {
                redirect('dashboard');
            } else if ($this->session->userdata('level') == 'admin') {
                redirect('customer');
            } else if ($this->session->userdata('level') == 'manajer') {
                redirect('customer/manajer');
            } else if ($this->session->userdata('level') == 'kasir') {
                redirect('customer/kasir');
            } else if ($this->session->userdata('level') == 'waitress') {
                redirect('customer/waitress');
            } else if ($this->session->userdata('level') == 'kitchen') {
                redirect('customer/kitchen');
            } else {
                redirect('error404');
            }
        } else {
            $this->form_validation->set_rules('idkamu', 'Username', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/login');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $idkamu = $this->input->post('idkamu');
        $password = $this->input->post('password');

        //ambil data dari model
        $table = 'mst_user';
        $where = array(
            'idkamu' => $idkamu,
        );
        $user = $this->Crud->get_where($table, $where)->row_array();

        if ($user) {
            //cek dulu member aktive atau tidak
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    //jika sukses
                    $data = array(
                        'idkamu' => $user['idkamu'],
                        'email' => $user['email'],
                        'level' => $user['level'],
                        'id' => $user['id'],
                        'id_mst_brand' => $user['id_mst_brand'],
                        'id_mst_store' => $user['id_mst_store']
                    );
                    //buat session
                    $this->session->set_userdata($data);
                    // redirect('dashboard');

                    if ($user['level'] == 'superuser') {
                        redirect('dashboard');
                    } else if ($user['level'] == 'admin') {
                        redirect('customer');
                    } else if ($user['level'] == 'manajer') {
                        redirect('customer/manajer');
                    } else if ($user['level'] == 'kasir') {
                        redirect('customer/kasir');
                    } else if ($user['level'] == 'waitress') {
                        redirect('customer/waitress');
                    } else if ($user['level'] == 'kitchen') {
                        redirect('customer/kitchen');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Salah Password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Username belum diaktifkan</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Userid belum terdaftar</div>');
            redirect('auth');
        }
    }

    public function forgot()
    {
        $this->load->view('auth/forgot');
    }

    public function register()
    {
        $this->load->view('auth/register');
    }

    public function verify()
    {
        $this->load->view('auth/verify');
    }

    public function reset()
    {
        $this->load->view('auth/reset');
    }

    public function logout()
    {
        $this->session->unset_userdata('idkamu');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('id_mst_brand');
        $this->session->unset_userdata('id_mst_store');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Anda sudah keluar.</div>');
        redirect('auth');
    }
}
