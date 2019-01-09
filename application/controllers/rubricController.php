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
            'setter1',
            'Setter1',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'moderator',
            'Moderator',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'semExam',
            'SemExam',
            'required|integer|in_list[0,10,20,30,40,50,60,70,80,90,100]'
        );

        $this->form_validation->set_rules(
            'assesment',
            'Assesment',
            'required|integer|in_list[0,10,20,30,40,50,60,70,80,90,100]'
        );
        $this->form_validation->set_rules(
            'examRubrics',
            'ExamRubrics',
            'required'
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
            $this->validate();
            $code = $_POST['code'];
            $setter1 = $_POST['setter1'];
            if(!isset($_POST['setter2'])){
                $setter2 = "";
            }
            else{
                $setter2 = $_POST['setter2'];
            }
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
    public function generate(){
        $this->load->library('session');
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data = [];
        $this->load->model("degree_model");
        $data['degrees'] = $this->degree_model->getAllDegrees();


        $this->load->view('templates/header');
        $this->load->view('forms/generateRubrics', $data);
        $this->load->view('templates/footer');
    }

    public function process_generate(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{

            $degree = $_POST['degree'];
            $semester = $_POST['semester'];
            $year = $_POST['year'];

            $this->load->database();
            $this->db->select("subject_id");
            $this->db->from("subject");
            $this->db->where("degree_id", $degree);
            $this->db->where("year", $year);
            $this->db->where("semester", $semester);
            $query = $this->db->get();

            $this->load->model("rubric_model");

            $data['array'] = [];

            foreach($query->result() as $row){
                $subject_id = $row->subject_id;
                $rubric = $this->rubric_model->getRubricBySubjectId($subject_id);

                array_push($data['array'], $rubric);
            }

            $this->load->view('templates/header');
            $this->load->view('views/rubricGeneratedView', $data);
            $this->load->view('templates/footer');
        }
        catch(Exception $e){
            redirect(base_url("rubrics")."?error=true", 'location');
        }

    }
}
