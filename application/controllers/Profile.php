<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index(){
        $this->load->library("session");

        $this->load->model("profile_model");
        $data['Details'] = $this->profile_model->getAllDetails($this->session->userdata('user_id'));
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
}
