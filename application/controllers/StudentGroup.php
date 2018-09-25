<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentGroup extends CI_Controller {


	public function add()
	{
		$this->load->library('session');

		$data = [];
		$this->load->model("Degree_model");
		$data['degrees'] = $this->Degree_model->getAllDegrees();

		$this->load->model("Group_model");
		$data['groups'] = $this->Group_model->getAllGroups();

		$this->load->view('templates/header');
		$this->load->view('forms/addStudentGroup', $data);
		$this->load->view('templates/footer');


	}
	public function process_add()
    {
        try{
            //$this->validate_add();
            $degree = $_POST['degree'];
            $year = $_POST['year'];
            $parentgroup = $_POST['parentgroup'];
            $groupname = $_POST['groupname'];


            $this->load->database();
            $this->db->set("degree_id", $degree);
            $this->db->set("year", $year);
            $this->db->set("parent_group", $parentgroup);
            $this->db->set("name", $groupname);

            $this->db->insert("student_group");

            redirect(base_url("student_groups")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("student_groups/add")."?error=true", 'location');
        }
    }
}
