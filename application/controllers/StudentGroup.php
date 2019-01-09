<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentGroup extends CI_Controller {

    public function index(){
        $this->load->library('session');
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data = [];
        $this->load->model("group_model");
        $data['groups'] = [];
        $this->load->model("degree_model");
        //Load all student groups in the database
        foreach($this->group_model->getAllGroups() as $group){
            $g = [];
            $g['group'] = $group;
            //get degree id from the student-group table and load the name of the degree from the degree table
            $g['degree'] = $this->degree_model->getById($group->getDegreeId());
            //get parent id of the from the student-group table and load the name of the group from the student_group table
            $g['parent'] = $this->group_model->getById($group->getParentGroup());
            array_push($data['groups'], $g);
        }

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Student Groups" => base_url("student-groups")
        );
        $this->load->view("templates/header", $path);
        $this->load->view('views/StudentGroupsView', $data);
        $this->load->view('templates/footer');
    }

    public function add(){
        $this->load->library('session');
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $this->load->model("Degree_model");
        $data['degrees'] = $this->Degree_model->getAllDegrees();

        $this->load->model("group_model");
        $data['groups'] = $this->group_model->getAllGroups();

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Student Groups" => base_url("student-groups"),
            "Add Group" => base_url("student-groups/add")
        );
        $this->load->view("templates/header", $path);
        $this->load->view('forms/addStudentGroup', $data);
        $this->load->view('templates/footer');
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


        $this->load->model("Degree_model");
        $data['degrees'] = $this->Degree_model->getAllDegrees();

        $this->load->model("group_model");
        $data['groups'] = $this->group_model->getAllGroups();
        $data['group'] = $this->group_model->getById($data['id']);

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Student Groups" => base_url("student-groups"),
            "Edit Group" => "#"
        );
        $this->load->view("templates/header", $path);
        $this->load->view("forms/editStudentGroup", $data);
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
            $this->load->model("group_model");
            $data['groups'] = $this->group_model->deleteGroupById($data['id']);
            redirect(base_url("student-groups"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("student-groups")."?error=true", 'location');
        }
    }

    private function validate(){
        $this->load->library('form_validation');
        $this->load->database();

        $this->form_validation->set_rules(
            'degree_id',
            'Degree',
            'required'
        );

        $this->form_validation->set_rules(
            'groupname',
            'Group Name',
            'required'
        );

        $this->form_validation->set_rules(
            'parentgroup',
            'Parent Group',
            'required|integer'
        );

        $this->form_validation->set_rules(
            'year',
            'Year',
            'required|integer'
        );



        if($this->form_validation->run() == false){
            echo validation_errors();
            exit();
            throw new Exception();
        }

    }



    public function process_edit(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $id = $_GET['id'];
            $this->validate();
            $groupId = $_GET['id'];
            $degree = $_POST['degree_id'];
            $year = $_POST['year'];
            $parentGroup = $_POST['parentgroup'];
            $groupName = $_POST['groupname'];

            $this->load->database();
            $this->db->set("group_id", $groupId);
            $this->db->set("degree_id", $degree);
            $this->db->set("year", $year);
            $this->db->set("parent_group", $parentGroup);
            $this->db->set("name", $groupName);

            $this->db->where("group_id", $_GET['id']);
            $this->db->update("student_group");



            redirect(base_url("student-groups")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("student-groups/edit")."?error=true&id=$id", 'location');
        }


	}
	public function process_add()
    {
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $this->validate();

           // $groupId = $_POST['group id'];
            $degree = $_POST['degree_id'];
            $year = $_POST['year'];
            $parentGroup = $_POST['parentgroup'];
            $groupName = $_POST['groupname'];


            $this->load->database();

           // $this->db->set("group_id", $groupId);
            $this->db->set("degree_id", $degree);
            $this->db->set("year", $year);
            $this->db->set("parent_group", $parentGroup);
            $this->db->set("name", $groupName);

            $this->db->insert("student_group");

            redirect(base_url("student-groups")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("student-groups/add")."?error=true", 'location');
        }
    }
}
