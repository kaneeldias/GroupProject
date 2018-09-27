<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Notes_model extends CI_Model{

    public function getNotes($user_id){
        $this->load->database();
        $this->db->select("notes");
        $this->db->from("notes");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        foreach($query->result() as $row) return $row->notes;
        return "";
    }

}