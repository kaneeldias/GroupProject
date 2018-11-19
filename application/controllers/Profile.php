<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index(){
        $this->load->library("session");

        $this->load->model("profile_model");
        $data['Details'] = $this->profile_model->getAllDetails($this->session->userdata('user_id'));

        $this->load->library("google");
        $client = $this->google->getClient();
        if($client == false){
            $data['calendar'] = false;
            $data['authUrl'] = $this->google->getAuthUrl();
        }
        else $data['calendar'] = true;
        $this->load->model("Staff_model");
        if($this->session->userdata("type") == "staff"){
            $data['lecturers'] = $this->Staff_model->getAllStaff();
        }

        $this->load->model("CalendarInfo_model");
        $calendar = $this->CalendarInfo_model->getCalendarInfo($this->session->userdata('user_id'));
        $data['timetable_id'] = -1;
        if($calendar != false){
            $data['timetable_id'] = $calendar->getTimetableId();
        }

        $this->load->view("templates/header");
        $this->load->view("Profile",$data);
        $this->load->view("templates/footer");
    }

    public function edit(){
        $this->load->library("session");

        $this->load->model("profile_model");
        $data['Details'] = $this->profile_model->getAllDetails($this->session->userdata('user_id'));
        $this->load->view("templates/header");
        $this->load->view("forms/editProfile",$data);
        $this->load->view("templates/footer");
    }

    public function process_edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged")){
            echo "unauthorized access";
            return;
        }
        try{
            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'id',
                'ID',
                'required'
            );

            $this->form_validation->set_rules(
                'name',
                'Name',
                'required'
            );

            $this->form_validation->set_rules(
                'shortform',
                'Short Form',
                'required|min_length[3]'
            );

            if($this->form_validation->run() == false){
                throw new Exception();
            }

            $user_id = $_GET['id'];
            //$this->validate_edit();
            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $tp = $_POST['email'];



            $this->load->database();
            $this->db->set("user_id", $id);
            $this->db->set("fname", $fname);
            $this->db->set("lname", $lname);
            $this->db->set("email", $email);
            $this->db->set("tp", $tp);
            $this->db->where("user_id", $_GET['id']);
            $this->db->update("user");

            redirect(base_url("profile")."?success=true", 'location');

        }
        catch(Exception $e){
            $id = $_GET['id'];
            redirect(base_url("profile/edit")."?error=true&id=$id", 'location');
        }

    }

}
