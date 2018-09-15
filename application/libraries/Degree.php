<?php

/**
 * Created by PhpStorm.
 * User: test12345
 * Date: 2018-09-15
 * Time: 9:22 PM
 */
class Degree{

    private $id;
    private $name;

    function __construct($id){
        $this->id = $id;
        $this->load->model("degree_model");
        $this->name = $this->degree_model->getDetails($id);
    }

    public function getName(){
        return $this->name;
    }


}