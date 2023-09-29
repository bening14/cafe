<?php

class M_inventory extends CI_Model
{
    private function _get_datatables_query($table, $select, $column_order, $column_search, $order, $where, $group)
    {
        // $this->db->select("id, invoice_number, invoice_date, reference2");
        $this->db->select($select);
        $this->db->from($table);
        $this->db->group_by($group);

        if (!empty($where))
            $this->db->where($where);


        $i = 0;
        foreach ($column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else
                    $this->db->or_like($item, $_POST['search']['value']);


                if (count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }


        if (isset($_POST['order']))
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        else if (isset($this->order))
            $this->db->order_by(key($order), $order[key($order)]);
    }

    function get_datatables($table, $select, $column_order, $column_search, $order = null, $where = null, $group = null)
    {
        $this->_get_datatables_query($table, $select, $column_order, $column_search, $order, $where, $group);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        return $this->db->get()->result();
    }

    function count_filtered($table, $select, $column_order, $column_search, $order = null, $where = null, $group = null)
    {
        $this->_get_datatables_query($table, $select, $column_order, $column_search, $order, $where, $group);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    //     // $this->db->select("id, invoice_number, invoice_date, reference2");
    //     $this->db->select($select);
    //     $this->db->from($table);

    //     if (!empty($where))
    //         $this->db->where($where);

    //     // echo "<pre>";
    //     // print_r($this->input->post('search_nomor'));
    //     // echo "</pre>";
    //     // $this->db->where('jenis <>', 'INVOICE');
    //     if ($this->input->post('search_outlet') != '') $this->db->like('nama_outlet', $this->input->post('search_outlet'));
    //     if ($this->input->post('search_nama_produk') != '') $this->db->like('nama_produk', $this->input->post('search_nama_produk'));
    //     // if ($this->input->post('search_serial') != '') $this->db->like('serial_number', $this->input->post('search_serial'));
    //     if ($this->input->post('search_nama_kategori') != '') $this->db->like('nama_kategori', $this->input->post('search_nama_kategori'));
    //     // if ($this->input->post('search_meter') != '') $this->db->like('meter', $this->input->post('search_meter'));
    //     // if ($this->input->post('search_uraian') != '') $this->db->like('uraian', $this->input->post('search_uraian'));
    //     // if ($this->input->post('search_tanggal') != '') $this->db->like('tgl_kerja', $this->input->post('search_tanggal'));
    //     // if ($this->input->post('search_teknisi') != '') $this->db->like('teknisi', $this->input->post('search_teknisi'));

    //     $i = 0;
    //     foreach ($column_search as $item) // looping awal
    //     {
    //         if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
    //         {
    //             if ($i === 0) // looping awal
    //             {
    //                 $this->db->group_start();
    //                 $this->db->like($item, $_POST['search']['value']);
    //             } else
    //                 $this->db->or_like($item, $_POST['search']['value']);


    //             if (count($column_search) - 1 == $i)
    //                 $this->db->group_end();
    //         }
    //         $i++;
    //     }
    //     if (isset($_POST['order']))
    //         $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     else if (isset($this->order))
    //         $this->db->order_by(key($order), $order[key($order)]);
    // }

    // function get_datatables($table, $select, $column_order, $column_search, $order = null, $where = null)
    // {
    //     $this->_get_datatables_query($table, $select, $column_order, $column_search, $order, $where);
    //     if ($_POST['length'] != -1)
    //         $this->db->limit($_POST['length'], $_POST['start']);
    //     return $this->db->get()->result();
    // }

    // function count_filtered($table, $select, $column_order, $column_search, $order = null, $where = null)
    // {
    //     $this->_get_datatables_query($table, $select, $column_order, $column_search, $order, $where);
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }

    // public function count_all($table)
    // {
    //     $this->db->from($table);
    //     return $this->db->count_all_results();
    // }
}
