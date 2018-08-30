<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	public function login()
	{
		if(isset($_POST['email'])){
			//$this->load->view("templates/header");
			$email = $_POST['email'];
			$password = $_POST['password'];
			//$email = "kaneeldias@gmail.com";
			//$password = "abcd@123";

			$this->load->database();
			//$this->db->select("email");
			$this->db->select("password");
			$this->db->select("type");
			$this->db->from("user");
			$this->db->where("email", $email);
			$query = $this->db->get();

			foreach($query->result() as $row){
                if($row->password == $password){
                    echo "success";
                    return;
                }
                break;
            }
            echo "fail";
			//$this->load->view("templates/footer");
			return;
		}

		$this->load->view("templates/header");
		$this->load->view("auth/login");
		$this->load->view("templates/footer");

	}

}
