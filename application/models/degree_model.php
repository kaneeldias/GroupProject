<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Degree_model extends CI_Model{

    private $id;
    private $name;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    function __construct(){
        parent::__construct();
    }

   public function getById($degree_id){
       $degree = new Degree_model();
       $degree->setID($degree_id);
       $this->load->database();
       $this->db->select("name");
       $this->db->from("degree");
       $this->db->where("degree_id", $degree_id);
       $query = $this->db->get();

       foreach($query->result() as $row){
           $degree->setName($row->name);
           break;
       }

       return $degree;
   }

   public function getAllDegrees(){
       $degrees = [];
       $this->load->database();
       $this->db->select("name");
       $this->db->select("degree_id");
       $this->db->from("degree");
       $query = $this->db->get();

       foreach($query->result() as $row){
           $degree = new Degree_model();
           $degree->setId($row->degree_id);
           $degree->setName($row->name);
           array_push($degrees, $degree);
       }
       return $degrees;
   }
}