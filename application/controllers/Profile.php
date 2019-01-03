<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index(){
        $this->load->library("session");

        $this->load->model("profile_model");
        $data['Details'] = $this->profile_model->getAllDetails($this->session->userdata('user_id'));

        $this->load->library("google");
        $this->google->setUserId($this->session->userdata('user_id'));
        $client = $this->google->getClient();
        if($client == false){
            $data['calendar'] = false;
            $data['authUrl'] = $this->google->getAuthUrl();
        }
        else{
            $data['calendar'] = true;
            $service = new Google_Service_Calendar($client);
            $cal = $service->calendars->get('primary');
            $data['cal_email'] = $cal->id;
        }
        $this->load->model("Staff_model");
        /*if($this->session->userdata("type") == "staff"){
            $data['lecturers'] = $this->Staff_model->getAllStaff();
        }*/

        $this->load->model("CalendarInfo_model");
        $calendar = $this->CalendarInfo_model->getCalendarInfo($this->session->userdata('user_id'));
        $data['timetable_id'] = -1;
        if($calendar != false){
            $data['timetable_id'] = $calendar->getTimetableId();
            if($this->session->userdata("type") == "staff"){
                $data['cal_lec'] = $this->Staff_model->getStaffById($calendar->getTimeTableId());
            }
            if($this->session->userdata("type") == "student"){
                $this->load->model("Group_model");
                $data['cal_lec'] = $this->Group_model->getById($calendar->getTimeTableId());
            }
        }

        $this->load->view("templates/header");
        $this->load->view("Profile",$data);
        $this->load->view("templates/footer");
    }

    public function edit(){
        $this->load->library("session");

        if($this->session->userdata("type") == "staff"){
            $this->load->model("Staff_model");
            $data['lecturers'] = $this->Staff_model->getAllStaff();
        }

        if($this->session->userdata("type") == "student"){
            $this->load->model("Group_model");
            $data['groups'] = $this->Group_model->getAllGroups();
        }

        $this->load->model("CalendarInfo_model");
        $calendar = $this->CalendarInfo_model->getCalendarInfo($this->session->userdata('user_id'));
        $data['timetable_id'] = -1;
        if($calendar != false){
            $data['timetable_id'] = $calendar->getTimetableId();
        }

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
                'first_name',
                'First_name',
                'required'
            );

            $this->form_validation->set_rules(
                'last_name',
                'Last Name',
                'required'
            );

            $this->form_validation->set_rules(
                'email',
                'Email Address',
                'required|valid_email'
            );

            $this->form_validation->set_rules(
                'contact',
                'Contact No.',
                ''
            );

            if($this->session->userdata('type') == 'staff'){
                $this->form_validation->set_rules(
                    'lecturer',
                    'Staff',
                    'integer'
                );
            }

            if($this->form_validation->run() == false){
                echo validation_errors();
                exit();
                throw new Exception();
            }

            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $tp = $_POST['contact'];


            $this->load->database();
            $this->db->set("fname", $fname);
            $this->db->set("lname", $lname);
            $this->db->set("email", $email);
            $this->db->set("tp", $tp);
            $this->db->where("user_id", $this->session->userdata('user_id'));
            $this->db->update("user");

            if($this->session->userdata('type') == 'staff'){
                $id = $_POST['lecturer'];
            }

            if($this->session->userdata('type') == 'student'){
                $id = $_POST['group'];
            }

            if(isset($id)){
                $this->load->model("CalendarInfo_model");
                $calendar = $this->CalendarInfo_model->get();
                $calendar->setUserId($this->session->userdata("user_id"));
                if($this->session->userdata('type') == 'staff') $calendar->setType("staff");
                if($this->session->userdata('type') == 'student') $calendar->setType("student");
                $calendar->setTimetableId($id);
                $calendar->save();
            }


            redirect(base_url("profile")."?success=true", 'location');

        }
        catch(Exception $e){
            $id = $_GET['id'];
            redirect(base_url("profile/edit")."?error=true&id=$id", 'location');
        }

    }

}
