<?php

class Booking_model extends CI_Model{

    private $venue;
    private $request;
    private $approved;
    private $reason;
    private $date;
    private $start_time;
    private $end_time;

    /**
     * @return mixed
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * @param mixed $venue
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @param mixed $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param mixed $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param mixed $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_tine;
    }

    /**
     * @param mixed $end_tine
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }

    public function save(){
        $this->load->database();
        $this->db->set("venue", $this->venue);
        $this->db->set("reason", $this->reason);
        $this->db->set("approved", $this->approved);
        $this->db->set("request", $this->request);
        $this->db->set("date", $this->date);
        $this->db->set("start_time", $this->start_time);
        $this->db->set("end_time", $this->end_time);
        if(!$this->db->insert("bookings")) return false;
        return true;
    }

    public function checkConflict($venue_id, $date, $start_time){
        $this->load->database();
        $this->db->select("booking_id");
        $this->db->from("bookings");
        $this->db->where("date", $date);
        $this->db->where("venue", $venue_id);
        $this->db->where("start_time", $start_time);
        $query = $this->db->get();
        foreach($query->result() as $row){
            return false;
        }
        return true;
    }

    public function get(){
        return new Booking_model();
    }

    public function getBookings($venue_id, $week){
        $range = $this->x_week_range($week);
        $this->load->database();
        $this->db->select("date");
        $this->db->select("start_time");
        $this->db->from("bookings");
        $this->db->where("venue", $venue_id);
        $this->db->where("date >=", $range[0]);
        $this->db->where("date <=", $range[1]);
        $query = $this->db->get();
        $arr = [];
        foreach($query->result() as $row){
            $booking = $this->get();
            $booking->setDate($row->date);
            $booking->setStartTime($row->start_time);
            array_push($arr, $booking);
        }
        return $arr;
    }

    function x_week_range($date) {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
        return array(date('Y-m-d', $start),
            date('Y-m-d', strtotime('next sunday', $start)));
    }

}