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
            $Degree = $_POST['Degree'];
            $Year = $_POST['Year'];
            $ParentGroup = $_POST['Parent Group'];
            $GroupName = $_POST['Group Name'];
            $DegreeID = 

            $this->load->database();
            $this->db->set("Degree", $Degree);
            $this->db->set("Year", $Year);
            $this->db->set("ParentGroup", $ParentGroup);
            $this->db->set("GroupName", $GroupName);
            $this->db->insert("StudentGroup");

            redirect(base_url("student_groups/add/process")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("student_groups/add/process")."?error=true", 'location');
        }
    }
}
