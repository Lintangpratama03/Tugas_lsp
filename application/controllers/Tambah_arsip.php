<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah_arsip extends CI_Controller
{

    var $module_js = ['tambah-arsip'];
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
        $this->app_data['select'] = $this->data->get_all('kategori_arsip')->result();
        $this->load->view('template-admin/start');
        $this->load->view('template-admin/header', $this->app_data);
        $this->load->view('menu-admin/tambah_arsip', $this->app_data);
        $this->load->view('template-admin/footer');
        $this->load->view('template-admin/end');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id, a.no_surat, a.judul, a.waktu, a.file, b.nama_kategori',
            'from' => 'arsip a',
            'join' => [
                'kategori_arsip b, b.id = a.id_kategori'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'required|trim');
        $this->form_validation->set_rules('nomorSurat', 'Nomer Surat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('kategori'))) {
                $response['errors']['kategori'] = "Kategori harus dipilih";
            }
            if (empty($_FILES['pdf']['name'])) {
                $response['errors']['pdf'] = "File Surat harus diupload";
            }
        } else {
            $judul = $this->input->post('judul');
            $nomorSurat = $this->input->post('nomorSurat');
            $kategori = $this->input->post('kategori');

            if (empty($this->input->post('kategori'))) {
                $response['errors']['kategori'] = "Kategori harus dipilih";
            }
            if (empty($_FILES['pdf']['name'])) {
                $response['errors']['pdf'] = "File Surat harus diupload";
            } else {
                $data = array(
                    'no_surat' => $nomorSurat,
                    'judul' => $judul,
                    'id_kategori' => $kategori
                );

                if (!empty($_FILES['pdf']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/surat/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = "PDF -" . $currentDateTime;
                    $config['max_size'] = 2048;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('pdf')) {
                        $response['errors']['pdf'] = strip_tags($this->upload->display_errors());
                        echo json_encode($response);
                        return;
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['file_name'] = $uploaded_data['file_name'];
                        $this->data->insert('arsip', $data);
                    }
                }
                $response['success'] = "<script>$(document).ready(function () {
                        var Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                          });

                        Toast.fire({
                            icon: 'success',
                            title: 'Anda telah melakukan aksi tambah data Data berhasil dimasukkan'
                          })
                      });</script>";
            }
        }
        echo json_encode($response);
    }
}
