<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Silahkan login terlebih dahulu!</div>');
            redirect('auth');
        }
        $this->load->model("Crud", "crud");
    }

    public function index()
    {
        $this->load->view('customer/admin');
    }

    public function bisnis()
    {
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();

        if ($r) {
            $data['kode_bisnis'] = $r['kode_bisnis'];
            $data['nama_bisnis'] = $r['nama_bisnis'];
        } else {
            $data['kode_bisnis'] = '';
        }
        $this->load->view('customer/bisnis', $data);
    }

    public function outlet()
    {
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();

        // $select = '*';
        // $table1 = 'mst_bisnis';
        // $table2 = 'mst_outlet';
        // $like = 'mst_bisnis.id = mst_outlet.id_mst_bisnis';
        // $where = 'mst_bisnis.id_mst_user =' . $this->session->userdata("id");

        // $data['outlet'] = $this->crud->join_data($select, $table1, $table2, $like, $where);

        // echo $this->db->last_query();
        // die;


        $data['kode_bisnis'] = $r['kode_bisnis'];
        $data['nama_bisnis'] = $r['nama_bisnis'];
        $data['id_mst_bisnis'] = $r['id'];

        $this->load->view('customer/outlet', $data);
    }

    public function pajak()
    {
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['pajak'] = $this->crud->count_where('tbl_pajak_layanan', ['jenis' => 'Pajak']);
        $data['layanan'] = $this->crud->count_where('tbl_pajak_layanan', ['jenis' => 'Layanan']);

        $data['id_mst_bisnis'] = $r['id'];
        $this->load->view('customer/pajak', $data);
    }

    public function struk()
    {
        // $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        // $data['pajak'] = $this->crud->count_where('tbl_pajak_layanan', ['jenis' => 'Pajak']);
        // $data['layanan'] = $this->crud->count_where('tbl_pajak_layanan', ['jenis' => 'Layanan']);

        // $data['id_mst_bisnis'] = $r['id'];
        $this->load->view('customer/struk');
    }

    public function ajax_table_bisnis()
    {
        $where = array(
            'id_mst_user =' => $this->session->userdata('id')
        );
        $table = 'mst_bisnis'; //nama tabel dari database
        $column_order = array('id', 'kode_bisnis', 'nama_bisnis', 'logo', 'kota_bisnis', 'telephone', 'outlet', 'id_mst_user', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_bisnis', 'nama_bisnis', 'logo', 'kota_bisnis', 'telephone', 'outlet', 'id_mst_user', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_bisnis, nama_bisnis, logo, kota_bisnis, telephone, outlet, id_mst_user, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_bisnis'] = $key->kode_bisnis;
            $row['data']['nama_bisnis'] = $key->nama_bisnis;
            $row['data']['logo'] = $key->logo;
            $row['data']['kota_bisnis'] = $key->kota_bisnis;
            $row['data']['telephone'] = $key->telephone;
            $row['data']['outlet'] = $key->outlet;
            $row['data']['id_mst_user'] = $key->id_mst_user;
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

    public function ajax_table_outlet()
    {
        // echo $this->input->post('id_mst_bisnis');
        // die;
        $where = array(
            'id_mst_bisnis =' => $this->input->post('id_mst_bisnis')
        );
        $table = 'mst_outlet'; //nama tabel dari database
        $column_order = array('id', 'id_mst_bisnis', 'kode_outlet', 'nama_outlet', 'lokasi', 'phone', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'id_mst_bisnis', 'kode_outlet', 'nama_outlet', 'lokasi', 'phone', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_bisnis, kode_outlet, nama_outlet, lokasi, phone, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['id_mst_bisnis'] = $key->id_mst_bisnis;
            $row['data']['kode_outlet'] = $key->kode_outlet;
            $row['data']['nama_outlet'] = $key->nama_outlet;
            $row['data']['lokasi'] = $key->lokasi;
            $row['data']['phone'] = $key->phone;
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

    public function ajax_table_pajak()
    {
        // echo $this->input->post('id_mst_bisnis');
        // die;
        $where = array(
            'id_mst_bisnis =' => $this->input->post('id_mst_bisnis')
        );
        $table = 'tbl_pajak_layanan'; //nama tabel dari database
        $column_order = array('id', 'id_mst_bisnis', 'nama_biaya', 'jenis', 'satuan', 'jumlah', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'id_mst_bisnis', 'nama_biaya', 'jenis', 'satuan', 'jumlah', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_bisnis, nama_biaya, jenis, satuan, jumlah, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['id_mst_bisnis'] = $key->id_mst_bisnis;
            $row['data']['nama_biaya'] = $key->nama_biaya;
            $row['data']['jenis'] = $key->jenis;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['jumlah'] = $key->jumlah;
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

    public function insert_data_bisnis()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        $data['id_mst_user'] = $this->session->userdata('id');

        if ($data['kategori'] == 'tambah') {
            //buat kode bisnis
            $d = $this->crud->get_all_limit($table)->row_array();
            if ($d) {
                $r = explode('-', $d['kode_bisnis']);
                $seq = $r[1] + 1;
                $data['kode_bisnis'] = 'BISNIS-' . $seq;
            } else {
                $data['kode_bisnis'] = 'BISNIS-1000';
            }

            unset($data['kategori']);
            $data['logo'] = 'outlet.png';
            $data['outlet'] = 'Belum ada outlet';


            $insert_data = $this->crud->insert($table, $data);
        } else {
            $where = array(
                'id' => $data['id']
            );

            unset($data['id']);
            unset($data['kategori']);
            unset($data['id_mst_user']);

            $insert_data = $this->crud->update($table, $data, $where);
        }


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function insert_data_outlet()
    {
        $table = $this->input->post("table");
        $id_mst_bisnis = $this->input->post("id_mst_bisnis");

        $data = $this->input->post();
        unset($data['table']);


        if ($data['kategori'] == 'tambah') {
            //buat kode bisnis
            $d = $this->crud->get_all_limit($table)->row_array();
            if ($d) {
                $r = explode('-', $d['kode_outlet']);
                $seq = $r[1] + 1;
                $data['kode_outlet'] = 'OUTLET-' . $seq;
            } else {
                $data['kode_outlet'] = 'OUTLET-1000';
            }

            unset($data['kategori']);
            $insert_data = $this->crud->insert($table, $data);
            $this->crud->update('mst_bisnis', ['outlet' => 'Ya'], ['id' => $id_mst_bisnis]);
        } else {
            $where = array(
                'id' => $data['id']
            );

            unset($data['id']);
            unset($data['kategori']);
            unset($data['id_mst_bisnis']);

            $insert_data = $this->crud->update($table, $data, $where);
        }


        if ($insert_data > 0) {

            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function insert_data_pajak()
    {
        $table = $this->input->post("table");
        $id_mst_bisnis = $this->input->post("id_mst_bisnis");

        $data = $this->input->post();
        unset($data['table']);


        if ($data['kategori'] == 'tambah') {

            unset($data['kategori']);
            $insert_data = $this->crud->insert($table, $data);
        } else {
            $where = array(
                'id' => $data['id']
            );

            unset($data['id']);
            unset($data['kategori']);
            unset($data['id_mst_bisnis']);

            $insert_data = $this->crud->update($table, $data, $where);
        }


        if ($insert_data > 0) {

            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function delete_data()
    {
        $table = $this->input->post('table');
        if ($this->crud->delete($table, ['id' => $this->input->post('id')])) {
            $response = ['status' => 'success', 'message' => 'Success Delete Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Delete Data!'];

        echo json_encode($response);
    }

    public function pelanggan()
    {
        $this->load->view('customer/pelanggan');
    }

    public function ajax_table_pelanggan()
    {

        $table = 'tbl_pelanggan'; //nama tabel dari database
        $column_order = array('id', 'nama', 'telephone', 'kode_pelanggan', 'email', 'alamat', 'catatan', 'jenis_kelamin', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama', 'telephone', 'kode_pelanggan', 'email', 'alamat', 'catatan', 'jenis_kelamin', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama, telephone, kode_pelanggan, email, alamat, catatan, jenis_kelamin, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama'] = $key->nama;
            $row['data']['telephone'] = $key->telephone;
            $row['data']['kode_pelanggan'] = $key->kode_pelanggan;
            $row['data']['email'] = $key->email;
            $row['data']['alamat'] = $key->alamat;
            $row['data']['catatan'] = $key->catatan;
            $row['data']['jenis_kelamin'] = $key->jenis_kelamin;
            $row['data']['date_created'] = date('d-M-Y', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function insert_data_pelanggan()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        if ($data['kategori'] == 'tambah') {
            //buat kode pelanggan
            $d = $this->crud->get_all_limit($table)->row_array();
            if ($d) {
                $r = explode('-', $d['kode_pelanggan']);
                $seq = $r[1] + 1;
                $data['kode_pelanggan'] = 'CUST-' . $seq;
            } else {
                $data['kode_pelanggan'] = 'CUST-1000';
            }

            unset($data['kategori']);


            $insert_data = $this->crud->insert($table, $data);
        } else {
            $where = array(
                'id' => $data['id']
            );

            unset($data['id']);
            unset($data['kategori']);

            $insert_data = $this->crud->update($table, $data, $where);
        }


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function promo()
    {
        $this->load->view('customer/promo');
    }

    public function promo_khusus()
    {
        $this->load->view('customer/promo_khusus');
    }

    public function ajax_table_promo_khusus()
    {

        $table = 'tbl_promo_khusus'; //nama tabel dari database
        $column_order = array('id', 'nama_promo', 'jenis', 'nilai_promo', 'status', 'id_mst_outlet', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_promo', 'jenis', 'nilai_promo', 'status', 'id_mst_outlet', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_promo, jenis, nilai_promo, status, id_mst_outlet, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama_promo'] = $key->nama_promo;
            $row['data']['jenis'] = $key->jenis;
            $row['data']['nilai_promo'] = $key->nilai_promo;
            $row['data']['status'] = $key->status;
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['date_created'] = date('d-M-Y', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }
    public function manajer()
    {
        $this->load->view('customer/manajer');
    }

    public function kasir()
    {
        $this->load->view('customer/kasir');
    }

    public function waitress()
    {
        $this->load->view('customer/waitress');
    }

    public function kitchen()
    {
        $this->load->view('customer/kitchen');
    }
}
