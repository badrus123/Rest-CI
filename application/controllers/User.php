<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('user')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('user')->result();
        }
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini

    //Mengirim atau menambah data kontak baru
    function index_post() {
        $data = array(
                    'id'    => $this->post('id'),
                    'nama'  => $this->post('nama'),
                    'email' => $this->post('email'),
                    'password' => $this-put('password'),
                    'latitude' => $this-put('latitude'),
                    'longtitude' => $this-put('longtitude'));
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data kontak yang telah ada
    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'email'    => $this->put('email'),
                    'password' => $this-put('password'),
                    'latitude' => $this-put('latitude'),
                    'longtitude' => $this-put('longtitude'));
        $this->db->where('id', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Masukan function selanjutnya disini
        //Menghapus salah satu data kontak
        function index_delete() {
            $id = $this->delete('id');
            $this->db->where('id', $id);
            $delete = $this->db->delete('user');
            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    //Masukan function selanjutnya disini
}
?>  