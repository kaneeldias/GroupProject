<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Staff_model extends CI_Model{

    private $id;
    private $staff_id;
    private $name;
    private $shortform;

    function __construct(){
        parent::__construct();
    }


    public function getAllStaff(){
        $staff = [];
        $this->load->database();
        $this->db->select("id");
        $this->db->select("staff_id");
        $this->db->select("name");
        $this->db->select("short_name");
        $this->db->from("academic_staff");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $s = new Staff_model();
            $s->setId($row->staff_id);
            $s->setStaffId($row->id);
            $s->setName($row->name);
            $s->setShortform($row->short_name);

            array_push($staff, $s);
        }

        return $staff;
    }

    public function getStaffById($id){
        $this->load->database();
        $this->db->select("staff_id");
        $this->db->select("name");
        $this->db->select("short_name");
        $this->db->from("academic_staff");
        $this->db->where("staff_id", $id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $lecturer = new Staff_model();
            $lecturer->setId($row->staff_id);
            $lecturer->setName($row->name);
            $lecturer->setShortform($row->short_name);
            return $lecturer;
        }
    }

    public function getStaffForLecture($lecture_id){
        $staff = [];
        $this->load->database();
        $this->db->select("staff_id");
        $this->db->where("lecture_id", $lecture_id);
        $this->db->from("lecture_allocation");
        $query = $this->db->get();
        foreach($query->result() as $row){
            $s = $this->getStaffById($row->staff_id);
            array_push($staff, $s);
        }
        return $staff;
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
    public function getStaffId()
    {
        return $this->staff_id;
    }

    /**
     * @param mixed $staff_id
     */
    public function setStaffId($staff_id)
    {
        $this->staff_id = $staff_id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getShortform()
    {
        return $this->shortform;
    }

    /**
     * @param mixed $shortform
     */
    public function setShortform($shortform)
    {
        $this->shortform = $shortform;
    }



}