<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Lecture_model extends CI_Model{

    private $id;
    private $subject_id;
    private $group_id;
    private $semester;
    private $day;
    private $start_time;
    private $end_time;
    private $venues = [];
    private $staff = [];

    function __construct(){
        parent::__construct();
    }

    public function get(){
        return new Lecture_model();
    }

    public function save(){
        $this->load->database();
        $this->db->set("subject_id", $this->subject_id);
        $this->db->set("group_id", $this->group_id);
        $this->db->set("semester", $this->semester);
        $this->db->set("day", $this->day);
        $this->db->set("start_time", $this->start_time);
        $this->db->set("end_time", $this->end_time);
        $this->db->insert("lecture");
        return true;
    }

    public function getLectures($group_id, $semester){
        $this->load->model("Subject_model");
        $lectures = [];
        $this->load->database();
        $this->db->select("subject_id");
        $this->db->select("day");
        $this->db->select("start_time");
        $this->db->select("end_time");
        $this->db->from("lecture");
        $this->db->where("group_id", $group_id);
        $this->db->where("semester", $semester);
        $query = $this->db->get();

        foreach($query->result() as $row){
            $lecture = [];
            $lecture["subject"] = $this->Subject_model->getSubjectById($row->subject_id);
            $lectures[$row->day][$row->start_time] = $lecture;
        }

        return $lectures;

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * @param mixed $semester
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    /**
     * @return mixed
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param mixed $day
     */
    public function setDay($day)
    {
        $this->day = $day;
    }



    /**
     * @return mixed
     */
    public function getSubjectId()
    {
        return $this->subject_id;
    }

    /**
     * @param mixed $subject_id
     */
    public function setSubjectId($subject_id)
    {
        $this->subject_id = $subject_id;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param mixed $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
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
        return $this->end_time;
    }

    /**
     * @param mixed $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }



}