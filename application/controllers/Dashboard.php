<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('idkamu')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Please Login!</div>');
            redirect('auth');
        }
        $this->load->model("Crud", "crud");
    }

    public function index()
    {
        $this->load->view('admin/user');
    }

    public function ajax_table_user()
    {
        $where = array(
            'level =' => 'admin'
        );
        $table = 'mst_user'; //nama tabel dari database
        $column_order = array('id', 'idkamu', 'email', 'level', 'is_active', 'id_mst_brand', 'id_mst_store', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'idkamu', 'email', 'level', 'is_active', 'id_mst_brand', 'id_mst_store', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, idkamu, email, level, is_active, id_mst_brand, id_mst_store, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['idkamu'] = $key->idkamu;

            $biodata = $this->crud->get_where('mst_biodata', ['id_mst_user' => $key->id])->result_array();
            foreach ($biodata as $var => $val) {
                $row['data']['nama'] = $val['nama'];
                $row['data']['no_hp'] = $val['no_hp'];
                $row['data']['alamat'] = $val['alamat'];
                $row['data']['photo'] = $val['photo'];
                $row['data']['member'] = $val['member'];
            }

            $row['data']['email'] = $key->email;
            $row['data']['level'] = $key->level;
            $row['data']['is_active'] = $key->is_active;
            $row['data']['id_mst_brand'] = $key->id_mst_brand;

            $count = $this->crud->count_where('mst_store', ['id_mst_brand' => $key->id_mst_brand]);
            $row['data']['cabang'] = $count;

            $brand = $this->crud->get_where('mst_brand', ['id' => $key->id_mst_brand])->result_array();

            foreach ($brand as $col => $value) {
                $row['data']['brand'] = $value['nama_brand'];
            }

            $row['data']['id_mst_store'] = $key->id_mst_store;
            $row['data']['date_created'] = date('d-M-Y', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }
}
