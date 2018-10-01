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

        $this->load->model("Notes_model");
        $data['notes'] = $this->Notes_model->getNotes($this->session->userdata("user_id"));

        $this->load->view("templates/header");
        if($this->session->userdata("type") == "admin") $this->load->view("Dashboard", $data);
        if($this->session->userdata("type") == "student") $this->load->view("Dashboard_Student");
        if($this->session->userdata("type") == "lecturer") $this->load->view("Dashboard_Lecturer");
        if($this->session->userdata("type") == "staff") $this->load->view("Dashboard_Lecturer");
        if($this->session->userdata("type") == "outsider") $this->load->view("Dashboard_outsider");
        $this->load->view("templates/footer");

    }

	public function admin()
    {
		$this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
		$this->load->view("templates/header");
		$this->load->view("Dashboard");
		$this->load->view("templates/footer");
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
