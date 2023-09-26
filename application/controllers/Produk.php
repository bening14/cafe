<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['id_mst_bisnis'] = $r['id'];

        $data['kategori'] = $this->crud->get_all('mst_kategori')->result_array();
        $this->load->view('produk/produk', $data);
    }

    public function kategori()
    {
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();

        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $r['id']])->result_array();
        $data['id_mst_bisnis'] = $r['id'];

        $this->load->view('produk/kategori', $data);
    }

    public function ajax_table_kategori()
    {
        $where = array(
            'id_mst_bisnis' => $this->input->post('id_mst_bisnis')
        );
        $table = 'mst_kategori'; //nama tabel dari database
        $column_order = array('id', 'nama_kategori', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_kategori', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_kategori, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama_kategori'] = $key->nama_kategori;
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

    public function ajax_table_kategori_cabang()
    {
        $where = array(
            'id_mst_outlet =' => $this->input->post('id')
        );

        $table = 'mst_kategori_cabang'; //nama tabel dari database
        $column_order = array('id', 'id_mst_bisnis', 'nama_kategori', 'id_mst_outlet', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'id_mst_bisnis', 'nama_kategori', 'id_mst_outlet', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_bisnis, nama_kategori, id_mst_outlet, date_created';
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
            $row['data']['nama_kategori'] = $key->nama_kategori;
            //cek data di mst_produk
            $a = $this->crud->count_where('mst_produk', ['id_mst_kategori' => $key->id]);

            $row['data']['jumlah_produk'] = $a;
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



    public function addkategori()
    {
        $nama_kategori = $_POST['nama_kategori'];
        $count = $_POST['jumlah_outlet'];
        $id_mst_bisnis = $_POST['id_mst_bisnis'];

        //cek apakah semua outlet ?
        if (isset($_POST['semua'])) {
            $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
            $alloutlet = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $r['id']])->result_array();

            foreach ($alloutlet as $row => $val) {

                $data2 = array(
                    'nama_kategori' => $nama_kategori,
                    'id_mst_bisnis' => $id_mst_bisnis,
                    'id_mst_outlet' => $val['id']
                );
                $this->crud->insert('mst_kategori_cabang', $data2);
            }
        } else {
            for ($i = 1; $i <= $count; $i++) {
                $outlet = $_POST['outlet-' . $i];
                if (!empty($outlet)) {
                    $a = explode('-', $outlet);

                    $data = array(
                        'nama_kategori' => $nama_kategori,
                        'id_mst_outlet' => $a[0],
                        'id_mst_bisnis' => $id_mst_bisnis
                    );
                    $this->crud->insert('mst_kategori_cabang', $data);
                }
            }
        }

        //tambahkan ke mst_kategori
        $this->crud->insert('mst_kategori', ['nama_kategori' => $nama_kategori]);


        redirect('produk/kategori');
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

    public function update_data_kategori()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);


        $where = array(
            'id' => $data['id']
        );

        unset($data['id']);

        $insert_data = $this->crud->update($table, $data, $where);



        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function ajax_table_produk()
    {
        $where = array(
            'id_mst_bisnis' => $this->input->post('id_mst_bisnis')
        );
        $table = 'mst_produk'; //nama tabel dari database
        $column_order = array('id', 'nama_produk', 'gambar', 'id_mst_kategori', 'harga', 'sku', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_produk', 'gambar', 'id_mst_kategori', 'harga', 'sku', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_produk,  gambar, id_mst_kategori, harga, sku, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['gambar'] = $key->gambar;
            //ambil kategori
            $a = $this->crud->get_where('mst_kategori', ['id' => $key->id_mst_kategori])->result_array();
            foreach ($a as $d => $k) {
                $row['data']['kategori'] = $k['nama_kategori'];
            }
            $row['data']['harga'] = $key->harga;
            $row['data']['sku'] = $key->sku;
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

    public function ajax_table_produk_cabang()
    {
        $where = array(
            'id_mst_outlet =' => $this->input->post('id')
        );

        $table = 'mst_produk_cabang'; //nama tabel dari database
        $column_order = array('id', 'nama_produk', 'gambar', 'id_mst_kategori', 'harga', 'sku', 'kelola_stok', 'stok', 'minimum_stok', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_produk', 'gambar', 'id_mst_kategori', 'harga', 'sku', 'kelola_stok', 'stok', 'minimum_stok', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_produk,  gambar, id_mst_kategori, harga, sku, kelola_stok, stok, minimum_stok, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['gambar'] = $key->gambar;
            //ambil kategori
            $a = $this->crud->get_where('mst_kategori', ['id' => $key->id_mst_kategori])->result_array();
            foreach ($a as $d => $k) {
                $row['data']['kategori'] = $k['nama_kategori'];
            }
            $row['data']['harga'] = $key->harga;
            $row['data']['sku'] = $key->sku;
            $row['data']['kelola_stok'] = $key->kelola_stok;
            $row['data']['stok'] = $key->stok;
            $row['data']['minimum_stok'] = $key->minimum_stok;
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

    public function insert_data_produk()
    {

        $table = $this->input->post("table");

        $config['upload_path']          = "assets/template-admin/assets/food/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 1024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            $data['gambar'] = $data_upload['file_name'];
        } else {
            $data['gambar'] = 'default.jpg';
        }

        //create kode SKU
        //buat kode bisnis
        $d = $this->crud->get_all_limit($table)->row_array();
        if ($d) {
            $r = explode('-', $d['sku']);
            $seq = $r[1] + 1;
            $data['sku'] = 'SKU-' . $seq;
        } else {
            $data['sku'] = 'SKU-1';
        }


        //cek dulu apakah Produk sudah ada ?
        $where = array(
            'nama_produk' => $data['nama_produk']
        );
        $a = $this->crud->get_where('mst_produk', $where)->num_rows();

        if ($a > 0) {
            $response = ['status' => 'error', 'message' => 'Nama produk sudah digunakan!'];
            echo json_encode($response);
            die;
        }

        $insert_data = $this->crud->insert($table, $data);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function edit_data_produk()
    {

        $table = $this->input->post("table");

        $config['upload_path']          = "assets/template-admin/assets/food/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 1024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            $data['gambar'] = $data_upload['file_name'];
        } else {
            $data['gambar'] = 'default.jpg';
        }

        $where = array(
            'id' => $data['id']
        );
        unset($data['table']);

        $insert_data = $this->crud->update($table, $data, $where);


        if ($insert_data > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function ubah_kelola_stok()
    {
        $kelola_stok = $this->input->post('kelola_stok');
        $id = $this->input->post('id');

        $update = $this->crud->update('mst_produk_cabang', ['kelola_stok' => $kelola_stok], ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Data!'];

        echo json_encode($response);
    }

    public function ubah_stok()
    {
        $stok = $this->input->post('stok');
        $id = $this->input->post('id');

        $update = $this->crud->update('mst_produk_cabang', ['stok' => $stok], ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Data!'];

        echo json_encode($response);
    }

    public function ubah_minimum_stok()
    {
        $minimum_stok = $this->input->post('minimum_stok');
        $id = $this->input->post('id');

        $update = $this->crud->update('mst_produk_cabang', ['minimum_stok' => $minimum_stok], ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Data!'];

        echo json_encode($response);
    }

    public function insert_data_kategori()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        //cek dulu apakah ada double
        $r = $this->crud->get_where('mst_kategori', ['nama_kategori' => $data['nama_kategori']])->row_array();
        if ($r) {
            $response = ['status' => 'double', 'message' => 'Gagal Tambah Data!'];
            echo json_encode($response);
            die;
        } else {
            $insert_data = $this->crud->insert($table, $data);
        }


        if ($insert_data > 0) {

            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function insert_data_kategori_cabang()
    {
        $data = $this->input->post();
        $table = $this->input->post("table");
        unset($data['table']);

        $a = explode('-', $data['nama']);
        $data['nama_kategori'] = $a[1];
        $data['id_mst_kategori'] = $a[0];
        unset($data['nama']);

        //cek dulu apakah ada double
        $data_double = array(
            'id_mst_kategori' => $a[0],
            'id_mst_outlet' => $data['id_mst_outlet']
        );

        $r = $this->crud->get_where('mst_kategori_cabang', $data_double)->row_array();

        if ($r) {
            $response = ['status' => 'double', 'message' => 'Gagal Tambah Data!'];
            echo json_encode($response);
            die;
        } else {
            $insert_data = $this->crud->insert($table, $data);
        }



        if ($insert_data > 0) {

            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }
}
