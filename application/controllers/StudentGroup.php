<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentGroup extends CI_Controller {


	public function add()
	{
		$this->load->library('session');

		$data = [];
		$this->load->model("Degree_model");
		$data['degrees'] = $this->Degree_model->getAllDegrees();

		$this->load->model("Group_model");
		$data['groups'] = $this->Group_model->getAllGroups();

		$this->load->view('templates/header');
		$this->load->view('forms/addStudentGroup', $data);
		$this->load->view('templates/footer');
	}
}
