<?php

class CalendarInfo_model extends CI_Model{

    private $user_id;
    private $type;
    private $timetable_id;

    function __construct(){
        parent::__construct();
    }

    public function get(){
        return new CalendarInfo_model();
    }

    public function save(){
        $this->load->database();
        $this->db->set('user_id', $this->user_id);
        $this->db->set('type', $this->type);
        $this->db->set('timetable_id', $this->timetable_id);
        $this->db->replace("calendar_info");
    }

    public function getCalendarInfo($user_id){
        $this->load->database();
        $this->db->select("type");
        $this->db->select("timetable_id");
        $this->db->where("user_id", $user_id);
        $this->db->from("calendar_info");
        $query = $this->db->get();
        foreach($query->result() as $row){
            $calendar = new CalendarInfo_model();
            $calendar->setUserId($user_id);
            $calendar->setType($row->type);
            $calendar->setTimetableId($row->timetable_id);
            return $calendar;
        }
        return false;

    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTimetableId()
    {
        return $this->timetable_id;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $timetable_id
     */
    public function setTimetableId($timetable_id)
    {
        $this->timetable_id = $timetable_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }




}