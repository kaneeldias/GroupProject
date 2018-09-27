<?php

class profile_model extends CI_Model{

    private $user_id;
    private $fname;
    private $lname;
    private $email;
    private $tp;

    function __construct(){
        parent::__construct();
    }


    public function getAllDetails($user_id){
        $details = [];
        $this->load->database();
        $this->db->select("fname");
        $this->db->select("lname");
        $this->db->select("email");
        $this->db->select("tp");
        $this->db->where("user_id",$user_id);
        $this->db->from("user");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $person = new profile_model();
            $person->setFname($row->fname);
            $person->setLname($row->lname);
            $person->setEmail($row->email);
            $person->setTp($row->tp);
            return $person;
        }

        return $details;
    }


    public function getFname()
    {
        return $this->fname;
    }

    public function setFname($fname)
    {
        $this->fname = $fname;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTp()
    {
        return $this->tp;
    }

    public function setTp($tp)
    {
        $this->tp = $tp;
    }






}