<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Group_model extends CI_Model{

    private $group_id;
    private $name;
    private $parent_id;
    private $degree_id;
    private $year;

    function __construct(){
        parent::__construct();
    }

    public function getById($group_id){
        $group = new Group_model();
        $group->setGroupId($group_id);
        $this->load->database();
        $this->db->select("name");
        $this->db->select("degree_id");
        $this->db->select("year");
        $this->db->from("student_group");
        $this->db->where("group_id", $group_id);
        $query = $this->db->get();

        foreach($query->result() as $row){
            $group->setName($row->name);
            $group->setYear($row->year);
            $group->setDegreeId($row->degree_id);
            break;
        }

        return $group;
    }

    public function getAllGroups(){
        $groups = [];
        $this->load->database();
        $this->db->select("name");
        $this->db->select("group_id");
        $this->db->from("student_group");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $group = new Group_model();
            $group->setName($row->name);
            $group->setGroupId($row->group_id);
            array_push($groups, $group);
        }

        return $groups;
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
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
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




}