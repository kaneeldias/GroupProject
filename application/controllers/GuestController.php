<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuestController extends CI_Controller {

	public function index(){
		$this->load->library("session");

		$this->load->database();
		$this->db->select("guest_id");
		$this->db->select("code");
		$this->db->select("name");
		$this->db->select("subject_id");
		$query = $this->db->get("guest_lecturers");
		$array = [];
		foreach($query->result() as $row){
			$a = [];
			$a['id'] = $row->guest_id;
			$a['code'] = $row->code;
			$a['name'] = $row->name;
			$a['subject'] = $row->subject_id;
			array_push($array, $a);
		}

		$data['array'] = $array;

		$this->load->view("templates/header");
		$this->load->view("guestView", $data);
		$this->load->view("templates/footer");
	}

	public function add(){
		$this->load->library("session");

		$this->load->model("subject_model");
		$subjects = $this->subject_model->getAllSubjects();

		$data['subjects'] = $subjects;

		$this->load->view("templates/header");
		$this->load->view("forms/addGuest", $data);
		$this->load->view("templates/footer");
	}

	public function add_process(){
		$code = $_POST['code'];
		$name = $_POST['name'];
		$subject = $_POST['subject'];

		$this->load->database();
		$this->db->set("code", $code);
		$this->db->set("name", $name);
		$this->db->set("subject_id", $subject);
		$this->db->insert("guest_lecturers");

	}

	public function edit(){
		$this->load->library("session");

		$this->load->model("subject_model");
		$subjects = $this->subject_model->getAllSubjects();

		$data['subjects'] = $subjects;

		$this->load->view("templates/header");
		$this->load->view("forms/editGuest", $data);
		$this->load->view("templates/footer");
	}



}
