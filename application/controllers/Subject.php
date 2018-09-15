<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function add()
	{
		$this->load->library('session');
		$this->load->view('templates/header');
		$this->load->view('forms/addSubject');
		$this->load->view('templates/footer');
	}

    public function process_add(){
        try{
            $subjectId = $_POST['subjectId'];
            $code = $_POST['code'];
            $name = $_POST['name'];
            $degreeId = $_POST['degreeId'];
            $year = $_POST['year'];

            if(!isset($subjectId) || !isset($code) || !isset($name) || !isset($degreeId) || !isset($year)) throw new Exception();
            if($subjectId == "" || $code == "" || $name == "" || $degreeId == "" || $year == "") throw new Exception();

            $this->load->database();
            $this->db->set("subjectId", $subjectId);
            $this->db->set("code", $code);
            $this->db->set("name", $name);
            $this->db->set("degreeId", $degreeId);
            $this->db->set("year", $year);
            $this->db->insert("subject");

            redirect(base_url("add-subject")."?success=true", 'location');

        }
        catch(Exception $e){
            redirect(base_url("add-subject")."?error=true", 'location');
        }

    }
}
