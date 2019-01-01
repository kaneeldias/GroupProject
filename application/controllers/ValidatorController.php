<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ValidatorController extends CI_Controller {

    public function emailExists(){

        if(!isset($_GET['email'])) {
            echo json_encode("Invalid");
            return;
        }

        $this->load->database();
        $this->db->where("email", $_GET['email']);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0){
            echo json_encode("Email address has already been taken.");
            return;
        }
        echo json_encode(true);

    }
}
