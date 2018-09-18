<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->load->library("session");
		$this->load->view("templates/header");
		$this->load->view("Dashboard");
		$this->load->view("templates/footer");
	}

}
