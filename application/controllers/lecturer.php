<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lecturer extends CI_Controller {

	public function add()
	{
	    $this->load->library("session");
	    $this->load->view("templates/header");
        $this->load->view("forms/addLecturer");
        $this->load->view("templates/footer");
	}

}
