<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index(){
        $this->load->library("session");
        if(!$this->session->userdata("logged")){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $data = [];
        $this->load->model("Notes_model");
        $data['notes'] = $this->Notes_model->getNotes($this->session->userdata("user_id"));

        if($this->session->userdata("type") == "admin") $this->admin();



        $this->load->view("templates/header");

        if($this->session->userdata("type") == "student") $this->load->view("Dashboard_Student");
        if($this->session->userdata("type") == "lecturer") $this->load->view("Dashboard_Lecturer");
        if($this->session->userdata("type") == "staff") $this->load->view("Dashboard_Lecturer");
        if($this->session->userdata("type") == "outsider") $this->load->view("Dashboard_outsider");
        $this->load->view("templates/footer");

    }

	private function admin()
    {
		$this->load->library("session");

        try{
            $this->load->library('session');


            $data = [];

            $group_id = 3;
            $this->load->model("Group_model");
            $group = $this->Group_model->getById($group_id);
            $data['group']= $group;

            $data['semester'] = 1;
            $data['day'] = $day = $day_number = date('N', strtotime(date('Y-m-d h:i:s')));

            $groups = [];
            $groups['CS1'] = 5;
            $groups['IS1'] = 11;
            $groups['CS2'] = 7;
            $groups['IS2'] = 12;
            $groups['CS3'] = 8;
            $groups['IS3'] = 13;
            $groups['CS4'] = 9;
            $groups['IS4'] = 14;
            $data['groups'] = $groups;


            $this->load->model("Lecture_model");
            $data['lectures'] = [];
            foreach($groups as $key => $value){
                for ($j = 8; $j <= 17; $j++) {
                    $data['lectures'][$key][$j] = [];
                }
            }
            foreach($groups as $key => $value){
                foreach($this->Group_model->getRelatedGroups($value) as $group){
                    //var_dump($this->Lecture_model->getLectures($group->getGroupId(), $_GET['semester']));
                    $l = $this->Lecture_model->getLecturesForDay($group->getGroupId(), $data['semester'], $day);
                    for($i = $day; $i <= $day; $i++){
                        if($day == 6 || $day == 7) break;
                        for($j = 8; $j <= 17; $j++){
                            foreach($l[$i][$j] as $lo){
                            } //array_push($data['lectures'][$key][$j], $lo);
                        }
                    }
                }
            }


        }
        catch(Exception $ex){
            $data['heading'] = "404 Error";
            $data['message'] = "404 Error";
            $this->load->view("errors/generate_error", $data);
            return;
        }

		$this->load->view("Dashboard", $data);
	}

    public function student()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("student") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $this->load->view("templates/header");
        $this->load->view("Dashboard_Student");
        $this->load->view("templates/footer");
    }

    public function lecturer()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("lecturer") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $this->load->view("templates/header");
        $this->load->view("Dashboard_Lecturer");
        $this->load->view("templates/footer");
    }

    public function outsider()
    {

        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("outsider") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $this->load->view("templates/header");
        $this->load->view("Dashboard_Outsider");
        $this->load->view("templates/footer");
    }

}
