<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{

	var $module_js = ['arsip'];
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
		$this->load->view('menu-admin/arsip', $this->app_data);
		$this->load->view('template-admin/footer');
		$this->load->view('template-admin/end');
		$this->load->view('js-custom', $this->app_data);
	}

	public function get_data()
	{
		$query = [
			'select' => 'a.id, a.no_surat, a.judul, a.waktu, a.file_name, b.nama_kategori',
			'from' => 'arsip a',
			'join' => [
				'kategori_arsip b, b.id = a.id_kategori'
			]
		];
		$result = $this->data->get($query)->result();
		echo json_encode($result);
	}

	public function get_data_id()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$result = $this->data->find('arsip', $where)->result();
		echo json_encode($result);
	}
	public function edit_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$file_name = $this->data->get_file_name('arsip', $where, 'file_name');

		if (!empty($_FILES['pdf']['name'])) {
			$currentDateTime = date('Y-m-d_H-i-s');
			$config['upload_path'] = './assets/surat/';
			$config['allowed_types'] = 'pdf';
			$config['file_name'] = "PDF -" . $currentDateTime;
			$config['max_size'] = 5000;
			$this->load->library('upload', $config);

			if ($this->upload->do_upload('pdf')) {
				$upload_data = $this->upload->data();
				$data = array(
					'file_name' => $upload_data['file_name']
				);
				$where = array('id' => $id);
				$updated = $this->data->update('arsip', $where, $data);
				if ($updated) {
					$file_path = './assets/surat/' . $file_name;
					if (file_exists($file_path)) {
						unlink($file_path);
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
                            title: 'Data berhasil diedit'
                          })
                      });</script>";;
				} else {
					$response['error'] = "Gagal menghapus data";
				}
			} else {
				$response['errors']['pdf'] = strip_tags($this->upload->display_errors());
			}
		} else {
			$response['success'] = "Tidak melakukan update data";
		}
		echo json_encode($response);
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$deleted = $this->data->delete('arsip', $where);
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
	public function download_file()
	{
		$id = $this->input->post('id');
		$where = array('id' => $id);
		$file_name = $this->data->get_file_name('arsip', $where, 'file_name');

		$file_path = FCPATH . 'assets/surat/' . $file_name;

		if (file_exists($file_path)) {
			$response['success'] = true;
			$response['url'] = base_url('assets/surat/' . $file_name);
		} else {
			$response['success'] = false;
			$response['url'] = null;
		}

		echo json_encode($response);
	}
}
