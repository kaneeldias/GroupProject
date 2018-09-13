<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {

    public function submit()
    {
        $this->load->library("session");
        $this->load->view("templates/header");
        $this->load->view("forms/signUp");
        $this->load->view("templates/footer");
    }

}

