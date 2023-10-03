<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Crud", "crud");
    }


    public function index()
    {

        $this->load->view('kasir/meja');
    }

    public function payment()
    {
        $this->load->view('kasir/order');
    }

    public function paymentdetail()
    {
        $this->load->view('kasir/orderdetail');
    }
}
