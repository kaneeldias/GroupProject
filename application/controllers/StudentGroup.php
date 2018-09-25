<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

    public function index(){
        $this->load->library('session');

        $data = [];
        $this->load->model("Subject_model");
        $data['subjects'] = $this->StudentGroup_model->getAllGroups();

        $this->load->view('templates/header');
        $this->load->view('views/View', $data);
        $this->load->view('templates/footer');
    }

    public function add(){
        $this->load->library('session');

        $this->load->model("Degree_model");
        $data['degrees'] = $this->Degree_model->getAllDegrees();

        $this->load->view('templates/header');
        $this->load->view('forms/addSubject', $data);
        $this->load->view('templates/footer');
    }


    public function edit(){
        $this->load->library("session");
        $data['id'] = $_GET['id'];
        $this->load->model("subject_model");
        $data['subject'] = $this->subject_model->getSubjectById($data['id']);
        $this->load->view("templates/header");
        $this->load->view("forms/editSubject", $data);
        $this->load->view("templates/footer");
    }


    public function delete(){
        $this->load->library("session");
        try{
            $data['id'] = $_GET['id'];
            $this->load->model("subject_model");
            $data['subject'] = $this->subject_model->deleteSubjectById($data['id']);
            redirect(base_url("subjects"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("subjects")."?error=true", 'location');
        }
    }

    public  function  validate(){
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
            echo validation_errors();
            exit();
            //throw new Exception();
        }

    }

    public function process_add(){
        try{

            $this->validate();

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

            redirect(base_url("subjects")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("subjects/add")."?error=true", 'location');
        }

    }

    public function process_edit(){
        try{
            $id = $_GET['id'];
            $this->validate();
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
            $this->db->where("subject_id", $_GET['id']);
            $this->db->update("subject");



            redirect(base_url("subjects")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("subjects/edit")."?error=true&id=$id", 'location');
        }
		$this->load->view('templates/header');
		$this->load->view('forms/addStudentGroup', $data);
		$this->load->view('templates/footer');


	}
	public function process_add()
    {
        try{
            //$this->validate_add();
            $degree = $_POST['degree'];
            $year = $_POST['year'];
            $parentgroup = $_POST['parentgroup'];
            $groupname = $_POST['groupname'];


            $this->load->database();
            $this->db->set("degree_id", $degree);
            $this->db->set("year", $year);
            $this->db->set("parent_group", $parentgroup);
            $this->db->set("name", $groupname);

            $this->db->insert("student_group");

            redirect(base_url("student_groups")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("student_groups/add")."?error=true", 'location');
        }
    }
}
