<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Crud", "crud");
	}


	public function index()
	{
		$data['meja'] = $_GET['meja'];

		$where = array(
			'id_mst_bisnis' => $_GET['id_bisnis'],
			'id_mst_outlet' => $_GET['id_outlet'],
		);

		$data['menu'] = $this->crud->get_where('mst_produk_cabang', $where)->result_array();

		$this->load->view('menu', $data);
	}
}
