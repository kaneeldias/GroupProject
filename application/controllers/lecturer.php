<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lecturer extends CI_Controller {

	public function index(){
		$this->load->library('session');

		$data = [];
		$this->load->model("Lecturer_model");
		$data['Lecturers'] = $this->Lecturer_model->getAllLecturers();

		$this->load->view('templates/header');
		$this->load->view('views/LecturerView', $data);
		$this->load->view('templates/footer');
	}

    public function add()
    {
        $this->load->library("session");
        $this->load->view("templates/header");
        $this->load->view("forms/addLecturer");
        $this->load->view("templates/footer");
    }

    public function edit(){
        $this->load->library("session");
        $data['id'] = $_GET['id'];
        $this->load->model("Lecturer_model");
        $data['Lec'] = $this->Lecturer_model->getLecturersById($data['id']);
        $this->load->view("templates/header");
        $this->load->view("forms/editLecturer", $data);
        $this->load->view("templates/footer");
    }

    public function delete(){
        $this->load->library("session");
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

	public function process_add(){
		try {

			$this->load->library('form_validation');
			$this->load->database();

			$this->form_validation->set_rules(
				'id',
				'ID',
				'required|is_unique[academic_staff.id]'
			);

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

			if($this->form_validation->run() == false){
				throw new Exception();
			}

			$id = $_POST['id'];
			$name = $_POST['name'];
			$shortform = $_POST['shortform'];

			//validation

			$this->load->database();
			$this->db->set("id", $id);
			$this->db->set("name", $name);
			$this->db->set("short_name", $shortform);
			$this->db->insert("academic_staff");

			redirect(base_url("lecturer/add") . "?success=true", 'location');
		}
		catch(Exception $e){
			redirect(base_url("lecturer/add")."?error=true", 'location');
		}

	}
    public function process_edit(){
        try{
            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'id',
                'ID',
                'required'
            );

            $this->form_validation->set_rules(
                'name',
                'Name',
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
            $id = $_POST['id'];
            $name = $_POST['name'];
            $shortform = $_POST['shortform'];


            $this->load->database();
            $this->db->set("id", $id);
            $this->db->set("name", $name);
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
