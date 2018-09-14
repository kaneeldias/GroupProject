<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lecturer extends CI_Controller {

	public function add()
	{
	    $this->load->library("session");
	    $this->load->view("templates/header");
        $this->load->view("forms/addLecturer");
        $this->load->view("templates/footer");
	}

	public function process_add(){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$shortform = $_POST['shortform'];

		//validation

		$this->load->database();
		$this->db->set("id", $id);
		$this->db->set("name", $name);
		$this->db->set("short_name", $shortform);
		$this->db->insert("academic_staff");
	}

}
