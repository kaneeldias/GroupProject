<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rubricController extends CI_Controller {

    public function index(){
        $this->load->library('session');
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data = [];
        //$this->load->model("Subject_model");
       // $this->load->model("degree_model");
        $this->load->model("rubric_model");

        $rubrics = $this->rubric_model->getAllRubrics();
        $data['array'] = $rubrics;

        $this->load->view('templates/header');
        $this->load->view('views/rubricView', $data);
        $this->load->view('templates/footer');
    }

    public function add(){
        $this->load->library('session');
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data = [];
        $this->load->model("staff_model");
        $data['staff'] = $this->staff_model->getAllStaff();
        $this->load->model("subject_model");
        $data['subjects']=$this->subject_model->getAllSubjects();

        $this->load->view('templates/header');
        $this->load->view('forms/addRubrics', $data);
        $this->load->view('templates/footer');
    }


    public function edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data['id'] = $_GET['id'];
        $this->load->model("subject_model");
        $data['subject'] = $this->subject_model->getSubjectById($data['id']);
        $this->load->view("templates/header");
        $this->load->view("forms/editSubject", $data);
        $this->load->view("templates/footer");
    }


    public function delete(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
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

    private function  validate(){
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
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{

            //$this->validate();

            $code = $_POST['code'];
            $setter1 = $_POST['setter1'];
            $setter2 = $_POST['setter2'];
            $moderator = $_POST['moderator'];
            $semExam = $_POST['semExam'];
            $assesment = $_POST['assesment'];
            $examRubrics = $_POST['examRubrics'];


            $this->load->database();
            $this->db->set("subject_id", $code);
            $this->db->set("exam", $semExam);
            $this->db->set("assesments", $assesment);
            $this->db->set("rubric", $examRubrics);
            $this->db->set("setter1",$setter1);
            $this->db->set("setter2",$setter2);
            $this->db->set("moderator",$moderator);

            $this->db->insert("rubric");

            redirect(base_url("rubrics")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("subjects/add")."?error=true", 'location');
        }

    }

    public function process_edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
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

    }
}
