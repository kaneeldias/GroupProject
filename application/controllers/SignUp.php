<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {

    public function index()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Register User" => base_url("signUp")
        );


        $this->load->view("templates/header", $path);        $this->load->view("forms/signUp");
        $this->load->view("templates/footer");
    }

    public function bulk()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Register User" => base_url("signUp"),
            "Bulk Registration" => base_url("signUp/bulk")
        );
        $this->load->view("templates/header", $path);
        $this->load->view("forms/signUpBulk");
        $this->load->view("templates/footer");
    }

    public function process_bulk()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $config['upload_path']          = "./assets/files/uploads";
        $config['allowed_types']        = 'csv';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload');
        $this->upload->initialize($config);

        try{
            if ( ! $this->upload->do_upload('file'))
            {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                throw new Exception();
                //$this->load->view('upload_form', $error);
            }
            else
            {
                //var_dump($this->upload->data());
                $file = fopen($this->upload->data("full_path"),"r");
                $line = fgetcsv($file);
                if($line[0] != "First Name") throw new Exception();
                if($line[1] != "Last Name") throw new Exception();
                if($line[2] != "Email") throw new Exception();
                if($line[3] != "Type (admin, staff, student)") throw new Exception();
                if($line[4] != "Password") throw new Exception();

                $row = 0;
                $error = false;
                $messages = "";
                while(!feof($file)) {
                    $row++;
                    $line = fgetcsv($file);
                    $fname = $line[0];
                    $lname = $line[1];
                    $email = $line[2];
                    $type = $line[3];
                    $password = $line[4];

                    if($line[0] == "") continue;

                    $_POST['fname'] = $line[0];
                    $_POST['lname'] = $line[1];
                    $_POST['email'] = $line[2];
                    $_POST['type'] = $line[3];
                    $_POST['password'] = $line[4];
                    $_POST['cpassword'] = $line[4];
                    if($this->validate_add()){
                        $this->load->database();
                        $this->db->set("fname",$fname);
                        $this->db->set("lname",$lname);
                        $this->db->set("email",$email);
                        $this->db->set("password",$password);
                        $this->db->set("type", $type);
                        $this->db->insert("user");
                    }
                    else{
                        $error = true;
                        $messages .= "Error inserting row #$row</br>";
                    }
                }


                if($error){
                    $this->session->set_flashdata('success', false);
                    $this->session->set_flashdata('message', $messages);
                }
                else{
                    $this->session->set_flashdata('success', true);
                    $this->session->set_flashdata('message', ($row-1)." users registered successfully");
                }
                redirect(base_url("signUp/bulk"),'location');

            }
        }
        catch(Exception $exception){
            $this->session->set_flashdata('success', false);
            $this->session->set_flashdata('message', 'Invalid template');
            redirect(base_url("signUp/bulk"),'location');
        }

    }

    public function process_add(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
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
                        return ($type == "admin" || $type == "staff" || $type == "student"||$type=="outsider");
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

            $this->session->set_flashdata('success', 'true');
            redirect(base_url("signUp"),'location');

        }catch(Exception $e){
            $this->session->set_flashdata('error', 'true');
            redirect(base_url("signUp"),'location');
        }
    }

    public function validate_add(){
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
                    return ($type == "admin" || $type == "staff" || $type == "student" ||$type=="outsider");
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
            return false;
        }
        return true;
    }
}

