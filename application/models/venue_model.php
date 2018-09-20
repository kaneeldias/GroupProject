<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Venue_model extends CI_Model{

    private $id;
    private $code;
    private $name;
    private $type;
    private $capacity;

    function __construct(){
        parent::__construct();
    }


    public function getAllVenues(){
        $halls = [];
        $this->load->database();
        $this->db->select("hall_id");
        $this->db->select("name");
        $this->db->select("code");
        $this->db->select("type");
        $this->db->select("capacity");
        $this->db->from("lecture_hall");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $hall = new Venue_model();
            $hall->setId($row->hall_id);
            $hall->setName($row->name);
            $hall->setCode($row->code);
            $hall->setType($row->type);
            $hall->setCapacity($row->capacity);
            array_push($halls, $hall);
        }

        return $halls;
    }

    public function getVenueById($id){
        $this->load->database();
        $this->db->select("code");
        $this->db->select("name");
        $this->db->select("type");
        $this->db->select("capacity");
        $this->db->from("lecture_hall");
        $this->db->where("hall_id", $id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $venue = new Venue_model();
            $venue->setCode($row->code);
            $venue->setName($row->name);
            $venue->setType($row->type);
            $venue->setCapacity($row->capacity);
            return $venue;
        }
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }





}