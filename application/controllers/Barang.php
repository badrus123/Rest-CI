<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Barang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id_barang = $this->get('id_barang');
        if ($id_barang == '') {
            $kontak = $this->db->select('*')->from('barang')->join('user','user.id = barang.id')->get()->result();
        } else {
            $this->db->where('id_barang', $id_barang);
            $kontak = $this->db->get('barang')->result();
        }
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id_barang'    => $this->post('id_barang'),
                    'nama_barang'  => $this->post('nama_barang'),
                    'kategori' => $this->post('kategori'),
                    'harga' => $this-put('harga'),
                    'deskripsi' => $this-put('deskripsi'),
                    'foto' => $this-put('foto'),
                    'id' => $this-put('id'));
        $insert = $this->db->insert('barang', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data kontak yang telah ada
    function index_put() {
        $id_barang = $this->put('id_barang');
        $data = array(
                    'id_barang'       => $this->put('id_barang'),
                    'nama_barang'          => $this->put('nama_barang'),
                    'kategori'    => $this->put('kategori'),
                    'harga' => $this-put('harga'),
                    'deskripsi' => $this-put('deskripsi'),
                    'foto' => $this-put('foto'),
                    'id' => $this-put('id'));
        $this->db->where('id_barang', $id_barang);
        $update = $this->db->update('barang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini
        //Menghapus salah satu data kontak
        function index_delete() {
            $id_barang = $this->delete('id_barang');
            $this->db->where('id_barang', $id_barang);
            $delete = $this->db->delete('barang');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    //Masukan function selanjutnya disini
}
?>  