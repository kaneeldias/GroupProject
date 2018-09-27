<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotesController extends CI_Controller {

    public function update(){
        $this->load->library("session");
        if(!$this->session->userdata("logged")){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $this->load->database();
        $this->db->set("user_id", $this->session->userdata('user_id'));
        $this->db->set("notes", $_POST['notes']);
        $this->db->replace("notes");
        redirect(base_url("Dashboard"), 'location');


    }
}
