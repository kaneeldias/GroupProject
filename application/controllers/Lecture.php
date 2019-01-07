<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lecture extends CI_Controller {

	public function add()
	{
		$this->load->library("session");
		if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
			$this->load->view("templates/header");
			$this->load->view("errors/unauthorized_access");
			$this->load->view("templates/footer");
			return;
		}
		$this->load->view("templates/header");
		$this->load->view("forms/addLecture");
		$this->load->view("templates/footer");
	}

	public function process(){
		$this->load->library("session");
		if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
			echo "unauthorized access";
			return;
		}
		try{
			$this->load->library("session");

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
				'required'
			);

			$this->form_validation->set_rules(
				'subject',
				'Subject',
				'required|integer'
			);

			$this->form_validation->set_rules(
				'start_time',
				'Start Time',
				'required'
			);

			$this->form_validation->set_rules(
				'end_time',
				'End Time',
				'required'
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

			//if($_POST['start_time'] >= $_POST['end_time']) throw new Exception();

			$days = explode(",", $_POST['day']);
			$start_times = explode(",", $_POST['start_time']);

			$error = false;
			$warning = false;
			$error_messages = [];
			$this->load->model("Venue_model");
			foreach($_POST['venues'] as $venue){
				for($i = 0; $i < sizeof($days); $i++){
					if(!$this->Venue_model->checkConflict($venue, $days[$i], $start_times[$i])){
						$error = true;
						$message = $this->Venue_model->getVenueById($venue)->getName()." is not available during this time slot.";
						array_push($error_messages, $message);
					}
				}
			}

			$this->load->model("Staff_model");
			foreach($_POST['staff'] as $staff){
				for($i = 0; $i < sizeof($days); $i++){
					if(!$this->Staff_model->checkConflict($staff, $days[$i], $start_times[$i])) {
						$warning = true;
						$message = "Staff member " . $this->Staff_model->getStaffById($staff)->getName() . " has another lecture during this time slot.";
						array_push($error_messages, $message);
					}
				}
			}

			$this->load->model("Group_model");
			for($i = 0; $i < sizeof($days); $i++){
				if(!$this->Group_model->checkConflict($_POST['group'], $days[$i], $start_times[$i])){
					$error = true;
					$message = "Student group " . $this->Group_model->getById($_POST['group'])->getName()." has another lecture during this time slot.";
					array_push($error_messages, $message);
				}
			}

			$data['error'] = $error;
			$data['warning'] = $warning;


			if($error || $warning && !isset($_GET['ignore_warnings'])){
				$this->load->model("Group_model");
				$data['group'] = $this->Group_model->getById($_POST['group']);
				$data['semester'] = $_POST['semester'];
				$data['original_group'] = $_POST['original_group'];
				$data['day'] = $_POST['day'];
				$data['type'] = $_POST['type'];
				$this->load->model("Subject_model");
				$data['subject'] = $this->Subject_model->getSubjectById($_POST['subject']);
				$data['start_time'] = $_POST['start_time'];
				$data['end_time'] = $_POST['end_time'];
				$data['venues'] = [];
				$this->load->model("Venue_model");
				foreach($_POST['venues'] as $venue){
					array_push($data['venues'], $this->Venue_model->getVenueById($venue));
				}
				$data['staff'] = [];
				$this->load->model("Staff_model");
				foreach($_POST['staff'] as $staff){
					array_push($data['staff'], $this->Staff_model->getStaffById($staff));
				}
				$data['error_messages'] = $error_messages;
				$this->load->view("templates/header");
				$this->load->view("errors/conflicts", $data);
				$this->load->view("templates/footer");
				return;
			}
			for($i = 0; $i < sizeof($days); $i++){
				$this->load->model("Lecture_model");
				$lecture = $this->Lecture_model->get();
				$lecture->setGroupId($_POST['group']);
				$lecture->setSemester($_POST['semester']);
				$lecture->setDay($days[$i]);
				$lecture->setSubjectId($_POST['subject']);
				$lecture->setStartTime($start_times[$i]);
				$lecture->setEndTime($start_times[$i]+1);
				$lecture->setVenues($_POST['venues']);
				$lecture->setStaff($_POST['staff']);
				if(!$lecture->save()) throw new Exception();
			}
			$group = $_POST['group'];
			$original_group = $_POST['original_group'];
			$semester = $_POST['semester'];
			$this->session->set_flashdata("success", true);
			$this->session->set_flashdata("message", "Lecture has been added to the time table.");
			redirect(base_url("time-table/group")."?group=$original_group&semester=$semester", 'location');
		}
		catch(Exception $ex){
			$original_group = $_POST['original_group'];
			$semester = $_POST['semester'];
			$this->session->set_flashdata("success", true);
			$this->session->set_flashdata("message", "There was an error with your form.");
			redirect(base_url("time-table/group")."?group=$original_group&semester=$semester", 'location');
		}


	}

	public function delete(){
		$id = $_GET['lecture_id'];
		$this->load->model("Lecture_model");
		$this->Lecture_model->delete($id);
	}

}
