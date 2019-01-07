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

    public function deleteGroupById($id){
        $this->load->database();
        $this->db->where('group_id', $id);
        return $this->db->delete('student_group');
    }

    public function getAllGroups(){
        $groups = [];
        $this->load->database();
        $this->db->select("name");
        $this->db->select("year");
        $this->db->select("group_id");
        $this->db->select("degree_id");
        $this->db->from("student_group");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $group = new Group_model();
            $group->setName($row->name);
            $group->setYear($row->year);
            $group->setDegreeId($row->degree_id);
            $group->setGroupId($row->group_id);
            array_push($groups, $group);
        }

        return $groups;
    }

    public function getChildren(){
        $groups = [];
        $this->load->database();
        $this->db->select("name");
        $this->db->select("group_id");
        $this->db->from("student_group");
        $this->db->where("parent_group", $this->getGroupId());
        $query = $this->db->get();

        foreach($query->result() as $row){
            $group = new Group_model();
            $group->setName($row->name);
            $group->setGroupId($row->group_id);
            array_push($groups, $group);
        }

        foreach($groups as $group){
            $gs = $group->getChildren();
            foreach($gs as $g){
                array_push($groups, $g);
            }
        }

        return $groups;
    }


    public function checkConflict($group_id, $day, $start_time, $semester){
        $relGroups = $this->getRelatedGroups($group_id);
        $this->load->database();
        $this->db->select("group_id");
        $this->db->from("lecture");
        $this->db->where("day", $day);
        $this->db->where("start_time", $start_time);
        $this->db->where("semester", $semester);
        $query = $this->db->get();
        foreach($query->result() as $row){
            foreach($relGroups as $group){
                if($group->getGroupId() == $row->group_id){
                    echo $group->getName();
                    return false;
                }
            }
        }
        return true;
    }

    public function getRelatedGroups($group_id){
        $groups = [];
        array_push($groups, $this->getById($group_id));
        $upperGroups = $this->getUpperGroups($group_id);
        $lowerGroups = $this->getLowerGroups($group_id);
        $groups = array_merge($groups, $lowerGroups);
        $groups = array_merge($groups, $upperGroups);
        return $groups;
    }

    public function getLowerGroups($group_id){
        $groups = [];
        $this->load->database();
        $this->db->select("group_id");
        $this->db->from("student_group");
        $this->db->where("parent_group", $group_id);
        $query = $this->db->get();
        foreach($query->result() as $row){
            array_push($groups, $this->getById($row->group_id));
            $groups = array_merge($groups, $this->getLowerGroups($row->group_id));
        }
        return $groups;
    }

    public function getUpperGroups($group_id){
        $groups = [];
        $this->load->database();
        $this->db->select("parent_group");
        $this->db->from("student_group");
        $this->db->where("group_id", $group_id);
        $query = $this->db->get();
        foreach($query->result() as $row){
            array_push($groups, $this->getById($row->parent_group));
            $groups = array_merge($groups, $this->getUpperGroups($row->parent_group));
        }
        return $groups;
    }

    public function getParentGroup(){
        $groups = [];
        $this->load->database();
        $this->db->select("name");
        $this->db->select("parent_group");
        $this->db->from("student_group");
        $this->db->where("group_id", $this->getGroupId());
        $query = $this->db->get();

        foreach($query->result() as $row){
            return $row->parent_group;

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