<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LectureHall extends CI_Controller {

	public function index(){
		$this->load->library("session");

		$data = [];
		$this->load->model("Venue_model");
		$data['venues'] = $this->Venue_model->getAllVenues();
		$this->config->load("globals");
		$data['current_semester'] = $this->config->item("current_semester");

		$this->load->view("templates/header");
		$this->load->view("views/LectureHallsView", $data);
		$this->load->view("templates/footer");
	}

	public function add()
	{
		$this->load->library("session");
		$this->load->view("templates/header");
		$this->load->view("forms/addLectureHall");
		$this->load->view("templates/footer");
	}

	public function edit(){
		$this->load->library("session");
		$data['id'] = $_GET['id'];
		$this->load->model("Venue_model");
		$data['venue'] = $this->Venue_model->getVenueById($data['id']);
		$this->load->view("templates/header");
		$this->load->view("forms/editLectureHall", $data);
		$this->load->view("templates/footer");
	}

	public function delete(){
		$this->load->library("session");
		try{
			$data['id'] = $_GET['id'];
			$this->load->model("Venue_model");
			$data['venue'] = $this->Venue_model->deleteVenueById($data['id']);
			redirect(base_url("lecture-halls"), 'location');
		}
		catch(Exception $ex){
			redirect(base_url("lecture-halls")."?error=true", 'location');
		}
	}

	public function validate_edit(){
		$this->load->library('form_validation');
		$this->load->database();

		$this->form_validation->set_rules(
			'code',
			'Code',
			'required'
		);

		$this->form_validation->set_rules(
			'name',
			'Name',
			'required'
		);

		$this->form_validation->set_rules(
			'type',
			'Type',
			'required|in_list[lecture_hall,lab,other]'
		);

		$this->form_validation->set_rules(
			'capacity',
			'Capacity',
			'required|integer'
		);

		if($this->form_validation->run() == false){
			echo validation_errors();
			exit();
			throw new Exception();
		}
	}

	public function validate_add(){
		$this->load->library('form_validation');
		$this->load->database();

		$this->form_validation->set_rules(
			'code',
			'Code',
			'required|is_unique[lecture_hall.code]'
		);

		$this->form_validation->set_rules(
			'name',
			'Name',
			'required'
		);

		$this->form_validation->set_rules(
			'type',
			'Type',
			'required|in_list[lecture_hall,lab,other]'
		);

		$this->form_validation->set_rules(
			'capacity',
			'Capacity',
			'required|integer'
		);

		if($this->form_validation->run() == false){
			echo validation_errors();
			exit();
			throw new Exception();
		}
	}

	public function process_add(){
		try{
			$this->validat_add();
			$code = $_POST['code'];
			$name = $_POST['name'];
			$type = $_POST['type'];
			$capacity = $_POST['capacity'];


			$this->load->database();
			$this->db->set("code", $code);
			$this->db->set("name", $name);
			$this->db->set("type", $type);
			$this->db->set("capacity", $capacity);
			$this->db->insert("lecture_hall");

			redirect(base_url("lecture-halls")."?success=true", 'location');

		}
		catch(Exception $e){
			redirect(base_url("lecture-halls/add")."?error=true", 'location');
		}

	}

	public function process_edit(){
		try{
			$id = $_GET['id'];
			$this->validate_edit();
			$code = $_POST['code'];
			$name = $_POST['name'];
			$type = $_POST['type'];
			$capacity = $_POST['capacity'];


			$this->load->database();
			$this->db->set("code", $code);
			$this->db->set("name", $name);
			$this->db->set("type", $type);
			$this->db->set("capacity", $capacity);
			$this->db->where("hall_id", $_GET['id']);
			$this->db->update("lecture_hall");

			redirect(base_url("lecture-halls")."?success=true", 'location');

		}
		catch(Exception $e){
			redirect(base_url("lecture-halls/edit")."?error=true&id=$id", 'location');
		}

	}

}
