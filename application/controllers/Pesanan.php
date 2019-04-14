<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pesanan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id_pesanan = $this->get('id_pesanan');
        if ($id_pesanan == '') {
            $kontak = $this->db->get('pesanan')->result();
        } else {
            $this->db->where('id_pesanan', $id_pesanan);
            $kontak = $this->db->get('pesanan')->result();
        }
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id_pesanan'    => $this->post('id_pesanan'),
                    'nama_user'  => $this->post('nama_user'),
                    'harga_total' => $this->post('harga_total'),
                    'alamat' => $this-put('alamat'),
                    'id' => $this-put('id'));
        $insert = $this->db->insert('pesanan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data kontak yang telah ada
    function index_put() {
        $id_pesanan = $this->put('id_pesanan');
        $data = array(
                    'id_pesanan'       => $this->put('id_pesanan'),
                    'nama_user'          => $this->put('nama_user'),
                    'harga_total'    => $this->put('harga_total'),
                    'password' => $this-put('password'),
                    'alamat' => $this-put('alamat'),
                    'id' => $this-put('id'));
        $this->db->where('id_pesanan', $id_pesanan);
        $update = $this->db->update('pesanan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini
        //Menghapus salah satu data kontak
        function index_delete() {
            $id_pesanan = $this->delete('id_pesanan');
            $this->db->where('id_pesanan', $id_pesanan);
            $delete = $this->db->delete('pesanan');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    //Masukan function selanjutnya disini
}
?>  