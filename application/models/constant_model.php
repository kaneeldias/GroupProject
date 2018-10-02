<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 8:10 PM
 */
class Constant_model extends CI_Model{

    private $current_semester = 1;

    public function getCurrentSemester(){
        return $this->current_semester;
    }
}