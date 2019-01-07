<?php

class Request_model extends CI_Model{

    private $id;
    private $requested_by;
    private $item;
    private $quantity;
    private $from;
    private $to;
    private $date;
    private $status;

    function __construct(){
        parent::__construct();
    }


    public function getAllRequests(){
        $items = [];
        $this->load->database();
        $this->db->select("req_id");
        $this->db->select("user_id");
        $this->db->select("item");
        $this->db->select("from_time");
        $this->db->select("to_time");
        $this->db->select("date");
        $this->db->select("status");
        $this->db->from("equipment_requests");
        $this->db->where("date >= ", date("Y-m-d"));
        $this->db->order_by("date", "desc");
        $query = $this->db->get();

        $this->load->model("profile_model");

        foreach($query->result() as $row){
            $item = new Request_model();
            $item->setId($row->req_id);
            $item->setRequestedBy($this->profile_model->getAllDetails($row->user_id));
            $item->setItem($row->item);
            $item->setFrom($row->from_time);
            $item->setTo($row->to_time);
            $item->setDate($row->date);
            $item->setStatus($row->status);
            array_push($items, $item);
        }

        return $items;
    }

    public function getRequestById($id){
        $this->load->database();
        $this->db->select("user_id");
        $this->db->select("item");
        $this->db->select("quantity");
        $this->db->select("from_time");
        $this->db->select("to_time");
        $this->db->select("date");
        $this->db->select("status");
        $this->db->from("equipment_requests");
        $this->db->where("req_id", $id);
        $query = $this->db->get();

        $this->load->model("profile_model");

        foreach ($query->result() as $row) {
            $item = new Request_model();
            $item->setRequestedBy($this->profile_model->getAllDetails($row->user_id));
            $item->setItem($row->item);
            $item->setQuantity($row->quantity);
            $item->setFrom($row->from_time);
            $item->setTo($row->to_time);
            $item->setDate($row->date);
            $item->setStatus($row->status);
            return $item;
        }
    }

    public function checkAvailability($id, $to, $end){
        $this->load->database();
        $this->db->select("user_name");
        $this->db->from("equipment_requests");
        $this->db->where("item", $id);
    }

    public function deleteRequestById($id){
        $this->load->database();
        $this->db->where('req_id', $id);
        return $this->db->delete('equipment_requests');
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    public function getRequestedBy()
    {
        return $this->requested_by;
    }


    public function setRequestedBy($requested_by)
    {
        $this->requested_by = $requested_by;
        return $this;
    }


    public function getItem()
    {
        return $this->item;
    }


    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }


    public function getQuantity()
    {
        return $this->quantity;
    }


    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }


    public function getFrom()
    {
        return $this->from;
    }


    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }


    public function getTo()
    {
        return $this->to;
    }


    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }


    public function getDate()
    {
        return $this->date;
    }


    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($date)
    {
        $this->status = $date;
        return $this;
    }






}