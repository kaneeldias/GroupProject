<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RequestController extends CI_Controller {

	public function index(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }
        $data = [];
        $this->load->model("Request_model");
        $data['Items'] = $this->Request_model->getAllRequests();
        $this->config->load("globals");

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Requests" => base_url("requests")
        );

        $this->load->view("templates/header", $path);
        $this->load->view("views/RequestView", $data);
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
            $this->load->model("Request_model");
            $data['item'] = $this->Request_model->deleteRequestById($data['id']);
            redirect(base_url("request"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("request")."?error=true", 'location');
        }
    }

    public function approve(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $id = $_GET['id'];

            $this->load->database();
            $this->db->set("status", "Approved");

            $this->db->where("req_id", $_GET['id']);
            $this->db->update("equipment_requests");

            $this->session->set_flashdata("success", true);
            $this->session->set_flashdata("message", "Request has been approved");
            redirect(base_url("request"), 'location');

        }
        catch(Exception $e){
            $this->session->set_flashdata("error", true);
            $this->session->set_flashdata("message", "An error occured");
            redirect(base_url("request"), 'location');        }
    }
    public function reject(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $id = $_GET['id'];

            $this->load->database();
            $this->db->set("status", "Rejected");

            $this->db->where("req_id", $_GET['id']);
            $this->db->update("equipment_requests");

            $this->session->set_flashdata("success", true);
            $this->session->set_flashdata("message", "Request has been rejected");
            redirect(base_url("request"), 'location');
        }
        catch(Exception $e){
            $this->session->set_flashdata("error", true);
            $this->session->set_flashdata("message", "An error occurred");
            redirect(base_url("request"), 'location');        }
    }


}
