<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

    public function index(){
        $this->load->library('session');

        $data = [];
        $this->load->model("Degree_model");
        $data['degrees'] = $this->Degree_model->getAllDegrees();

        $this->load->view('templates/header');
        $this->load->view('SubjectsView', $data);
        $this->load->view('templates/footer');
    }

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

            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'code',
                'Code',
                'required|is_unique[subject.code]'
            );

            $this->form_validation->set_rules(
                'name',
                'Name',
                'required'
            );

            $this->form_validation->set_rules(
                'degree',
                'Degree',
                'required|integer'
            );

            $this->form_validation->set_rules(
                'year',
                'Year',
                'required|integer|in_list[1,2,3,4]'
            );

            $this->form_validation->set_rules(
                'semester',
                'Semester',
                'required|integer|in_list[1,2]'
            );

            if($this->form_validation->run() == false){
                throw new Exception();
            }

            $semester = $_POST['semester'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $degreeId = $_POST['degree'];
            $year = $_POST['year'];

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
