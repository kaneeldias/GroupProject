<?php

class rubric_model extends CI_Model{

    private $rubric_id;
    private $subject;
    private $exam;
    private $assesments;
    private $rubric;
    private $setter1;
    private $setter2;
    private $moderator;


    function __construct(){
        parent::__construct();
    }

    public function getRubricById($id){
        $this->load->database();
        $this->db->select("rubric_id");
        $this->db->select("subject_id");
        $this->db->select("exam");
        $this->db->select("assesments");
        $this->db->select("rubric");
        $this->db->select("setter1");
        $this->db->select("setter2");
        $this->db->select("moderator");
        $this->db->from("rubric");
        $this->db->where("rubric_id", $id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $rubric = new rubric_model();
            $rubric->setId($row->rubric_id);
            $rubric->setExam($row->exam);
            $rubric->setAssesments($row->assesments);
            $rubric->setRubric($row->rubric);
            $this->load->model("subject_model");
            $rubric->subject=$this->subject_model->getSubjectById($row->subject_id);
            $this->load->model("staff_model");
            $rubric->setter1= $this->staff_model->getStaffById($row->setter1);
            $rubric->setter2= $this->staff_model->getStaffById($row->setter2);
            $rubric->moderator = $this->staff_model->getStaffById($row->moderator);

            return $rubric;
        }
    }

    public function deleteRubricById($id){
        $this->load->database();
        $this->db->where('rubric_id', $id);
        return $this->db->delete('rubric');
    }



    public function getAllRubrics()
    {

        $rubrics = [];
        $this->load->database();
        $this->db->select("rubric_id");
        $this->db->select("subject_id");
        $this->db->select("exam");
        $this->db->select("assesments");
        $this->db->select("rubric");
        $this->db->select("setter1");
        $this->db->select("setter2");
        $this->db->select("moderator");
        $this->db->from("rubric");
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $this->load->model("subject_model");
            $this->load->model("staff_model");
            $rubric = new rubric_model();
            $rubric->subject = $this->subject_model->getSubjectById($row->subject_id);
            $rubric->setter1= $this->staff_model->getStaffById($row->setter1);
            $rubric->setter2 = $this->staff_model->getStaffById($row->setter2);
            $rubric->moderator = $this->staff_model->getStaffById($row->moderator);
            $rubric->rubric_id = $row->rubric_id;


           // $rubric->setId($row->subject_id);
            $rubric->setExam($row->exam);
            $rubric->setAssesments($row->assesments);
            $rubric->setRubric($row->rubric);
            array_push($rubrics, $rubric);
        }

        return $rubrics;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getExam()
    {
        return $this->exam;
    }

    /**
     * @param mixed $exam
     */
    public function setExam($exam)
    {
        $this->exam = $exam;
    }

    /**
     * @return mixed
     */
    public function getAssesments()
    {
        return $this->assesments;
    }

    /**
     * @param mixed $assesments
     */
    public function setAssesments($assesments)
    {
        $this->assesments = $assesments;
    }

    /**
     * @return mixed
     */
    public function getRubric()
    {
        return $this->rubric;
    }

    /**
     * @param mixed $rubric
     */
    public function setRubric($rubric)
    {
        $this->rubric = $rubric;
    }

    /**
     * @return mixed
     */
    public function getSetter1()
    {
        return $this->setter1;
    }

    /**
     * @param mixed $setter1
     */
    public function setSetter1($setter1)
    {
        $this->setter1 = $setter1;
    }

    /**
     * @return mixed
     */
    public function getSetter2()
    {
        return $this->setter2;
    }

    /**
     * @param mixed $setter2
     */
    public function setSetter2($setter2)
    {
        $this->setter2 = $setter2;
    }

    /**
     * @return mixed
     */
    public function getModerator()
    {
        return $this->moderator;
    }

    /**
     * @param mixed $moderator
     */
    public function setModerator($moderator)
    {
        $this->moderator = $moderator;
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
        return $this->rubric_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->rubric_id = $id;
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