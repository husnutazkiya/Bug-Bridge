<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use chriskacerguis\RestServer\RestController;

class APIcontroller extends RestController {

	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->load->model('Logbook_model');
	}

	public function index_get()
	{
		$response = $this->KontenOrganikAPI_M->all_konten();

		$this->response($response);
	}

	public function konten_get($id)
	{
		$all = $this->db->select('*')->from('t_buglist')->order_by('created_at','DESC')->where('id', $id)->get()->row_array();
		$response['status'] = 200;
		$response['error'] = false;
		$response['t_buglist'] = $all;

		$this->response($response);
	}

	public function addkonten_post()
	{
		$response = $this->Logbook_model->addBuglist(
			$this->post('kode'),
			$this->post('tanggal'),
            $this->post('modul'),
            $this->post('message'),
            $this->post('status'),
		);

		$this->response($response);
	}

	public function deletekonten_delete()
	{
		$response = $this->Logbook_model->delete_konten(
			$this->delete('id')
		);

		$this->response($response);
	}

	public function updatekonten_put()
	{
		$response = $this->Logbook_model->update_konten(
			$this->post('kode'),
			$this->post('tanggal'),
            $this->post('modul'),
            $this->post('message'),
            $this->post('status'),
		);

		$this->response($response);
	}

}
