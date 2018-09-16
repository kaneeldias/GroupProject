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

}
