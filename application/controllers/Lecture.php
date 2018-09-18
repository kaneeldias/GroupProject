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
		try{

			/*if(!isset($_POST['group']) ||
				!isset($_POST['semester']) ||
				!isset($_POST['day']) ||
				!isset($_POST['subject']) ||
				!isset($_POST['start_time']) ||
				!isset($_POST['end_time']) ||
				!isset($_POST['venues']) ||
				!isset($_POST['staff'])
			)throw new Exception();

			if($_POST['group'] == "" ||
				$_POST['semester'] == "" ||
				$_POST['day'] == "" ||
				$_POST['subject'] == "" ||
				$_POST['start_time'] == "" ||
				$_POST['end_time'] == ""
			)throw new Exception();

			if(!is_int($_POST['group']) ||
				!is_int($_POST['semester']) ||
				!is_int($_POST['subject']) ||
				!is_int($_POST['start_time']) ||
				!is_int($_POST['end_time']) ||
				!is_array($_POST['venues']) ||
				!is_array($_POST['staff']) ||
				sizeof($_POST['venues']) == 0 ||
				sizeof($_POST['staff']) == 0
			)throw new Exception();

			foreach($_POST['venues'] as $venue){
				if(!is_int($venue)) throw new Exception();
			}

			foreach($_POST['staff'] as $staff){
				if(!is_int($staff)) throw new Exception();
			}*/

			$this->load->library('form_validation');
			$this->load->database();

			$this->form_validation->set_rules(
				'group',
				'Group',
				'required|integer'
			);

			$this->form_validation->set_rules(
				'semester',
				'Semester',
				'required|integer|in_list[1,2]'
			);

			$this->form_validation->set_rules(
				'day',
				'Day',
				'required|in_list[1,2,3,4,5]'
			);

			$this->form_validation->set_rules(
				'subject',
				'Subject',
				'required|integer'
			);

			$this->form_validation->set_rules(
				'start_time',
				'Start Time',
				'required|integer'
			);

			$this->form_validation->set_rules(
				'end_time',
				'End Time',
				'required|integer'
			);

			$this->form_validation->set_rules(
				'venues[]',
				'Venues',
				'required'
			);


			$this->form_validation->set_rules(
				'staff[]',
				'Staff',
				'required'
			);

			if($this->form_validation->run() == false){
				throw new Exception();
			}

			foreach($_POST['venues[]'] as $venue){
				if(!is_int($venue)) throw new Exception();
			}

			foreach($_POST['staff[]'] as $staff){
				if(!is_int($staff)) throw new Exception();
			}


			if($_POST['start_time'] >= $_POST['end_time']) throw new Exception();

			$this->load->model("Lecture_model");
			$lecture = $this->Lecture_model->get();
			$lecture->setGroupId($_POST['group']);
			$lecture->setSemester($_POST['semester']);
			$lecture->setDay($_POST['day']);
			$lecture->setSubjectId($_POST['subject']);
			$lecture->setStartTime($_POST['start_time']);
			$lecture->setEndTime($_POST['end_time']);
			$lecture->setVenues($_POST['venues']);
			$lecture->setStaff($_POST['staff']);

			if(!$lecture->save()) throw new Exception();

			$group = $_POST['group'];
			$semester = $_POST['semester'];
			redirect(base_url("time-table")."?group=$group&semester=$semester&success=true", 'location');
		}
		catch(Exception $ex){
			$group = $_POST['group'];
			$semester = $_POST['semester'];
			redirect(base_url("time-table")."?group=$group&semester=$semester&error=true", 'location');
		}


	}

}
