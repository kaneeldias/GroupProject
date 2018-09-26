<?php


class Lecturer_model extends CI_Model{

    private $staff_id;
    private $id;
    private $name;
    private $shortform;

    function __construct(){
        parent::__construct();
    }


    public function getAllLecturers(){
        $Lecturers = [];
        $this->load->database();
        $this->db->select("staff_id");
        $this->db->select("id");
        $this->db->select("name");
        $this->db->select("short_name");
        $this->db->from("academic_staff");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $Lecturer = new Lecturer_model();
            $Lecturer->setStaffId($row->staff_id);
            $Lecturer->setId($row->id);
            $Lecturer->setName($row->name);
            $Lecturer->setShortForm($row->short_name);
            array_push($Lecturers, $Lecturer);
        }

        return $Lecturers;
    }

    public function getLecturersById($staff_id){
        $this->load->database();
        $this->db->select("id");
        $this->db->select("name");
        $this->db->select("short_name");
        $this->db->from("academic_staff");
        $this->db->where("staff_id", $staff_id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $Lec = new Lecturer_model();
            $Lec->setStaffId($staff_id);
            $Lec->setId($row->id);
            $Lec->setName($row->name);
            $Lec->setShortForm($row->short_name);
            return $Lec;
        }
    }

    public function deleteLecturerById($staff_id){
        $this->load->database();
        $this->db->where('staff_id', $staff_id);
        return $this->db->delete('academic_staff');
    }

    public function getLecturersForLecture($lecture_id){
        $Lecturers = [];
        $this->load->database();
        $this->db->select("staff_id");
        $this->db->from("lecture_allocation");
        $this->db->where("lecture_id", $lecture_id);
        $query = $this->db->get();
        foreach($query->result() as $row){
            $Lec = $this->getLecturersById($row->staff_id);
            array_push($Lecturers, $Lec);
        }
        return $Lecturers;
    }

    /*public function checkConflict($venue_id, $day, $start_time){
        $this->load->database();
        $this->db->select("lecture_id");
        $this->db->from("lecture");
        $this->db->where("day", $day);
        $this->db->where("start_time", $start_time);
        $query = $this->db->get();
        foreach($query->result() as $row){
            $this->db->select("hall_id");
            $this->db->from("venue_allocation");
            $this->db->where("lecture_id", $row->lecture_id);
            $query2 = $this->db->get();
            foreach($query2->result() as $row2){
                if($row2->hall_id == $venue_id) return false;
            }
        }
        return true;
    }*/

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getStaffId()
    {
        return $this->staff_id;
    }

    public function setStaffId($staff_id)
    {
        $this->staff_id = $staff_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getShortForm()
    {
        return $this->shortform;
    }

    public function setShortForm($shortform)
    {
        $this->shortform = $shortform;
    }







}