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
        $data['subjects'] = $this->subject_model->getAllSubjects();
        $this->load->model("staff_model");
        $data['staff'] = $this->staff_model->getAllStaff();
        $this->load->model("rubric_model");
        $data['rubric'] = $this->rubric_model->getRubricById($data['id']);
        $this->load->view("templates/header");
        $this->load->view("forms/editRubrics", $data);
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
            $this->load->model("rubric_model");
            $data['rubric'] = $this->rubric_model->deleteRubricById($data['id']);
            redirect(base_url("rubrics"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("rubrics")."?error=true", 'location');
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
            echo validation_errors();

            if($this->form_validation->run() == false){
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

            $this->db->insert(rubric);

            redirect(base_url("rubrics")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("rubrics/edit")."?error=true", 'location');
        }

    }

    public function process_edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{

            $id = $_POST['id'];
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
            $this->db->where("rubric_id", $id);
            $this->db->update("rubric");

            redirect(base_url("rubrics")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("rubrics/edit")."?error=true&id=$id", 'location');
        }

    }
}
