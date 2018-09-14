<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeTableController extends CI_Controller {

	public function index(){
		$this->load->library('session');
		$this->load->view("templates/header");
		$this->load->view("TimeTableView");
		$this->load->view("templates/footer");
	}

}
