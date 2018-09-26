<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function admin()
	{
		$this->load->library("session");
		$this->load->view("templates/header");
		$this->load->view("Dashboard");
		$this->load->view("templates/footer");
	}

    public function student()
    {
        $this->load->library("session");
        $this->load->view("templates/header");
        $this->load->view("Dashboard_Student");
        $this->load->view("templates/footer");
    }

    public function lecturer()
    {
        $this->load->library("session");
        $this->load->view("templates/header");
        $this->load->view("Dashboard_Lecturer");
        $this->load->view("templates/footer");
    }

    public function outsider()
    {
        $this->load->library("session");
        $this->load->view("templates/header");
        $this->load->view("Dashboard_Outsider");
        $this->load->view("templates/footer");
    }

}
