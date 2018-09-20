<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Subject_model extends CI_Model{

    private $id;
    private $code;
    private $name;
    private $degree_id;
    private $year;
    private $semester;


    function __construct(){
        parent::__construct();
    }

    public function getSubjectById($id){
        $this->load->database();
        $this->db->select("code");
        $this->db->select("name");
        $this->db->from("subject");
        $this->db->where("subject_id", $id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $subject = new Subject_model();
            $subject->setName($row->name);
            $subject->setCode($row->code);
            return $subject;
        }
    }

    public function getAllSubjects()
    {
        $subjects = [];
        $this->load->database();
        $this->db->select("code");
        $this->db->select("name");
        $this->db->select("degree_id");
        $this->db->select("year");
        $this->db->select("semester");
        $this->db->from("subject");
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $subject = new Subject_model();
            $subject->setCode($row->code);
            $subject->setName($row->name);
            $subject->setDegreeId($row->degree_id);
            $subject->setYear($row->year);
            $subject->setSemester($row->semester);
            array_push($subjects, $subject);
        }

        return $subjects;
    }


    public function getSubjectsForGroupSemester($group, $semester){
        $subjects = [];
        $this->load->database();
        $this->db->select("subject_id");
        $this->db->select("code");
        $this->db->select("name");
        $this->db->from("subject");
        $this->db->where("degree_id", $group->getDegreeId());
        $this->db->where("semester", $semester);
        $query = $this->db->get();

        foreach($query->result() as $row){
            $subject = new Subject_model();
            $subject->setId($row->subject_id);
            $subject->setName($row->name);
            $subject->setCode($row->code);
            array_push($subjects, $subject);
        }

        return $subjects;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
    public function getDegreeId()
    {
        return $this->degree_id;
    }

    /**
     * @param mixed $degree_id
     */
    public function setDegreeId($degree_id)
    {
        $this->degree_id = $degree_id;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
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




}