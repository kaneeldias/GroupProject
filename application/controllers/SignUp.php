<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {

    public function index()
    {
        $this->load->library("session");
        $this->load->view("templates/header");
        $this->load->view("forms/signUp");
        $this->load->view("templates/footer");
    }

    public function process_add(){
        try{
            /*if( !isset($_POST['fname']) ||
                !isset($_POST['lname']) ||
                !isset($_POST['type']) ||
                !isset($_POST['email']) ||
                !isset($_POST['password']) ||
                !isset($_POST['cpassword'])
            )throw new Exception();



            if( $fname == "" ||
                $lname == "" ||
                $password == "" ||
                $cpassword == "" ||
                $type == ""
            )throw new Exception();*/

            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'fname',
                'First Name',
                'required'
            );

            $this->form_validation->set_rules(
                'lname',
                'Last Name',
                'required'
            );

            $this->form_validation->set_rules(
                'email',
                'Email Address',
                'required|is_unique[user.email]|valid_email',
                array(
                    'is_unique' => "Email address is already registered."
                )
            );

            $this->form_validation->set_rules(
                'type',
                'Type',
                array(
                    'required',
                    function($type){
                        return ($type == "admin" || $type == "staff" || $type == "student");
                    }
                )
            );

            $this->form_validation->set_rules(
                'password',
                'Password',
                'required'
            );

            $this->form_validation->set_rules(
                'cpassword',
                'Confirm Password',
                'required|matches[password]'
            );


            if($this->form_validation->run() == false){
                throw new Exception();
            }

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $type = $_POST['type'];

            $this->load->database();
            $this->db->set("fname",$fname);
            $this->db->set("lname",$lname);
            $this->db->set("email",$email);
            $this->db->set("password",$password);
            $this->db->set("type", $type);
            if(!$this->db->insert("user")) throw new Exception();

            redirect(base_url("signUp")."?success=true",'location');

        }catch(Exception $e){
            redirect(base_url("signUp")."?error=true",'location');
        }
    }
}

