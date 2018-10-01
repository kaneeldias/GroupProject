<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookingController extends CI_Controller {

    public function index(){
        $this->load->library("session");
        if(!$this->session->userdata("logged")){
            $this->load->view("templates/header");
            $this->load->view("errors/unauthorized_access");
            $this->load->view("templates/footer");
            return;
        }

        $this->load->model("Venue_model");
        $data['halls'] = $this->Venue_model->getAllVenues();

        $data['weeks'] =
        $this->load->view("templates/header");
        $this->load->view("forms/bookingSelector", $data);
        $this->load->view("templates/footer");
    }

    public function process_select(){
        $this->load->library("session");
        if(!$this->session->userdata("logged")){
            echo "unauthorized access";
            return;
        }

        try{
            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'hall',
                'Hall',
                'required|integer'
            );

            $this->form_validation->set_rules(
                'week',
                'Week',
                'required|date'
            );

            if($this->form_validation->run() == false){
			    throw new Exception();
            }
            $venue_id = $_POST['hall'];
            $week = $_POST['week'];
            redirect(base_url("booking/view-slots?venue=$venue_id&week=$week"), 'location');
        }
        catch(Exception $ex){
            redirect(base_url("booking?error=true"), 'location');
        }

    }

    public function view_slots(){
        $this->load->library("session");
        $hall = $_GET['venue'];
        $week = $_GET['week'];
        $date = new DateTime($week);
        while($date->format('D') != "Mon"){
            $date->modify("-1 day");
        }
        $data['dates'] = [];
        for($i = 1; $i <= 7; $i++){
            array_push($data['dates'], $date->format("Y-m-d"));
            $date->modify('+1 day');
        }
        $booked = [];
        foreach($data['dates'] as $date){
            for($i = 8; $i <= 17; $i++) $booked[$date][$i] = false;
        }
        $this->load->model("Lecture_model");
        $this->load->model("Constant_model");
        $semester = $this->Constant_model->getCurrentSemester();
        $tt = $this->Lecture_model->getLecturesForVenue($hall, $semester);
        foreach($tt as $t){
            $booked[$data['dates'][$t->getDay()-1]][$t->getStartTime()] = true;
        }

        $data['booked'] = $booked;
        $this->load->model("Venue_model");
        $data['venue'] = $this->Venue_model->getVenueById($hall);
        $this->load->view("templates/header");
        $this->load->view("views/timetables/BookingView", $data);
        $this->load->view("templates/footer");
    }
}
