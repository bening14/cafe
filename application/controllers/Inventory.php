<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
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
        $this->load->model("M_inventory", "m_inventory");
    }

    public function index()
    {
        $a = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $a['id']])->result_array();
        $data['kategori'] = $this->crud->get_where('mst_kategori', ['id_mst_bisnis' => $a['id']])->result_array();

        $this->load->view('inventory/kartu_stok', $data);
    }

    public function ajax_table_kartu_stok()
    {
        $where = [];
        $table = 'tbl_kartu_stok'; //nama tabel dari database
        $column_order = array('id', 'sku', 'nama_produk', 'id_mst_kategori', 'nama_kategori', 'stok_awal', 'stok_masuk', 'stok_keluar', 'penjualan', 'transfer', 'penyesuaian', 'stok_akhir', 'satuan', 'id_mst_outlet', 'nama_outlet', 'tanggal_pengakuan', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'sku', 'nama_produk', 'id_mst_kategori', 'nama_kategori', 'stok_awal', 'stok_masuk', 'stok_keluar', 'penjualan', 'transfer', 'penyesuaian', 'stok_akhir', 'satuan', 'id_mst_outlet', 'nama_outlet', 'tanggal_pengakuan', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, sku, nama_produk, id_mst_kategori, nama_kategori, stok_awal, stok_masuk, stok_keluar, penjualan, transfer, penyesuaian, stok_akhir, satuan, id_mst_outlet, nama_outlet, tanggal_pengakuan, date_created';
        $order = array('id' => 'asc'); // default order 
        $list = $this->m_inventory->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['sku'] = $key->sku;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['id_mst_kategori'] = $key->id_mst_kategori;
            $row['data']['nama_kategori'] = $key->nama_kategori;
            $row['data']['stok_awal'] = $key->stok_awal;
            $row['data']['stok_masuk'] = $key->stok_masuk;
            $row['data']['stok_keluar'] = $key->stok_keluar;
            $row['data']['penjualan'] = $key->penjualan;
            $row['data']['transfer'] = $key->transfer;
            $row['data']['penyesuaian'] = $key->penyesuaian;
            $row['data']['stok_akhir'] = $key->stok_akhir;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['nama_outlet'] = $key->nama_outlet;
            $row['data']['tanggal_pengakuan'] = $key->tanggal_pengakuan;
            $row['data']['date_created'] = date('d-M-Y', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_inventory->count_all($table),
            "recordsFiltered" => $this->m_inventory->count_filtered($table, $select, $column_order, $column_search, $order, $where),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
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
            $this->crud->update('mst_user', ['id_mst_bisnis' => '1'], ['id' => $this->session->userdata('id')]);
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
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();

        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $r['id']])->result_array();

        $this->load->view('customer/promo_khusus', $data);
    }

    public function ajax_table_promo_khusus()
    {

        $table = 'tbl_promo_khusus'; //nama tabel dari database
        $column_order = array('id', 'nama_promo', 'jenis', 'nilai_promo', 'status', 'id_mst_outlet', 'nama_outlet', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'nama_promo', 'jenis', 'nilai_promo', 'status', 'id_mst_outlet', 'nama_outlet', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_promo, jenis, nilai_promo, status, id_mst_outlet, nama_outlet, date_created';
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
            $row['data']['nama_outlet'] = $key->nama_outlet;
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

    public function addpromokhusus()
    {
        $nama_promo = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $nilai_promo = $_POST['nilai_promo'];
        $count = $_POST['jumlah_outlet'];

        //GENERATE KODE PROMO
        $d = $this->crud->get_all_limit('tbl_promo_khusus')->row_array();
        if ($d) {
            $r = explode('-', $d['kode_promo']);
            $seq = $r[1] + 1;
            $kode_promo = 'PROMO-' . $seq;
        } else {
            $kode_promo = 'PROMO-1000';
        }

        //cek apakah semua outlet ?
        if (isset($_POST['semua'])) {
            $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
            $alloutlet = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $r['id']])->result_array();

            foreach ($alloutlet as $row => $val) {

                $data2 = array(
                    'kode_promo' => $kode_promo,
                    'nama_promo' => $nama_promo,
                    'jenis' => $jenis,
                    'nilai_promo' => $nilai_promo,
                    'id_mst_outlet' => $val['id'],
                    'nama_outlet' => $val['nama_outlet'],
                    'status' => 'Active'
                );
                $this->crud->insert('tbl_promo_khusus', $data2);
            }
        } else {
            for ($i = 1; $i <= $count; $i++) {
                $outlet = $_POST['outlet-' . $i];
                if (!empty($outlet)) {
                    $a = explode('-', $outlet);

                    $data = array(
                        'kode_promo' => $kode_promo,
                        'nama_promo' => $nama_promo,
                        'jenis' => $jenis,
                        'nilai_promo' => $nilai_promo,
                        'id_mst_outlet' => $a[0],
                        'nama_outlet' => $a[1],
                        'status' => 'Active',
                    );
                    $this->crud->insert('tbl_promo_khusus', $data);
                }
            }
        }


        redirect('customer/promo_khusus');
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
