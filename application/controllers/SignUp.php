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

    public function process_add(){
        try{
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->load->database();
            $this->db->set("fname",$fname);
            $this->db->set("lname",$lname);
            $this->db->set("email",$email);
            $this->db->set("password",$password);
            $this->db->insert("user");

            redirect(base_url("signUp")."?success=true",'location');

        }catch(Exeption $e){
            redirect(base_url("signUp")."?error=true",'location');
        }
    }
}

