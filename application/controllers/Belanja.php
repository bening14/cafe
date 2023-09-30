<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Belanja extends CI_Controller
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
        $r = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['id_mst_bisnis'] = $r['id'];

        // $data['kategori'] = $this->crud->get_all('mst_kategori')->result_array();
        $this->load->view('belanja/supplier', $data);
    }

    public function ajax_table_supplier()
    {
        $where = array(
            'id_mst_bisnis' => $this->input->post('id_mst_bisnis')
        );
        $table = 'mst_supplier'; //nama tabel dari database
        $column_order = array('id', 'id_mst_bisnis', 'id_mst_outlet', 'kode_supplier', 'nama_supplier', 'alamat', 'telephone', 'email', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'id_mst_bisnis', 'id_mst_outlet', 'kode_supplier', 'nama_supplier', 'alamat', 'telephone', 'email', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_bisnis, id_mst_outlet, kode_supplier, nama_supplier, alamat, telephone, email, date_created';
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
            $row['data']['id_mst_outlet'] = $key->id_mst_outlet;
            $row['data']['kode_supplier'] = $key->kode_supplier;
            $row['data']['nama_supplier'] = $key->nama_supplier;
            $row['data']['alamat'] = $key->alamat;
            $row['data']['telephone'] = $key->telephone;
            $row['data']['email'] = $key->email;
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

    public function delete_data()
    {
        $table = $this->input->post('table');
        if ($this->crud->delete($table, ['id' => $this->input->post('id')])) {
            $response = ['status' => 'success', 'message' => 'Success Delete Data!'];
        } else
            $response = ['status' => 'failed', 'message' => 'Error Delete Data!'];

        echo json_encode($response);
    }

    public function insert_data_supplier()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        if ($data['kategori'] == 'tambah') {
            //buat kode supplier
            $d = $this->crud->get_all_limit($table)->row_array();
            if ($d) {
                $r = explode('-', $d['kode_supplier']);
                $seq = $r[1] + 1;
                $data['kode_supplier'] = 'SP-' . $seq;
            } else {
                $data['kode_supplier'] = 'SP-1000000';
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

    public function purchase_order()
    {
        $a = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array();
        $data['id_mst_bisnis'] = $a['id'];
        $data['outlet'] = $this->crud->get_where('mst_outlet', ['id_mst_bisnis' => $a['id']])->result_array();
        $data['supplier'] = $this->crud->get_where('mst_supplier', ['id_mst_bisnis' => $a['id']])->result_array();

        $this->load->view('belanja/purchase_order', $data);
    }

    public function ajax_table_po()
    {
        $a = $this->input->post('outlet'); //31-Cabang Surabaya
        $supplier = $this->input->post('supplier');
        $status_po = $this->input->post('status_po');
        $dari_tanggal = $this->input->post('dari_tanggal');
        $sampai_tanggal = $this->input->post('sampai_tanggal');
        $nomor_po = $this->input->post('nomor_po');
        $id_mst_bisnis = $this->input->post('id_mst_bisnis');

        $b = explode('-', $a);
        $id_outlet = $b[0];
        $nama_outlet = $b[1];

        if ($nomor_po != '') {
            $where = array(
                'nomor_po' => $nomor_po,
                'id_mst_bisnis' => $id_mst_bisnis
            );
        } else {
            if ($supplier == 'SEMUA') {
                if ($status_po == 'SEMUA') {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet
                    );
                } else {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet,
                        'status_po' => $status_po
                    );
                }
            } else {
                if ($status_po == 'SEMUA') {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet,
                        'kode_supplier' => $supplier
                    );
                } else {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet,
                        'kode_supplier' => $supplier,
                        'status_po' => $status_po
                    );
                }
            }
        }



        // echo '<pre>';
        // var_dump($where);
        // echo '</pre>';
        // die;

        $table = 'tbl_purchase_order'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'id_mst_bisnis', 'id_mst_outlet', 'nama_outlet', 'nomor_po', 'kode_supplier', 'nama_supplier', 'tanggal', 'catatan', 'nama_produk', 'sku', 'jumlah', 'satuan', 'harga_beli_satuan', 'harga_beli_total', 'status_po', 'date_created'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'id_mst_outlet', 'id_mst_outlet', 'nama_outlet', 'nomor_po', 'kode_supplier', 'nama_supplier', 'tanggal', 'catatan', 'nama_produk', 'sku', 'jumlah', 'satuan', 'harga_beli_satuan', 'harga_beli_total', 'status_po', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, id_mst_bisnis, id_mst_outlet, nama_outlet, nomor_po, kode_supplier, nama_supplier, tanggal, catatan, nama_produk, sku, jumlah, satuan, harga_beli_satuan, harga_beli_total, status_po, date_created';
        $order = array('nomor_po' => 'asc'); // default order 
        $group = array('nomor_po'); // default order 
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
            $row['data']['nomor_po'] = $key->nomor_po;
            $row['data']['kode_supplier'] = $key->kode_supplier;
            $row['data']['nama_supplier'] = $key->nama_supplier;
            $row['data']['tanggal'] = $key->tanggal;
            $row['data']['catatan'] = $key->catatan;
            $row['data']['nama_produk'] = $key->nama_produk;
            $row['data']['sku'] = $key->sku;
            $row['data']['jumlah'] = $key->jumlah;
            $row['data']['satuan'] = $key->satuan;
            $row['data']['harga_beli_satuan'] = $key->harga_beli_satuan;
            $row['data']['harga_beli_total'] = $key->harga_beli_total;
            $row['data']['status_po'] = $key->status_po;
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

    public function getdata()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode_trx')
        );
        $table = $this->input->post('table');

        $result = $this->crud->get_where($table, $where)->row_array();

        echo json_encode($result);
    }

    public function ajax_table_po_detail()
    {
        $where = array(
            'kode_trx' => $this->input->post('kode'),
        );


        $table = 'tbl_purchase_order'; //nama tabel dari database
        $column_order = array('id', 'kode_trx', 'nama_produk', 'jumlah', 'satuan', 'harga_beli_satuan', 'harga_beli_total'); //field yang ada di table user
        $column_search = array('id', 'kode_trx', 'nama_produk', 'jumlah', 'satuan', 'harga_beli_satuan', 'harga_beli_total'); //field yang diizin untuk pencarian 
        $select = 'id, kode_trx, nama_produk, jumlah, satuan, harga_beli_satuan, harga_beli_total';
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
            $row['data']['harga_beli_satuan'] = $key->harga_beli_satuan;
            $row['data']['harga_beli_total'] = $key->harga_beli_total;

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

    public function generatedatapo()
    {
        $table = 'tbl_purchase_order';
        $numrow = 10;
        $no = 1;
        if ($_GET['outlet']) {
            $a = $_GET['outlet'];
            $b = explode('-', $a);
            $id_outlet = $b[0];
            $nama_outlet = $b[1];
        } else {
            $id_outlet = '';
            $nama_outlet = '';
        }
        $supplier = $_GET['supplier'];
        $dari_tanggal = $_GET['dari_tanggal'];
        $sampai_tanggal = $_GET['sampai_tanggal'];
        $status_po = $_GET['status_po'];
        $nomor_po = $_GET['nomor_po'];
        $id_mst_bisnis = $_GET['id_mst_bisnis'];

        if ($nomor_po != '') {
            $where = array(
                'nomor_po' => $nomor_po,
                'id_mst_bisnis' => $id_mst_bisnis
            );
        } else {
            if ($supplier == 'SEMUA') {
                if ($status_po == 'SEMUA') {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet
                    );
                } else {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet,
                        'status_po' => $status_po
                    );
                }
            } else {
                if ($status_po == 'SEMUA') {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet,
                        'kode_supplier' => $supplier
                    );
                } else {
                    $where = array(
                        'tanggal >=' => $dari_tanggal,
                        'tanggal <=' => $sampai_tanggal,
                        'id_mst_outlet' => $id_outlet,
                        'kode_supplier' => $supplier,
                        'status_po' => $status_po
                    );
                }
            }
        }

        $data = $this->crud->get_where($table, $where)->result();
        // echo $this->db->last_query();
        // die;

        $d = $this->crud->get_where('mst_bisnis', ['id_mst_user' => $this->session->userdata('id')])->row_array(); //UNTUK KEPERLUAN PEMBERIAN NAMA FILE EXCEL


        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(20);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(12);
        $excel->getColumnDimension('F')->setWidth(20);
        $excel->getColumnDimension('G')->setWidth(12);
        $excel->getColumnDimension('H')->setWidth(12);
        $excel->getColumnDimension('I')->setWidth(12);
        $excel->getColumnDimension('J')->setWidth(20);
        $excel->getColumnDimension('K')->setWidth(20);
        $excel->getColumnDimension('L')->setWidth(40);
        $excel->getColumnDimension('M')->setWidth(15);
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
        $excel->setCellValue('A2', strtoupper($d['kota_bisnis']));
        $excel->setCellValue('A3', "Phone " . $d['telephone']);
        $excel->setCellValue('A5', "PURCHASE ORDER");
        if ($nomor_po != '') {
            $excel->setCellValue('A7', "PERIODE : - ");
        } else {
            $excel->setCellValue('A7', "PERIODE : " . date('d-M-Y', strtotime($dari_tanggal)) . " sd " . date('d-M-Y', strtotime($sampai_tanggal)));
        }
        $excel->setCellValue('A9', "NO");
        $excel->setCellValue('B9', "KODE TRANSAKSI");
        $excel->setCellValue('C9', "PO NUMBER");
        $excel->setCellValue('D9', "SUPPLIER");
        $excel->setCellValue('E9', "TANGGAL");
        $excel->setCellValue('F9', "NAMA PRODUK");
        $excel->setCellValue('G9', "SKU");
        $excel->setCellValue('H9', "JUMLAH");
        $excel->setCellValue('I9', "SATUAN");
        $excel->setCellValue('J9', "HARGA BELI (SATUAN)");
        $excel->setCellValue('K9', "TOTAL HARGA BELI");
        $excel->setCellValue('L9', "CATATAN");
        $excel->setCellValue('M9', "STATUS PO");
        $excel->setCellValue('N9', "WAKTU SUBMIT");



        foreach ($data as $key) {
            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, $key->kode_trx);
            $excel->setCellValue('C' . $numrow, $key->nomor_po);
            $excel->setCellValue('D' . $numrow, $key->nama_supplier);
            $excel->setCellValue('E' . $numrow, $key->tanggal);
            $excel->setCellValue('F' . $numrow, $key->nama_produk);
            $excel->setCellValue('G' . $numrow, $key->sku);
            $excel->setCellValue('H' . $numrow, $key->jumlah);
            $excel->setCellValue('I' . $numrow, $key->satuan);
            $excel->setCellValue('J' . $numrow, $key->harga_beli_satuan);
            $excel->setCellValue('K' . $numrow, $key->harga_beli_total);
            $excel->setCellValue('L' . $numrow, $key->catatan);
            $excel->setCellValue('M' . $numrow, $key->status_po);
            $excel->setCellValue('N' . $numrow, $key->date_created);
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':N' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':N' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = '[PURCHASE ORDER]-' . $d['nama_bisnis'] . '.xlsx';

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
}
