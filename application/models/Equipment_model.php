<?php


class Equipment_model extends CI_Model{

    private $eq_id;
    private $code;
    private $name;
    private $info;

    function __construct(){
        parent::__construct();
    }


    public function getAllItems(){
        $Items = [];
        $this->load->database();
        $this->db->select("eq_id");
        $this->db->select("code");
        $this->db->select("name");
        $this->db->select("info");
        $this->db->from("equipment");
        $query = $this->db->get();

        foreach($query->result() as $row){
            $Item = new Equipment_model();
            $Item->setEqId($row->eq_id);
            $Item->setCode($row->code);
            $Item->setName($row->name);
            $Item->setInfo($row->info);
            array_push($Items, $Item);
        }

        return $Items;
    }

    public function getItemsById($eq_id){
        $this->load->database();
        $this->db->select("code");
        $this->db->select("name");
        $this->db->select("info");
        $this->db->from("equipment");
        $this->db->where("eq_id", $eq_id);
        $query = $this->db->get();

        foreach ($query->result() as $row) {
            $Item = new Equipment_model();
            $Item->setEqId($eq_id);
            $Item->setCode($row->code);
            $Item->setName($row->name);
            $Item->setInfo($row->info);
            return $Item;
        }
    }

    public function deleteItemById($eq_id){
        $this->load->database();
        $this->db->where('eq_id', $eq_id);
        return $this->db->delete('equipment');
    }

    public function getEqId()
    {
        return $this->eq_id;
    }

    public function setEqId($eq_id)
    {
        $this->eq_id = $eq_id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function setInfo($info)
    {
        $this->info = $info;
    }

}