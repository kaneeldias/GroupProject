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

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Bookings" => base_url("booking")
        );
        $this->load->view("templates/header", $path);
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
        $bookedBooked = [];

        foreach($data['dates'] as $date){
            for($i = 8; $i <= 17; $i++){
                $booked[$date][$i] = false;
                $bookedBooked[$date][$i] = false;
            }
        }
        $this->load->model("Lecture_model");
        $this->load->model("Constant_model");
        $semester = $this->Constant_model->getCurrentSemester();
        $tt = $this->Lecture_model->getLecturesForVenue($hall, $semester);
        foreach($tt as $t){
            $booked[$data['dates'][$t->getDay()-1]][$t->getStartTime()] = true;
        }

        $this->load->model("Booking_model");
        foreach($this->Booking_model->getBookings($hall, $week) as $booking){
            $bookedBooked[$booking->getDate()][$booking->getStartTime()] = true;
        }
        $data['bookedBooked'] = $bookedBooked;

        $data['booked'] = $booked;
        $this->load->model("Venue_model");
        $data['venue'] = $this->Venue_model->getVenueById($hall);

        $data['formData']['venue'] = $data['venue'];
        $data['formData']['week'] = $week;
        $this->load->model("Staff_model");
        $data['formData']['lecturers'] = $this->Staff_model->getAllStaff();

        $path['path'] = array(
            "Dashboard" => base_url("dashboard"),
            "Bookings" => base_url("booking"),
            "View Slots" => "#"
        );
        $this->load->view("templates/header", $path);
        $this->load->view("views/timetables/BookingView", $data);
        $this->load->view("templates/footer");
    }

    public function process(){
        $this->load->library("session");
        if(!$this->session->userdata("logged") || $this->session->userdata("type") != "admin"){
            echo "unauthorized access";
            return;
        }
        try{
            $this->load->library("session");

            $this->load->library('form_validation');
            $this->load->database();

            $this->form_validation->set_rules(
                'date',
                'Dates',
                'required'
            );

            $this->form_validation->set_rules(
                'start_time',
                'Start Time',
                'required'
            );

            $this->form_validation->set_rules(
                'end_time',
                'End Time',
                'required'
            );


            $this->form_validation->set_rules(
                'request',
                'Request By',
                'required'
            );

            $this->form_validation->set_rules(
                'approved',
                'Approved By',
                'required|integer'
            );

            $this->form_validation->set_rules(
                'reason',
                'Reason',
                'required'
            );

            if($this->form_validation->run() == false){
                //echo validation_errors();
                throw new Exception();
            }

            //if($_POST['start_time'] >= $_POST['end_time']) throw new Exception();

            $dates = explode(",", $_POST['date']);
            $start_times = explode(",", $_POST['start_time']);

            $error = false;
            $warning = false;
            $error_messages = [];
            $this->load->model("Venue_model");
            $this->load->model("Booking_model");
            $venue = $_POST['venue'];
            for($i = 0; $i < sizeof($dates); $i++){
                if(!$this->Venue_model->checkConflictDate($venue, $dates[$i], $start_times[$i]) || !$this->Booking_model->checkConflict($venue, $dates[$i], $start_times[$i])){
                    $error = true;
                    $message = $this->Venue_model->getVenueById($venue)->getName()." is not available during this time slot.";
                    array_push($error_messages, $message);
                }
            }

            $data['error'] = $error;
            $data['warning'] = $warning;


            if($error || $warning){
                throw new Exception();
            }

            for($i = 0; $i < sizeof($dates); $i++){
                $this->load->model("Booking_model");
                $booking = $this->Booking_model->get();
                $booking->setVenue($_POST['venue']);
                $booking->setRequest($_POST['request']);
                $booking->setApproved($_POST['approved']);
                $booking->setReason($_POST['reason']);
                $booking->setDate($dates[$i]);
                $booking->setStartTime($start_times[$i]);
                $booking->setEndTime($start_times[$i] + 1);
                if(!$booking->save()) throw new Exception();
            }
            $venue = $_POST['venue'];
            $week = $_POST['week'];
            redirect(base_url("booking/view-slots")."?venue=$venue&week=$week&success=true", 'location');
        }
        catch(Exception $ex){
            //echo $ex->getMessage();
            //return;
            $venue = $_POST['venue'];
            $week = $_POST['week'];
            redirect(base_url("booking/view-slots")."?venue=$venue&week=$week&error=true", 'location');
        }


    }
}
