<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

	public function add()
	{
		$this->load->library('session');
		$this->load->view('templates/header');
		$this->load->view('forms/addSubject');
		$this->load->view('templates/footer');
	}

    public function process_add(){
        try{
            $subjectId = $_POST['subjectId'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $degreeId = $_POST['degreeId'];
            $year = $_POST['year'];

            if(!isset($subjectId) || !isset($code) || !isset($name) || !isset($degreeId) || !isset($year)) throw new Exception();
            if($subjectId == "" || $code == "" || $name == "" || $degreeId == "" || $year == "") throw new Exception();

            $this->load->database();
            $this->db->set("subjectId", $subjectId);
            $this->db->set("code", $code);
            $this->db->set("name", $name);
            $this->db->set("degreeId", $degreeId);
            $this->db->set("year", $year);
            $this->db->insert("subject");

            redirect(base_url("add-subject")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("add-subject")."?error=true", 'location');
        }

    }
}
