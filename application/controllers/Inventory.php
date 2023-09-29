<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $a = $this->input->post('outlet'); //31-Cabang Surabaya
        $kategori = $this->input->post('kategori');
        $dari_tanggal = $this->input->post('dari_tanggal');
        $sampai_tanggal = $this->input->post('sampai_tanggal');

        $b = explode('-', $a);
        $id_outlet = $b[0];
        $nama_outlet = $b[1];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_pengakuan >=' => $dari_tanggal,
                'tanggal_pengakuan <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet
            );
        } else {
            $where = array(
                'tanggal_pengakuan >=' => $dari_tanggal,
                'tanggal_pengakuan <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $table = 'tbl_kartu_stok'; //nama tabel dari database
        $column_order = array('id', 'sku', 'nama_produk', 'id_mst_kategori', 'nama_kategori', 'stok_awal', 'stok_masuk', 'stok_keluar', 'penjualan', 'transfer', 'penyesuaian', 'stok_akhir', 'satuan', 'id_mst_outlet', 'nama_outlet', 'tanggal_pengakuan', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'sku', 'nama_produk', 'id_mst_kategori', 'nama_kategori', 'stok_awal', 'stok_masuk', 'stok_keluar', 'penjualan', 'transfer', 'penyesuaian', 'stok_akhir', 'satuan', 'id_mst_outlet', 'nama_outlet', 'tanggal_pengakuan', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, sku, nama_produk, id_mst_kategori, nama_kategori, stok_awal, stok_masuk, stok_keluar, penjualan, transfer, penyesuaian, stok_akhir, satuan, id_mst_outlet, nama_outlet, tanggal_pengakuan, date_created';
        $order = array('tanggal_pengakuan' => 'asc'); // default order 
        $group = array('sku'); // default order 
        $list = $this->m_inventory->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();

            //ambil data stok awal untuk sku ini
            $a = $this->crud->get_where_select_stok_awal($table, 'stok_awal', ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal])->row_array();
            $row['data']['stok_awal'] = $a['stok_awal'];
            //ambil data stok akhir untuk sku ini
            $a = $this->crud->get_where_select_stok_akhir($table, 'stok_akhir', ['sku' => $key->sku, 'tanggal_pengakuan <=' => $sampai_tanggal])->row_array();
            $row['data']['stok_akhir'] = $a['stok_akhir'];
            //jumlahkan data stok masuk
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'stok_masuk')->row_array();
            $row['data']['stok_masuk'] = $a['stok_masuk'];
            //jumlahkan data stok keluar
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'stok_keluar')->row_array();
            $row['data']['stok_keluar'] = $a['stok_keluar'];
            //jumlahkan data penjualan
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'penjualan')->row_array();
            $row['data']['penjualan'] = $a['penjualan'];
            //jumlahkan data transfer
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'transfer')->row_array();
            $row['data']['transfer'] = $a['transfer'];
            //jumlahkan data penyesuaian
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'penyesuaian')->row_array();
            $row['data']['penyesuaian'] = $a['penyesuaian'];

            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['sku'] = $key->sku;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['id_mst_kategori'] = $key->id_mst_kategori;
            $row['data']['nama_kategori'] = $key->nama_kategori;
            $row['data']['satuan'] = $key->satuan;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_inventory->count_all($table),
            "recordsFiltered" => $this->m_inventory->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_kartu_stok_OLD()
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

    public function generatedata()
    {
        $table = 'tbl_kartu_stok';
        $numrow = 10;
        $no = 1;
        $a = $_GET['outlet'];
        $b = explode('-', $a);
        $outlet = $b[0];
        $nama_outlet = $b[1];
        $kategori = $_GET['kategori'];
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_pengakuan >=' => $dari_tanggal,
                'tanggal_pengakuan <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet
            );
        } else {
            $where = array(
                'tanggal_pengakuan >=' => $dari_tanggal,
                'tanggal_pengakuan <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $data = $this->crud->get_where_group($table, $where, 'sku')->result();

        $d = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array(); //UNTUK KEPERLUAN PEMBERIAN NAMA FILE EXCEL


        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(20);
        $excel->getColumnDimension('D')->setWidth(12);
        $excel->getColumnDimension('E')->setWidth(12);
        $excel->getColumnDimension('F')->setWidth(12);
        $excel->getColumnDimension('G')->setWidth(12);
        $excel->getColumnDimension('H')->setWidth(12);
        $excel->getColumnDimension('I')->setWidth(12);
        $excel->getColumnDimension('J')->setWidth(12);
        $excel->getColumnDimension('K')->setWidth(12);

        $excel->getRowDimension('9')->setRowHeight(15);

        $excel->getStyle('A1')->getFont()->setBold(true);
        $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A9:K9')->getFont()->setBold(true);

        $excel->getStyle('A2:A3')->getFont()->setSize(9);
        $excel->getStyle('A9:K9')->getFont()->setSize(10);
        $excel->getStyle('A7')->getFont()->setSize(9);
        $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A9:K9')->applyFromArray($styleArray);

        $excel->setCellValue('A1', strtoupper($d['nama_bisnis']));
        $excel->setCellValue('A2', strtoupper($nama_outlet . '-' . $d['kota_bisnis']));
        $excel->setCellValue('A3', "Phone " . $d['telephone']);
        $excel->setCellValue('A5', "KARTU STOK");
        $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($dari_tanggal)) . " sd " . date('d-M-Y', strtotime($sampai_tanggal)));
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "PRODUK");
        $excel->setCellValue('C9', "KATEGORI");
        $excel->setCellValue('D9', "STOK AWAL");
        $excel->setCellValue('E9', "STOK MASUK");
        $excel->setCellValue('F9', "STOK KELUAR");
        $excel->setCellValue('G9', "PENJUALAN");
        $excel->setCellValue('H9', "TRANSFER");
        $excel->setCellValue('I9', "PENYESUAIAN");
        $excel->setCellValue('J9', "STOK AKHIR");
        $excel->setCellValue('K9', "SATUAN");

        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->nama_produk);
            $excel->setCellValue('C' . $numrow, $key->nama_kategori);

            //ambil data stok awal untuk sku ini
            $a = $this->crud->get_where_select_stok_awal($table, 'stok_awal', ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal])->row_array();
            $excel->setCellValue('D' . $numrow, $a['stok_awal']);
            //ambil data stok akhir untuk sku ini
            $a = $this->crud->get_where_select_stok_akhir($table, 'stok_akhir', ['sku' => $key->sku, 'tanggal_pengakuan <=' => $sampai_tanggal])->row_array();
            $excel->setCellValue('J' . $numrow, $a['stok_akhir']);
            //jumlahkan data stok masuk
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'stok_masuk')->row_array();
            $excel->setCellValue('E' . $numrow, $a['stok_masuk']);
            //jumlahkan data stok keluar
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'stok_keluar')->row_array();
            $excel->setCellValue('F' . $numrow, $a['stok_keluar']);
            //jumlahkan data penjualan
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'penjualan')->row_array();
            $excel->setCellValue('G' . $numrow, $a['penjualan']);
            //jumlahkan data transfer
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'transfer')->row_array();
            $excel->setCellValue('H' . $numrow, $a['transfer']);
            //jumlahkan data penyesuaian
            $a = $this->crud->sum_where($table, ['sku' => $key->sku, 'tanggal_pengakuan >=' => $dari_tanggal, 'tanggal_pengakuan <=' => $sampai_tanggal,], 'penyesuaian')->row_array();
            $excel->setCellValue('I' . $numrow, $a['penyesuaian']);
            $excel->setCellValue('K' . $numrow, $key->satuan);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':K' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':K' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = '[KARTU STOK]-' . $d['nama_bisnis'] . '-' . $nama_outlet . '.xlsx';

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function masuk()
    {
        $a = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $a['id']])->result_array();
        $data['kategori'] = $this->crud->get_where('mst_kategori', ['id_mst_bisnis' => $a['id']])->result_array();

        $this->load->view('inventory/masuk', $data);
    }

    public function ajax_table_stok_masuk()
    {

        $a = $this->input->post('outlet'); //31-Cabang Surabaya
        $kategori = $this->input->post('kategori');
        $dari_tanggal = $this->input->post('dari_tanggal');
        $sampai_tanggal = $this->input->post('sampai_tanggal');

        $b = explode('-', $a);
        $id_outlet = $b[0];
        $nama_outlet = $b[1];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet
            );
        } else {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $table = 'tbl_stok_masuk'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'tanggal_transaksi', 'sku', 'nama_produk', 'kategori', 'jumlah', 'satuan', 'harga_beli_unit', 'total_harga_beli', 'catatan', 'id_mst_user', 'nama', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'tanggal_transaksi', 'sku', 'nama_produk', 'kategori', 'jumlah', 'satuan', 'harga_beli_unit', 'total_harga_beli', 'catatan', 'id_mst_user', 'nama', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, id_mst_bisnis, id_mst_outlet, nama_outlet, tanggal_transaksi, sku, nama_produk, kategori, jumlah, satuan, harga_beli_unit, total_harga_beli, catatan, id_mst_user, nama, date_created';
        $order = array('tanggal_transaksi' => 'asc'); // default order 
        $group = array('kode_trx'); // default order 
        $list = $this->m_inventory->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['id_mst_bisnis'] = $key->id_mst_bisnis;
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['nama_outlet'] = $key->nama_outlet;
            $row['data']['tanggal_transaksi'] = $key->tanggal_transaksi;
            $row['data']['sku'] = $key->sku;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['kategori'] = $key->kategori;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['harga_beli_unit'] = $key->harga_beli_unit;
            $row['data']['total_harga_beli'] = $key->total_harga_beli;
            $row['data']['catatan'] = $key->catatan;
            $row['data']['id_mst_user'] = $key->id_mst_user;
            $row['data']['nama'] = $key->nama;
            $row['data']['date_created'] = $key->date_created;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_inventory->count_all($table),
            "recordsFiltered" => $this->m_inventory->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_masuk_detail()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode'),
        );


        $table = 'tbl_stok_masuk'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'nama_produk', 'jumlah', 'satuan', 'harga_beli_unit', 'total_harga_beli'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'nama_produk', 'jumlah', 'satuan', 'harga_beli_unit', 'total_harga_beli'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, nama_produk, jumlah, satuan, harga_beli_unit, total_harga_beli';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['harga_beli_unit'] = $key->harga_beli_unit;
            $row['data']['total_harga_beli'] = $key->total_harga_beli;

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

    public function getdata()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode_trx')
        );
        $table = $this->input->post('table');

        $result = $this->crud->get_where($table, $where)->row_array();

        echo json_encode($result);
    }

    public function generatedatamasuk()
    {
        $table = 'tbl_stok_masuk';
        $numrow = 10;
        $no = 1;
        $a = $_GET['outlet'];
        $b = explode('-', $a);
        $outlet = $b[0];
        $nama_outlet = $b[1];
        $kategori = $_GET['kategori'];
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet
            );
        } else {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $data = $this->crud->get_where($table, $where)->result();

        $d = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array(); //UNTUK KEPERLUAN PEMBERIAN NAMA FILE EXCEL


        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(20);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(10);
        $excel->getColumnDimension('F')->setWidth(12);
        $excel->getColumnDimension('G')->setWidth(12);
        $excel->getColumnDimension('H')->setWidth(15);
        $excel->getColumnDimension('I')->setWidth(15);
        $excel->getColumnDimension('J')->setWidth(40);
        $excel->getColumnDimension('K')->setWidth(15);
        $excel->getColumnDimension('L')->setWidth(20);

        $excel->getRowDimension('9')->setRowHeight(15);

        $excel->getStyle('A1')->getFont()->setBold(true);
        $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A9:L9')->getFont()->setBold(true);

        $excel->getStyle('A2:A3')->getFont()->setSize(9);
        $excel->getStyle('A9:L9')->getFont()->setSize(10);
        $excel->getStyle('A7')->getFont()->setSize(9);
        $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A9:L9')->applyFromArray($styleArray);

        $excel->setCellValue('A1', strtoupper($d['nama_bisnis']));
        $excel->setCellValue('A2', strtoupper($nama_outlet . '-' . $d['kota_bisnis']));
        $excel->setCellValue('A3', "Phone " . $d['telephone']);
        $excel->setCellValue('A5', "STOK MASUK");
        $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($dari_tanggal)) . " sd " . date('d-M-Y', strtotime($sampai_tanggal)));
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "KODE TRANSAKSI");
        $excel->setCellValue('C9', "TANGGAL TRANSAKSI");
        $excel->setCellValue('D9', "NAMA PRODUK");
        $excel->setCellValue('E9', "SKU");
        $excel->setCellValue('F9', "JUMLAH");
        $excel->setCellValue('G9', "SATUAN");
        $excel->setCellValue('H9', "HARGA BELI UNIT");
        $excel->setCellValue('I9', "TOTAL HARGA BELI");
        $excel->setCellValue('J9', "CATATAN");
        $excel->setCellValue('K9', "PIC");
        $excel->setCellValue('L9', "WAKTU SUBMIT");

        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->kode_trx);
            $excel->setCellValue('C' . $numrow, $key->tanggal_transaksi);
            $excel->setCellValue('D' . $numrow, $key->nama_produk);
            $excel->setCellValue('E' . $numrow, $key->sku);
            $excel->setCellValue('F' . $numrow, $key->jumlah);
            $excel->setCellValue('G' . $numrow, $key->satuan);
            $excel->setCellValue('H' . $numrow, $key->harga_beli_unit);
            $excel->setCellValue('I' . $numrow, $key->total_harga_beli);
            $excel->setCellValue('J' . $numrow, $key->catatan);
            $excel->setCellValue('K' . $numrow, $key->nama);
            $excel->setCellValue('L' . $numrow, $key->date_created);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':L' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':L' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = '[STOK MASUK]-' . $d['nama_bisnis'] . '-' . $nama_outlet . '.xlsx';

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function keluar()
    {
        $a = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $a['id']])->result_array();
        $data['kategori'] = $this->crud->get_where('mst_kategori', ['id_mst_bisnis' => $a['id']])->result_array();

        $this->load->view('inventory/keluar', $data);
    }

    public function ajax_table_stok_keluar()
    {

        $a = $this->input->post('outlet'); //31-Cabang Surabaya
        $kategori = $this->input->post('kategori');
        $dari_tanggal = $this->input->post('dari_tanggal');
        $sampai_tanggal = $this->input->post('sampai_tanggal');

        $b = explode('-', $a);
        $id_outlet = $b[0];
        $nama_outlet = $b[1];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet
            );
        } else {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $table = 'tbl_stok_keluar'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'tanggal_transaksi', 'sku', 'nama_produk', 'kategori', 'jumlah', 'satuan', 'nilai_stok', 'catatan', 'id_mst_user', 'nama', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'tanggal_transaksi', 'sku', 'nama_produk', 'kategori', 'jumlah', 'satuan', 'nilai_stok', 'catatan', 'id_mst_user', 'nama', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, id_mst_bisnis, id_mst_outlet, nama_outlet, tanggal_transaksi, sku, nama_produk, kategori, jumlah, satuan, nilai_stok, catatan, id_mst_user, nama, date_created';
        $order = array('tanggal_transaksi' => 'asc'); // default order 
        $group = array('kode_trx'); // default order 
        $list = $this->m_inventory->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['id_mst_bisnis'] = $key->id_mst_bisnis;
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['nama_outlet'] = $key->nama_outlet;
            $row['data']['tanggal_transaksi'] = $key->tanggal_transaksi;
            $row['data']['sku'] = $key->sku;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['kategori'] = $key->kategori;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['nilai_stok'] = $key->nilai_stok;
            $row['data']['catatan'] = $key->catatan;
            $row['data']['id_mst_user'] = $key->id_mst_user;
            $row['data']['nama'] = $key->nama;
            $row['data']['date_created'] = $key->date_created;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_inventory->count_all($table),
            "recordsFiltered" => $this->m_inventory->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function generatedatakeluar()
    {
        $table = 'tbl_stok_keluar';
        $numrow = 10;
        $no = 1;
        $a = $_GET['outlet'];
        $b = explode('-', $a);
        $outlet = $b[0];
        $nama_outlet = $b[1];
        $kategori = $_GET['kategori'];
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet
            );
        } else {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $data = $this->crud->get_where($table, $where)->result();

        $d = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array(); //UNTUK KEPERLUAN PEMBERIAN NAMA FILE EXCEL


        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(20);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(10);
        $excel->getColumnDimension('F')->setWidth(12);
        $excel->getColumnDimension('G')->setWidth(12);
        $excel->getColumnDimension('H')->setWidth(15);
        $excel->getColumnDimension('I')->setWidth(40);
        $excel->getColumnDimension('J')->setWidth(15);
        $excel->getColumnDimension('K')->setWidth(20);

        $excel->getRowDimension('9')->setRowHeight(15);

        $excel->getStyle('A1')->getFont()->setBold(true);
        $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A9:K9')->getFont()->setBold(true);

        $excel->getStyle('A2:A3')->getFont()->setSize(9);
        $excel->getStyle('A9:K9')->getFont()->setSize(10);
        $excel->getStyle('A7')->getFont()->setSize(9);
        $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A9:K9')->applyFromArray($styleArray);

        $excel->setCellValue('A1', strtoupper($d['nama_bisnis']));
        $excel->setCellValue('A2', strtoupper($nama_outlet . '-' . $d['kota_bisnis']));
        $excel->setCellValue('A3', "Phone " . $d['telephone']);
        $excel->setCellValue('A5', "STOK KELUAR");
        $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($dari_tanggal)) . " sd " . date('d-M-Y', strtotime($sampai_tanggal)));
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "KODE TRANSAKSI");
        $excel->setCellValue('C9', "TANGGAL TRANSAKSI");
        $excel->setCellValue('D9', "NAMA PRODUK");
        $excel->setCellValue('E9', "SKU");
        $excel->setCellValue('F9', "JUMLAH");
        $excel->setCellValue('G9', "SATUAN");
        $excel->setCellValue('H9', "NILAI STOK");
        $excel->setCellValue('I9', "CATATAN");
        $excel->setCellValue('J9', "PIC");
        $excel->setCellValue('K9', "WAKTU SUBMIT");

        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->kode_trx);
            $excel->setCellValue('C' . $numrow, $key->tanggal_transaksi);
            $excel->setCellValue('D' . $numrow, $key->nama_produk);
            $excel->setCellValue('E' . $numrow, $key->sku);
            $excel->setCellValue('F' . $numrow, $key->jumlah);
            $excel->setCellValue('G' . $numrow, $key->satuan);
            $excel->setCellValue('H' . $numrow, $key->nilai_stok);
            $excel->setCellValue('I' . $numrow, $key->catatan);
            $excel->setCellValue('J' . $numrow, $key->nama);
            $excel->setCellValue('K' . $numrow, $key->date_created);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':K' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':K' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = '[STOK KELUAR]-' . $d['nama_bisnis'] . '-' . $nama_outlet . '.xlsx';

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function ajax_table_keluar_detail()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode'),
        );


        $table = 'tbl_stok_keluar'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'nama_produk', 'jumlah', 'satuan', 'nilai_stok'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'nama_produk', 'jumlah', 'satuan', 'nilai_stok'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, nama_produk, jumlah, satuan, nilai_stok';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['nilai_stok'] = $key->nilai_stok;

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

    public function transfer()
    {
        $a = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $a['id']])->result_array();
        $data['kategori'] = $this->crud->get_where('mst_kategori', ['id_mst_bisnis' => $a['id']])->result_array();

        $this->load->view('inventory/transfer', $data);
    }

    public function ajax_table_stok_transfer()
    {

        $a = $this->input->post('outlet'); //31-Cabang Surabaya
        $kategori = $this->input->post('kategori');
        $dari_tanggal = $this->input->post('dari_tanggal');
        $sampai_tanggal = $this->input->post('sampai_tanggal');

        $b = explode('-', $a);
        $id_outlet = $b[0];
        $nama_outlet = $b[1];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet
            );
        } else {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $table = 'tbl_transfer_stok'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'id_outlet_asal', 'outlet_asal', 'id_outlet_tujuan', 'outlet_tujuan', 'tanggal_transaksi', 'email', 'sku', 'nama_produk', 'kategori', 'jumlah', 'satuan', 'catatan', 'id_mst_user', 'nama', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'id_outlet_asal', 'outlet_asal', 'id_outlet_tujuan', 'outlet_tujuan', 'tanggal_transaksi', 'email', 'sku', 'nama_produk', 'kategori', 'jumlah', 'satuan', 'catatan', 'id_mst_user', 'nama', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, id_mst_bisnis, id_mst_outlet, nama_outlet, id_outlet_asal, outlet_asal, id_outlet_tujuan, outlet_tujuan, tanggal_transaksi, email, sku, nama_produk, kategori, jumlah, satuan, catatan, id_mst_user, nama, date_created';
        $order = array('tanggal_transaksi' => 'asc'); // default order 
        $group = array('kode_trx'); // default order 
        $list = $this->m_inventory->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['nama_outlet'] = $key->nama_outlet;
            $row['data']['id_mst_bisnis'] = $key->id_mst_bisnis;
            $row['data']['id_outlet_asal'] = $key->id_outlet_asal;
            $row['data']['outlet_asal'] = $key->outlet_asal;
            $row['data']['id_outlet_tujuan'] = $key->id_outlet_tujuan;
            $row['data']['outlet_tujuan'] = $key->outlet_tujuan;
            $row['data']['tanggal_transaksi'] = $key->tanggal_transaksi;
            $row['data']['email'] = $key->email;
            $row['data']['sku'] = $key->sku;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['kategori'] = $key->kategori;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['catatan'] = $key->catatan;
            $row['data']['id_mst_user'] = $key->id_mst_user;
            $row['data']['nama'] = $key->nama;
            $row['data']['date_created'] = $key->date_created;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_inventory->count_all($table),
            "recordsFiltered" => $this->m_inventory->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_transfer_detail()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode'),
        );


        $table = 'tbl_transfer_stok'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'outlet_asal', 'outlet_tujuan', 'nama_produk', 'jumlah', 'satuan'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'outlet_asal', 'outlet_tujuan', 'nama_produk', 'jumlah', 'satuan'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, outlet_asal, outlet_tujuan, nama_produk, jumlah, satuan';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['outlet_asal'] = $key->outlet_asal;
            $row['data']['outlet_tujuan'] = $key->outlet_tujuan;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;

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

    public function generatedatatransfer()
    {
        $table = 'tbl_transfer_stok';
        $numrow = 10;
        $no = 1;
        $a = $_GET['outlet'];
        $b = explode('-', $a);
        $outlet = $b[0];
        $nama_outlet = $b[1];
        $kategori = $_GET['kategori'];
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet
            );
        } else {
            $where = array(
                'tanggal_transaksi >=' => $dari_tanggal,
                'tanggal_transaksi <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $data = $this->crud->get_where($table, $where)->result();

        $d = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array(); //UNTUK KEPERLUAN PEMBERIAN NAMA FILE EXCEL


        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(20);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(20);
        $excel->getColumnDimension('F')->setWidth(20);
        $excel->getColumnDimension('G')->setWidth(12);
        $excel->getColumnDimension('H')->setWidth(12);
        $excel->getColumnDimension('I')->setWidth(12);
        $excel->getColumnDimension('J')->setWidth(40);
        $excel->getColumnDimension('K')->setWidth(20);
        $excel->getColumnDimension('L')->setWidth(20);

        $excel->getRowDimension('9')->setRowHeight(15);

        $excel->getStyle('A1')->getFont()->setBold(true);
        $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A9:L9')->getFont()->setBold(true);

        $excel->getStyle('A2:A3')->getFont()->setSize(9);
        $excel->getStyle('A9:L9')->getFont()->setSize(10);
        $excel->getStyle('A7')->getFont()->setSize(9);
        $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A9:L9')->applyFromArray($styleArray);

        $excel->setCellValue('A1', strtoupper($d['nama_bisnis']));
        $excel->setCellValue('A2', strtoupper($nama_outlet . '-' . $d['kota_bisnis']));
        $excel->setCellValue('A3', "Phone " . $d['telephone']);
        $excel->setCellValue('A5', "TRANSFER STOK");
        $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($dari_tanggal)) . " sd " . date('d-M-Y', strtotime($sampai_tanggal)));
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "KODE TRANSAKSI");
        $excel->setCellValue('C9', "TANGGAL TRANSAKSI");
        $excel->setCellValue('D9', "OUTLET ASAL");
        $excel->setCellValue('E9', "OUTLET TUJUAN");
        $excel->setCellValue('F9', "NAMA PRODUK");
        $excel->setCellValue('G9', "SKU");
        $excel->setCellValue('H9', "JUMLAH");
        $excel->setCellValue('I9', "SATUAN");
        $excel->setCellValue('J9', "CATATAN");
        $excel->setCellValue('K9', "PIC");
        $excel->setCellValue('L9', "WAKTU SUBMIT");

        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->kode_trx);
            $excel->setCellValue('C' . $numrow, $key->tanggal_transaksi);
            $excel->setCellValue('D' . $numrow, $key->outlet_asal);
            $excel->setCellValue('E' . $numrow, $key->outlet_tujuan);
            $excel->setCellValue('F' . $numrow, $key->nama_produk);
            $excel->setCellValue('G' . $numrow, $key->sku);
            $excel->setCellValue('H' . $numrow, $key->jumlah);
            $excel->setCellValue('I' . $numrow, $key->satuan);
            $excel->setCellValue('J' . $numrow, $key->catatan);
            $excel->setCellValue('K' . $numrow, $key->nama);
            $excel->setCellValue('L' . $numrow, $key->date_created);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':L' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':L' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = '[TRANSFER STOK]-' . $d['nama_bisnis'] . '-' . $nama_outlet . '.xlsx';

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function sto()
    {
        $a = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $a['id']])->result_array();
        $data['kategori'] = $this->crud->get_where('mst_kategori', ['id_mst_bisnis' => $a['id']])->result_array();

        $this->load->view('inventory/sto', $data);
    }

    public function ajax_table_stok_opname()
    {

        $a = $this->input->post('outlet'); //31-Cabang Surabaya
        $kategori = $this->input->post('kategori');
        $dari_tanggal = $this->input->post('dari_tanggal');
        $sampai_tanggal = $this->input->post('sampai_tanggal');

        $b = explode('-', $a);
        $id_outlet = $b[0];
        $nama_outlet = $b[1];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_sto >=' => $dari_tanggal,
                'tanggal_sto <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet
            );
        } else {
            $where = array(
                'tanggal_sto >=' => $dari_tanggal,
                'tanggal_sto <=' => $sampai_tanggal,
                'id_mst_outlet' => $id_outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $table = 'tbl_stok_opname'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'tanggal_sto', 'sku', 'nama_produk', 'kategori', 'jml_barang_sistem', 'jml_barang_aktual', 'satuan', 'catatan', 'selisih_jml_barang', 'harga_unit_sistem', 'harga_unit_baru', 'status_sto', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'tanggal_sto', 'sku', 'nama_produk', 'kategori', 'jml_barang_sistem', 'jml_barang_aktual', 'satuan', 'catatan', 'selisih_jml_barang', 'harga_unit_sistem', 'harga_unit_baru', 'status_sto', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, id_mst_bisnis, id_mst_outlet, nama_outlet, tanggal_sto, sku, nama_produk, kategori, jml_barang_sistem, jml_barang_aktual, satuan, catatan, selisih_jml_barang, harga_unit_sistem, harga_unit_baru, status_sto, date_created';
        $order = array('tanggal_sto' => 'asc'); // default order 
        $group = array('kode_trx'); // default order 
        $list = $this->m_inventory->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['id_mst_bisnis'] = $key->id_mst_bisnis;
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['nama_outlet'] = $key->nama_outlet;
            $row['data']['tanggal_sto'] = $key->tanggal_sto;
            $row['data']['sku'] = $key->sku;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['kategori'] = $key->kategori;
            $row['data']['jml_barang_sistem'] = $key->jml_barang_sistem;
            $row['data']['jml_barang_aktual'] = $key->jml_barang_aktual;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['catatan'] = $key->catatan;
            $row['data']['selisih_jml_barang'] = $key->selisih_jml_barang;
            $row['data']['harga_unit_sistem'] = $key->harga_unit_sistem;
            $row['data']['harga_unit_baru'] = $key->harga_unit_baru;
            $row['data']['status_sto'] = $key->status_sto;
            $row['data']['date_created'] = $key->date_created;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_inventory->count_all($table),
            "recordsFiltered" => $this->m_inventory->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query()
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_sto_detail()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode'),
        );


        $table = 'tbl_stok_opname'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'nama_produk', 'jml_barang_sistem', 'jml_barang_aktual', 'satuan', 'selisih_jml_barang', 'harga_unit_sistem', 'harga_unit_baru'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'nama_produk', 'jml_barang_sistem', 'jml_barang_aktual', 'satuan', 'selisih_jml_barang', 'harga_unit_sistem', 'harga_unit_baru'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, nama_produk, jml_barang_sistem, jml_barang_aktual, satuan, selisih_jml_barang, harga_unit_sistem, harga_unit_baru';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = $key->id;
            $row['data']['kode_trx'] = $key->kode_trx;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['jml_barang_sistem'] = $key->jml_barang_sistem;
            $row['data']['jml_barang_aktual'] = $key->jml_barang_aktual;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['selisih_jml_barang'] = $key->selisih_jml_barang;
            $row['data']['harga_unit_sistem'] = $key->harga_unit_sistem;
            $row['data']['harga_unit_baru'] = $key->harga_unit_baru;

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

    public function generatedatasto()
    {
        $table = 'tbl_stok_opname';
        $numrow = 10;
        $no = 1;
        $a = $_GET['outlet'];
        $b = explode('-', $a);
        $outlet = $b[0];
        $nama_outlet = $b[1];
        $kategori = $_GET['kategori'];
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];

        if ($kategori == 'SEMUA') {
            $where = array(
                'tanggal_sto >=' => $dari_tanggal,
                'tanggal_sto <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet
            );
        } else {
            $where = array(
                'tanggal_sto >=' => $dari_tanggal,
                'tanggal_sto <=' => $sampai_tanggal,
                'id_mst_outlet' => $outlet,
                'id_mst_kategori' => $kategori
            );
        }

        $data = $this->crud->get_where($table, $where)->result();

        $d = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array(); //UNTUK KEPERLUAN PEMBERIAN NAMA FILE EXCEL


        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(15);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(12);
        $excel->getColumnDimension('F')->setWidth(22);
        $excel->getColumnDimension('G')->setWidth(22);
        $excel->getColumnDimension('H')->setWidth(22);
        $excel->getColumnDimension('I')->setWidth(12);
        $excel->getColumnDimension('J')->setWidth(20);
        $excel->getColumnDimension('K')->setWidth(20);
        $excel->getColumnDimension('L')->setWidth(40);
        $excel->getColumnDimension('M')->setWidth(20);
        $excel->getColumnDimension('N')->setWidth(20);

        $excel->getRowDimension('9')->setRowHeight(15);

        $excel->getStyle('A1')->getFont()->setBold(true);
        $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A9:N9')->getFont()->setBold(true);

        $excel->getStyle('A2:A3')->getFont()->setSize(9);
        $excel->getStyle('A9:N9')->getFont()->setSize(10);
        $excel->getStyle('A7')->getFont()->setSize(9);
        $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A9:N9')->applyFromArray($styleArray);

        $excel->setCellValue('A1', strtoupper($d['nama_bisnis']));
        $excel->setCellValue('A2', strtoupper($nama_outlet . '-' . $d['kota_bisnis']));
        $excel->setCellValue('A3', "Phone " . $d['telephone']);
        $excel->setCellValue('A5', "TRANSFER STOK");
        $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($dari_tanggal)) . " sd " . date('d-M-Y', strtotime($sampai_tanggal)));
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "KODE TRANSAKSI");
        $excel->setCellValue('C9', "TANGGAL STO");
        $excel->setCellValue('D9', "NAMA PRODUK");
        $excel->setCellValue('E9', "SKU");
        $excel->setCellValue('F9', "JUMLAH BARANG (SISTEM)");
        $excel->setCellValue('G9', "JUMLAH BARANG (AKTUAL)");
        $excel->setCellValue('H9', "SELISIH JUMLAH BARANG");
        $excel->setCellValue('I9', "SATUAN");
        $excel->setCellValue('J9', "HARGA UNIT (SISTEM)");
        $excel->setCellValue('K9', "HARGA UNIT (BARU)");
        $excel->setCellValue('L9', "CATATAN");
        $excel->setCellValue('M9', "STATUS");
        $excel->setCellValue('N9', "WAKTU SUBMIT");

        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->kode_trx);
            $excel->setCellValue('C' . $numrow, $key->tanggal_sto);
            $excel->setCellValue('D' . $numrow, $key->nama_produk);
            $excel->setCellValue('E' . $numrow, $key->sku);
            $excel->setCellValue('F' . $numrow, $key->jml_barang_sistem);
            $excel->setCellValue('G' . $numrow, $key->jml_barang_aktual);
            $excel->setCellValue('H' . $numrow, $key->selisih_jml_barang);
            $excel->setCellValue('I' . $numrow, $key->satuan);
            $excel->setCellValue('J' . $numrow, $key->harga_unit_sistem);
            $excel->setCellValue('K' . $numrow, $key->harga_unit_baru);
            $excel->setCellValue('L' . $numrow, $key->catatan);
            $excel->setCellValue('M' . $numrow, $key->status_sto);
            $excel->setCellValue('N' . $numrow, $key->date_created);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':N' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':N' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = '[STOK OPNAME]-' . $d['nama_bisnis'] . '-' . $nama_outlet . '.xlsx';

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
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
