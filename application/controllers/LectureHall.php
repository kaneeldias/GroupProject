<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LectureHall extends CI_Controller {

	public function add()
	{
		$this->load->library("session");
		$this->load->view("templates/header");
		$this->load->view("forms/addLectureHall");
		$this->load->view("templates/footer");
	}
    public function InsertLectureHall(){
        try{
            $code = $_POST['code'];
            $name = $_POST['name'];
            $type = $_POST['type'];
            $capacity = $_POST['capacity'];

            $this->load->database();
            $this->db->set("code",$code);
            $this->db->set("name",$name);
            $this->db->set("type",$type);
            $this->db->set("capacity",$capacity);
            $this->db->insert("lecture_hall");

            redirect(base_url("add-lecture-hall")."?success=true",'location');

        }catch(Exeption $e){
            redirect(base_url("add-lecture-hall")."?error=true",'location');
        }
    }

	public function process_add(){
		try{

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
				throw new Exception();
			}


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

			redirect(base_url("add-lecture-hall")."?success=true", 'location');

		}
		catch(Exception $e){
			redirect(base_url("add-lecture-hall")."?error=true", 'location');
		}

	}

}
