<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function log_in(){
		$this->load->library('session');
		if($this->session->userdata("logged")){
			echo "You are already logged in.";
			return;
		}
		$this->load->view("templates/header");
		$this->load->view("forms/login");
		$this->load->view("templates/footer");
	}

	public function login(){
		$this->load->library('session');
		if($this->session->userdata("logged")){
			echo "You are already logged in.";
			return;
		}
		try{
			if(!isset($_POST['email']) || !isset($_POST['password'])) throw new Exception();

			$email = $_POST['email'];
			$password = $_POST['password'];

			$this->load->database();
            $this->db->select("fname");
			$this->db->select("password");
			$this->db->select("user_id");
			$this->db->select("type");
			$this->db->select("fname");
			$this->db->select("lname");
			$this->db->from("user");
			$this->db->where("email", $email);
			$query = $this->db->get();

			foreach($query->result() as $row){
			    $fname = $row->fname;
				if($row->password == $password){
					$this->load->library('session');
					$this->session->set_userdata('logged', true);
					$this->session->set_userdata('type', $row->type);
					$this->session->set_userdata('user_id', $row->user_id);
					$this->session->set_userdata('fname', $row->fname);
          redirect(base_url("Dashboard"), 'location');
				}
				break;
			}
			redirect(base_url("log-in")."?login=false", 'location');
		}
		catch(Exception $ex) {
			redirect(base_url("log-in")."?login=false", 'location');
		}

	}

	public function logout(){
		$this->load->library('session');
		if(!$this->session->userdata("logged")){
			echo "You are not logged in.";
			return;
		}
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect(base_url(), 'location');
	}

}
