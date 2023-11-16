<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_surat extends CI_Controller
{

    var $module_js = ['kategori'];
    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    public function index()
    {
        $query_menu = [
            'select' => 'id_parent,name, icon, link, type, is_admin',
            'from' => 'app_menu',
            'where' => [
                'is_admin' => '1'
            ]
        ];

        $query_dropdown = [
            'select' => 'id_parent,name,link,icon, type, is_admin',
            'from' => 'app_menu',
            'where' => [
                'type' => '2',
                'is_admin' => '1'
            ]
        ];

        $query_child = [
            'select' => 'id_parent,name,link,icon, type, is_admin',
            'from' => 'app_menu',
            'where' => [
                'type' => '3',
                'is_admin' => '1'
            ]
        ];

        $this->app_data['get_menu'] = $this->data->get($query_menu)->result();
        $this->app_data['get_dropdown'] = $this->data->get($query_dropdown)->result();
        $this->app_data['get_child'] = $this->data->get($query_child)->result();
        $this->load->view('template-admin/start');
        $this->load->view('template-admin/header', $this->app_data);
        $this->load->view('menu-admin/kategori', $this->app_data);
        $this->load->view('template-admin/footer');
        $this->load->view('template-admin/end');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $result = $this->data->get_all('kategori_arsip')->result();
        echo json_encode($result);
    }
    public function get_data_id()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $result = $this->data->find('kategori_arsip', $where)->result();
        echo json_encode($result);
    }

    public function edit_data()
    {
        $this->form_validation->set_rules('nama', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $data = array(
                'nama_kategori' => $nama,
                'keterangan' => $keterangan
            );

            $where = array('id' => $id);
            $this->data->update('kategori_arsip', $where, $data);
            $response['success'] = "<script>$(document).ready(function () {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                          });

                        Toast.fire({
                            icon: 'success',
                            title: 'Anda telah melakukan aksi edit data Data berhasil diedit'
                          })
                      });</script>";
        }
        echo json_encode($response);
    }
    public function delete_data()
    {
        $id = $this->input->post('id');
        $where = array('id' => $id);
        $deleted = $this->data->delete('kategori_arsip', $where);
        $response = array();

        if ($deleted) {
            $response['success'] = "<script>$(document).ready(function () {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
              });

            Toast.fire({
                icon: 'success',
                title: 'Record with ID: " . $id . " has been deleted successfully'
              })
          });</script>";
        } else {
            $response['error'] = 'Error occurred while deleting the record.';
        }
        echo json_encode($response);
    }
}
