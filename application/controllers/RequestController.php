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


            $this->load->database();
            $this->db->select('user_id');
            $this->db->where("req_id",$_GET['id']);
            $this->db->from("equipment");

            $this->load->model("request_model");
            $request = $this->request_model->getRequestById($_GET['id']);
            $email = $request->getRequestedBy()->getEmail();
            $item = $request->getItem();
            $date = $request->getDate();
            $from = $request->getFrom();
            $to = $request->getTo();

            $this->load->library('email');
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'academic.center.test@gmail.com';
            $config['smtp_pass']    = 'aca@123456';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'text'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from('academic.center.test@gmail.com', 'UCSC Academic Center');
            $this->email->to($email);
            $this->email->cc('');
            $this->email->bcc('');

            $this->email->subject('Approved');
            $this->email->message("Your equipment request has been approved.
            Reservation details: 
                Item - $item
                Date - $date 
                From - $from
                To - $to
                ");

            $this->email->send();
            echo $this->email->print_debugger();

            redirect(base_url("request")."?success=true", 'location');
        }
        catch(Exception $e){
            redirect(base_url("request")."?error=true&id=$id", 'location');
        }
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


            $this->load->database();
            $this->db->select('user_id');
            $this->db->where("req_id",$_GET['id']);
            $this->db->from("equipment");

            $this->load->model("request_model");
            $request = $this->request_model->getRequestById($_GET['id']);
            $email = $request->getRequestedBy()->getEmail();

            $this->load->library('email');
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = 'academic.center.test@gmail.com';
            $config['smtp_pass']    = 'aca@123456';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'text'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not

            $this->email->initialize($config);

            $this->email->from('academic.center.test@gmail.com', 'UCSC Academic Center');
            $this->email->to($email);
            $this->email->cc('');
            $this->email->bcc('');

            $this->email->subject('Rejected');
            $this->email->message('Your equipment request has been rejected.');

            $this->email->send();
            echo $this->email->print_debugger();

            redirect(base_url("request")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("request")."?error=true&id=$id", 'location');
        }
    }


}
