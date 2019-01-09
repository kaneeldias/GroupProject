<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GuestController extends CI_Controller {

	public function index(){
	    $this->load->library("session");

	    $this->load->database();
	    $this->db->select('code');
	    $this->db->select('name');
	    $this->db->select('subject');
	    $this->db->select('guest_id');
        $this->db->select('nic');
	    $query = $this->db->get('guest');

        $array = [];

	    foreach ($query->result() as $row){
            $a = [];
	        echo $row->name;

            $a["code"] = $row->code;
            $a["name"] = $row->name;
            $a["subject"] = $row->subject;
            $a["guest_id"] = $row->guest_id;
            $a["nic"] = $row->nic;

            array_push($array,$a);
        }
        $data["array"]=$array;



	    $this->load->view("templates/header");
	    $this->load->view("test-view",$data);
	    $this->load->view("templates/footer");

    }

    public function add(){
        $this->load->library("session");

        $this->load->model("subject_model");
        $subject = $this->subject_model->getAllSubjects();
        $data['subjects'] = $subject;

        $this->load->view("templates/header");
        $this->load->view("forms/addGuestLec", $data);
        $this->load->view("templates/footer");
    }

    public function addProcess(){


	    try{
            $this->validate();

            $code = $_POST['code'];
            $name = $_POST['name'];
            $subjects = $_POST['subjects'];
            $nic = $_POST['nic'];

            $this->load->database();
            $this->db->set('code',$code);
            $this->db->set('name',$name);
            $this->db->set('subject',$subjects);
            $this->db->set('nic',$nic);
            $this->db->insert('guest');

            redirect(base_url("guest-lec")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("guest-lec/add")."?error=true", 'location');
        }
    }

    public function edit(){
        $this->load->library("session");

        $this->load->model("subject_model");
        $subject = $this->subject_model->getAllSubjects();
        $data['subjects'] = $subject;

        $this->load->view("templates/header");
        $this->load->view("forms/editGuestLec",$data);
        $this->load->view("templates/footer");
    }

    public function editProcess(){
        $code = $_POST['code'];
        $name = $_POST['name'];
        $subjects = $_POST['subjects'];
        $nic = $_POST['nic'];

        $this->load->database();
        $this->db->set('code',$code);
        $this->db->set('name',$name);
        $this->db->set('subject',$subjects);
        $this->db->set('nic',$nic);
        $this->db->where('guest_id',$_POST['id']);
        $this->db->update('guest');
    }

    private function  validate()
    {
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
            'nic',
            'NIC',
            'required'
        );


        if ($this->form_validation->run() == false) {
            echo validation_errors();
            exit();
            //throw new Exception();
        }

        $nic=$_POST["nic"];
        if(strlen($nic)!=10){
            echo "Wrong input length";
            exit();
        }
        for($a=0;$a<9;$a++){
            if(!is_numeric($nic[$a])){
                echo "Wrong input";
                exit();
            }
        }
        if($nic[9] == "v" && $nic[9] =="V"){
            echo "Wrong input character";
            exit();

        }
    }
}
