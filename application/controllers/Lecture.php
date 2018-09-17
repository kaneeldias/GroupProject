<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecture extends CI_Controller {

	public function add()
	{
		$this->load->library("session");
		$this->load->view("templates/header");
		$this->load->view("forms/addLecture");
		$this->load->view("templates/footer");
	}

	public function process(){
		$this->load->model("Lecture_model");
		$lecture = $this->Lecture_model->get();
		$lecture->setGroupId($_POST['group']);
		$lecture->setSemester($_POST['semester']);
		$lecture->setDay($_POST['day']);
		$lecture->setSubjectId($_POST['subject']);
		$lecture->setStartTime($_POST['start_time']);
		$lecture->setEndTime($_POST['end_time']);
		$lecture->save();
		$group = $_POST['group'];
		$semester = $_POST['semester'];
		redirect(base_url("time-table")."?group=$group&semester=$semester&success=true", 'location');

	}

}
