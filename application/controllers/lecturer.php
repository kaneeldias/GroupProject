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
		try {

			$this->load->library('form_validation');
			$this->load->database();

			$this->form_validation->set_rules(
				'id',
				'ID',
				'required|is_unique[academic_staff.id]'
			);

			$this->form_validation->set_rules(
				'name',
				'Name',
				'required'
			);

			$this->form_validation->set_rules(
				'shortform',
				'Short Form',
				'required|is_unique[academic_staff.short_name]|min_length[3]'
			);

			if($this->form_validation->run() == false){
				throw new Exception();
			}

			$id = $_POST['id'];
			$name = $_POST['name'];
			$shortform = $_POST['shortform'];

			//validation

			$this->load->database();
			$this->db->set("id", $id);
			$this->db->set("name", $name);
			$this->db->set("short_name", $shortform);
			$this->db->insert("academic_staff");

			redirect(base_url("add-lecturer") . "?success=true", 'location');
		}
		catch(Exception $e){
			redirect(base_url("add-lecturer")."?error=true", 'location');
		}
	}

}
