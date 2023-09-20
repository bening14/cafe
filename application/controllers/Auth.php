<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('./resources/phpmail/PHPMailer.php');
require('./resources/phpmail/Exception.php');
require('./resources/phpmail/OAuth.php');
require('./resources/phpmail/POP3.php');
require('./resources/phpmail/SMTP.php');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Crud", "crud");
    }

    public function index()
    {
        if ($this->session->userdata('email') != '') {

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
            $this->form_validation->set_rules('email', 'Email', 'required|trim');
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
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        //ambil data dari model
        $table = 'mst_user';
        $where = array(
            'email' => $email,
        );
        $user = $this->Crud->get_where($table, $where)->row_array();

        if ($user) {
            //cek dulu member aktive atau tidak
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    //jika sukses
                    $data = array(
                        'email' => $user['email'],
                        'nama' => $user['nama'],
                        'no_hp' => $user['no_hp'],
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
            Email belum diaktifkan, silahkan cek email Anda</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email belum terdaftar</div>');
            redirect('auth');
        }
    }

    public function signup()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[mst_user.email]', [
            'is_unique' => 'Email sudah digunakan, silahkan gunakan email lain'
        ]);


        if ($this->form_validation->run() == false) {

            $this->load->view('auth/register');
        } else {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)), //menghindari xss
                'no_hp' => htmlspecialchars($this->input->post('no_hp', true)), //menghindari xss
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => 'admin',
                'is_active' => 0
            );
            //tulis ke table via model
            $this->Crud->insert('mst_user', $data);
            // kirim email

            //buat link dan simpan
            $a = uniqid();
            $b = password_hash($a, PASSWORD_DEFAULT);
            $c = htmlspecialchars($this->input->post('email', true));

            $data = array(
                'email' => $c,
                'uniq' => $b,
                'aktivitas' => 'registrasi'
            );
            $this->Crud->insert('reg_email', $data);

            //ambil data dari tbl_setting
            $set = $this->Crud->get_all('set_email')->result_array();
            foreach ($set as $row) {
                $host = $row['host'];
                $username = $row['username'];
                $password = $row['password'];
                $secure = $row['secure'];
                $port = $row['port'];
                $emailfrom = $row['emailfrom'];
                $nama_pengirim = $row['nama_pengirim'];
            }

            //KIRIM EMAIL
            $mail = new PHPMailer;

            //Enable SMTP debugging. 
            // $mail->SMTPDebug = 3;

            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = $host; //host mail server
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = $username;   //nama-email smtp          
            $mail->Password = $password;           //password email smtp
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = $secure;
            //Set TCP port to connect to 
            $mail->Port = $port;

            $mail->From = $emailfrom; //email pengirim
            $mail->FromName = $nama_pengirim; //nama pengirim



            $mail->isHTML(true);

            $mail->addAddress($this->input->post('email'), $this->input->post('email')); //email penerima
            $mail->Subject = 'Solusicafe : Registrasi Akun'; //subject
            $mail->Body    = '<p>Terima kasih telah melakukan registrasi di solusicafe.</p>
    
                <p>Silahkan klik link dibawah ini untuk untuk mulai menggunakan solusicafe</p> 
                <p><a href="' . base_url('auth/verifymail') . '?email=' . $c . '&ref=' . $b . '">' . base_url('auth/verifymail') . '?email=' . $c . '&ref='  . $b . '</a></p> 
                <p>Selamat menggunakan solusicafe!</p> 
                 
                
                
                <p>Terima Kasih</p>'; //isi email
            $mail->AltBody = "PHP mailer"; //body email (optional)
            if (!$mail->send()) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed send email!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, akun Anda telah berhasil dibuat. Silahkan cek email Anda</div>');
                redirect('auth/success');
            }
        }
    }

    public function verifymail()
    {
        //ambil get url
        $where = array(
            'email' => $this->input->get('email'),
            'uniq' => $this->input->get('ref')
        );

        $this->Crud->get_where('reg_email', $where);
        if ($this->db->affected_rows() == true) {
            //update
            $this->Crud->update('mst_user', ['is_active' => '1'], ['email' => $this->input->get('email')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Silahkan masukan email dan password Anda !</div>');
            redirect('auth');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda tidak di ijinkan mengakses halaman ini !</div>');
            redirect('auth');
        }
    }

    function cekmail()
    {
        $where = array(
            'email' => $this->input->post('email'),
        );

        $table = 'mst_user';
        $this->Crud->get_where($table, $where);

        if ($this->db->affected_rows() == true) {
            //kirim email
            //buat link dan simpan
            $a = uniqid();
            $b = password_hash($a, PASSWORD_DEFAULT);
            $c = $this->input->post('email');

            $data = array(
                'email' => $c,
                'uniq' => $b,
                'aktivitas' => 'reset password'
            );
            $this->Crud->insert('reg_email', $data);
            //ambil data dari tbl_setting
            $set = $this->Crud->get_all('set_email')->result_array();
            foreach ($set as $row) {
                $host = $row['host'];
                $username = $row['username'];
                $password = $row['password'];
                $secure = $row['secure'];
                $port = $row['port'];
                $emailfrom = $row['emailfrom'];
                $nama_pengirim = $row['nama_pengirim'];
            }

            //KIRIM EMAIL
            $mail = new PHPMailer;

            //Enable SMTP debugging. 
            // $mail->SMTPDebug = 3;

            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = $host; //host mail server
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = $username;   //nama-email smtp          
            $mail->Password = $password;           //password email smtp
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = $secure;
            //Set TCP port to connect to 
            $mail->Port = $port;

            $mail->From = $emailfrom; //email pengirim
            $mail->FromName = $nama_pengirim; //nama pengirim



            $mail->isHTML(true);

            $mail->addAddress($this->input->post('email'), $this->input->post('email')); //email penerima
            $mail->Subject = 'Reset Password Akun Solusicafe'; //subject
            $mail->Body    = '<p>Anda telah meminta untuk melakukan reset password terhadap akun Anda yang menggunakan email ini sebagai tautan akun.</p>

			<p>Jika memang benar aktivitas reset password ini atas permintaan Anda, silahkan klik link dibawah ini</p> 
			
			<p><a href="' . base_url('auth/changepass') . '?email=' . $c . '&ref=' . $b . '">' . base_url('auth/changepass') . '?email=' . $c . '&ref='  . $b . '</a></p> 
			
			<p>Namun apabila aktivitas reset ini bukan atas permintaan Anda, silahkan abaikan email ini.</p>
			
			
			<p>Terima Kasih</p>'; //isi email
            $mail->AltBody = "PHP mailer"; //body email (optional)
            if (!$mail->send()) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed send email!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Link reset telah dikirim. Silahkan cek email Anda</div>');
                redirect('auth/success');
            }
        } else {
            $result = '500';
            echo json_encode($result);
        }
    }

    public function changepass()
    {
        //ambil get url
        $where = array(
            'email' => $this->input->get('email'),
            'uniq' => $this->input->get('ref')
        );

        $this->Crud->get_where('reg_email', $where);
        if ($this->db->affected_rows() == true) {

            $data['email'] = $this->input->get('email');
            $this->load->view('auth/reset', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda tidak di ijinkan mengakses halaman ini !</div>');
            redirect('auth');
        }
    }

    public function action_change()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password not match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data = array(
                'email' => $this->input->post('email')
            );
            $this->load->view('auth/changepass', $data);
        } else {
            $data = array(
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            );
            $where = array(
                'email' => $this->input->post('email')
            );
            //tulis ke table via model
            $this->Crud->update('mst_user', $data, $where);
            // $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat, Anda berhasil melakukan reset password. Silahkan login</div>');
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

    public function success()
    {
        $this->load->view('auth/verify');
    }

    public function reset()
    {
        $this->load->view('auth/reset');
    }

    public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('no_hp');
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
