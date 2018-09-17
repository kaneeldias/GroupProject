<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

	public function add(){
        $this->load->library('session');

        $data = [];
        $this->load->model("Degree_model");
        $data['degrees'] = $this->Degree_model->getAllDegrees();

		$this->load->view('templates/header');
		$this->load->view('forms/addSubject', $data);
		$this->load->view('templates/footer');
	}

    public function process_add(){
        try{
            $semester = $_POST['semester'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $degreeId = $_POST['degree'];
            $year = $_POST['year'];

            if(!isset($semester) || !isset($code) || !isset($name) || !isset($degreeId) || !isset($year)) throw new Exception();
            if($semester == "" || $code == "" || $name == "" || $degreeId == "" || $year == "") throw new Exception();

            $this->load->database();
            $this->db->set("semester", $semester);
            $this->db->set("code", $code);
            $this->db->set("name", $name);
            $this->db->set("degree_id", $degreeId);
            $this->db->set("year", $year);
            $this->db->insert("subject");

            redirect(base_url("add-subject")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("add-subject")."?error=true", 'location');
        }

    }
}
