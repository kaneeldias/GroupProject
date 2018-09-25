<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentGroup extends CI_Controller {

    public function index(){
        $this->load->library('session');

        $data = [];
        $this->load->model("group_model");
        $data['groups'] = $this->group_model->getAllGroups();

        $this->load->view('templates/header');
        $this->load->view('views/StudentGroupsView', $data);
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
            $Degree = $_POST['Degree'];
            $Year = $_POST['Year'];
            $ParentGroup = $_POST['Parent Group'];
            $GroupName = $_POST['Group Name'];
            $DegreeID = 

            $this->load->database();
            $this->db->set("Degree", $Degree);
            $this->db->set("Year", $Year);
            $this->db->set("ParentGroup", $ParentGroup);
            $this->db->set("GroupName", $GroupName);
            $this->db->insert("StudentGroup");

            redirect(base_url("student_groups/add/process")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("student_groups/add/process")."?error=true", 'location');
        }
    }
}
