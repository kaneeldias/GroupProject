<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lecturer extends CI_Controller {

    //Loads all the staff members in the database and displays them
	public function index(){
		$this->load->library('session');

        //Check if user is logged in
        if(!$this->session->userdata("logged")){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
		$data = [];
		$this->load->model("Lecturer_model");
		$data['Lecturers'] = $this->Lecturer_model->getAllLecturers();


        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Lecturers" => base_url("lecturer")
        );

        $this->load->view("templates/header", $path);
        $this->load->view('views/LecturerView', $data);
		$this->load->view('templates/footer');
	}

    //Form to add a new lecturer
    public function add()
    {
        $this->load->library("session");

        //Check is user is logged in as an admin
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Lecturers" => base_url("lecturer"),
            "Add Lecturer" => base_url("lecturer/add")
        );

        $this->load->view("templates/header", $path);
        $this->load->view("forms/addLecturer");
        $this->load->view("templates/footer");
    }

    //Loads form to edit a lecturer
    public function edit(){
        $this->load->library("session");

        //Check if user is logged in as an admin
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $data['id'] = $_GET['id'];

        //Get details of lecturer
        $this->load->model("Lecturer_model");
        $data['Lec'] = $this->Lecturer_model->getLecturersById($data['id']);

        $this->load->view("templates/header");
        $this->load->view("forms/editLecturer", $data);
        $this->load->view("templates/footer");
    }

    //Delete a lecturer
    public function delete(){
        $this->load->library("session");

        //Check if user is logged in as an admin
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $data['id'] = $_GET['id'];
            $this->load->model("Lecturer_model");
            $data['Lec'] = $this->Lecturer_model->deleteLecturerById($data['id']);
            redirect(base_url("lecturer"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("lecturer")."?error=true", 'location');
        }
    }

    //Validate and insert a lecturer to the database
	public function process_add(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
		try {

			$this->load->library('form_validation');
			$this->load->database();

			/*$this->form_validation->set_rules(
				'id',
				'ID',
				'required|is_unique[academic_staff.id]'
			);*/

			$this->form_validation->set_rules(
				'name',
				'Name',
				'required'
			);

			$this->form_validation->set_rules(
				'shortform',
				'Short Form',
				'required|is_unique[academic_staff.short_name]|min_length[3]'
			);

            $this->form_validation->set_rules(
                'emailaddress',
                'EmailAddress',
                'required|valid_email'
            );

			if($this->form_validation->run() == false){
				throw new Exception();
			}

			//$id = $_POST['id'];
			$name = $_POST['name'];
			$shortform = $_POST['shortform'];
            $emailaddress = $_POST['emailaddress'];
			//validation

			$this->load->database();
			//$this->db->set("id", $id);
			$this->db->set("name", $name);
			$this->db->set("short_name", $shortform);
            $this->db->set("email_address",$emailaddress);
			$this->db->insert("academic_staff");

			redirect(base_url("lecturer/add") . "?success=true", 'location');
		}
		catch(Exception $e){
			redirect(base_url("lecturer/add")."?error=true", 'location');
		}

	}

    //validate and update a lecturer in the database
    public function process_edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $this->load->library('form_validation');
            $this->load->database();

            /*$this->form_validation->set_rules(
                'id',
                'ID',
                'required'
            );*/

            $this->form_validation->set_rules(
                'name',
                'Name',
                'required'
            );

            $this->form_validation->set_rules(
                'emailaddress',
                'EmailAddress',
                'required'
            );

            $this->form_validation->set_rules(
                'shortform',
                'Short Form',
                'required|min_length[3]'
            );

            if($this->form_validation->run() == false){
                throw new Exception();
            }

            $id = $_GET['id'];
            //$this->validate_edit();
            //$id = $_POST['id'];
            $name = $_POST['name'];
            $shortform = $_POST['shortform'];
            $emailaddress=$_POST['emailaddress'];

            $this->load->database();
            //$this->db->set("id", $id);
            $this->db->set("name", $name);
            $this->db->set("email_address", $emailaddress);
            $this->db->set("short_name", $shortform);
            $this->db->where("staff_id", $_GET['id']);
            $this->db->update("academic_staff");

            redirect(base_url("lecturer")."?success=true", 'location');

        }
        catch(Exception $e){
            $id = $_GET['id'];
            redirect(base_url("lecturer/edit")."?error=true&id=$id", 'location');
        }

    }

}
