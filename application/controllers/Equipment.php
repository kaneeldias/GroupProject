<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipment extends CI_Controller {

	public function index(){
		$this->load->library('session');
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
		$data = [];
		$this->load->model("Equipment_model");
		$data['Items'] = $this->Equipment_model->getAllItems();

		$this->load->view('templates/header');
		$this->load->view('views/EquipmentView', $data);
		$this->load->view('templates/footer');
	}

    public function add()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $this->load->view("templates/header");
        $this->load->view("forms/addEquipment");
        $this->load->view("templates/footer");
    }

    public function edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data['id'] = $_GET['id'];
        $this->load->model("Lecturer_model");
        $data['Lec'] = $this->Equipment_model->getItemsById($data['id']);
        $this->load->view("templates/header");
        $this->load->view("forms/editEquipment", $data);
        $this->load->view("templates/footer");
    }

    public function delete(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $data['id'] = $_GET['id'];
            $this->load->model("Equipment_model");
            $data['Lec'] = $this->Equipment_model->deleteItemById($data['id']);
            redirect(base_url("equipment"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("equipment")."?error=true", 'location');
        }
    }

	public function process_add(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
		try {

			$this->load->library('form_validation');
			$this->load->database();

			$this->form_validation->set_rules(
				'id',
				'ID',
				'required|is_unique[equipment.eq_id]'
			);

			$this->form_validation->set_rules(
				'name',
				'Name',
				'required'
			);

			$this->form_validation->set_rules(
				'D',
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
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'code',
                'Code',
                'required'
            );

            $this->form_validation->set_rules(
                'name',
                'Name',
                'required'
            );

            $this->form_validation->set_rules(
                'discription',
                'Discription',
                'required'
            );

            if($this->form_validation->run() == false){
                throw new Exception();
            }

            $id = $_GET['id'];
            //$this->validate_edit();
            $code = $_POST['code'];
            $name = $_POST['name'];
            $info = $_POST['info'];


            $this->load->database();
            $this->db->set("code", $code);
            $this->db->set("name", $name);
            $this->db->set("info", $info);
            $this->db->where("eq_id", $_GET['id']);
            $this->db->update("equipment");

            redirect(base_url("equipment")."?success=true", 'location');

        }
        catch(Exception $e){
            $id = $_GET['id'];
            redirect(base_url("equipment/edit")."?error=true&id=$code", 'location');
        }

    }

}
