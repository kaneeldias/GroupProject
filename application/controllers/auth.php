<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function log_in(){
		$this->load->library('session');
		$this->load->view("templates/header");
		$this->load->view("forms/login");
		$this->load->view("templates/footer");
	}

	public function login(){
		try{
			if(!isset($_POST['email']) || !isset($_POST['password'])) throw new Exception();

			$email = $_POST['email'];
			$password = $_POST['password'];

			$this->load->database();
			$this->db->select("password");
			$this->db->select("type");
			$this->db->from("user");
			$this->db->where("email", $email);
			$query = $this->db->get();

			foreach($query->result() as $row){
				if($row->password == $password){
					$this->load->library('session');
					$this->session->set_userdata('logged', true);
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
		$this->session->sess_destroy();
		redirect(base_url(), 'location');
	}

}
