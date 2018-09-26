<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeTableController extends CI_Controller {

	public function GroupView(){
		try{
			$this->load->library('session');

			if(!isset($_GET['group']) || !isset($_GET['semester'])) throw new Exception();

			$data = [];
			$data['formData'] = [];

			$group_id = $_GET['group'];
			$this->load->model("Group_model");
			$group = $this->Group_model->getById($group_id);
			$data['group']= $group;

			$data['semester'] = $data['formData']['semester'] = $_GET['semester'];

			$this->load->model("Subject_model");
			$data['formData']['subjects'] = $this->Subject_model->getSubjectsForGroupSemester($data['group'], $_GET['semester']);
			$data['formData']['group'] = $group;

			$this->load->model("Venue_model");
			$data['formData']['venues'] = $this->Venue_model->getAllVenues();

			$this->load->model("Staff_model");
			$data['formData']['staff'] = $this->Staff_model->getAllStaff();

			$data['formData']['groups'] = $group->getChildren();

			$this->load->model("Lecture_model");
			$data['lectures'] = $this->Lecture_model->getLectures($group_id, $_GET['semester']);

			foreach($data['formData']['groups'] as $group){
				//var_dump($this->Lecture_model->getLectures($group->getGroupId(), $_GET['semester']));
				$l = $this->Lecture_model->getLectures($group->getGroupId(), $_GET['semester']);
				for($i = 1; $i <= 5; $i++){
					for($j = 8; $j <= 17; $j++){
						foreach($l[$i][$j] as $lo) array_push($data['lectures'][$i][$j], $lo);
					}
				}
			}

			$this->load->view("templates/header");
			$this->load->view("TimeTableView", $data);
			$this->load->view("templates/footer");
		}
		catch(Exception $ex){
			$data['heading'] = "404 Error";
			$data['message'] = "404 Error";
			$this->load->view("templates/header");
			$this->load->view("errors/generate_error", $data);
			$this->load->view("templates/footer");
		}

	}

	public function select(){
        $this->config->load("globals");
        $data = [];
        $this->load->library('session');
        $this->load->model("group_model");
        $data['groups']=$this->group_model->getAllGroups();

        $this->load->view("templates/header");
        $this->load->view("forms/selectTimeTable", $data);
        $this->load->view("templates/footer");
    }

    public function generate(){
        $this->config->load("globals");
        $data = [];
        $semester = $_POST['semester'];
        $group_id = $_POST['studentGroup'];

        $str="time-table/group?group=".$group_id."&semester=".$semester;

        redirect(base_url("$str"), 'location');

    }

	public function venueView(){
			$this->config->load("globals");
			$data = [];
			$this->load->library('session');
			if(!isset($_GET['venue_id'])) throw new Exception();
			if(!isset($_GET['semester'])) throw new Exception();

			$this->load->model("Venue_model");
			$data['venue'] = $this->Venue_model->getVenueById($_GET['venue_id']);
			$data['semester'] = $_GET['semester'];

			$this->load->model("Lecture_model");
			$lectures = $this->Lecture_model->getLecturesForVenue($_GET['venue_id'], $_GET['semester']);
			$this->load->model("Subject_model");
			$this->load->model("Group_model");
			$this->load->model("Staff_model");
			$data['lectures'] = [];
			foreach($lectures as $lecture){
				$obj = [];
				$obj['lecture'] = $lecture;
				$obj['subject']= $this->Subject_model->getSubjectById($lecture->getSubjectId());
				$obj['group'] = $this->Group_model->getById($lecture->getGroupId());
				$obj['staff'] = $this->Staff_model->getStaffForLecture($lecture->getId());
				$data['lectures'][$lecture->getDay()][$lecture->getStartTime()] = $obj;
			}
			//var_dump($data);
			//return;
			$this->load->view("templates/header");
			$this->load->view("views/timetables/TimeTableLectureHallView", $data);
			$this->load->view("templates/footer");
	}


	public function lecturerView(){
		$this->config->load("globals");
		$data = [];
		$this->load->library('session');
		for($i = 1; $i <= 5; $i++){
			for($j = 8; $j <= 17; $j++){
				$data['lectures'][$i][$j] = [];
			}
		}
		if(!isset($_GET['lecturer_id'])) throw new Exception();
		if(!isset($_GET['semester'])) throw new Exception();

		$this->load->model("Staff_model");
		$data['staff'] = $this->Staff_model->getStaffById($_GET['lecturer_id']);
		$data['semester'] = $_GET['semester'];

		$this->load->model("Lecture_model");
		$lectures = $this->Lecture_model->getLecturesForLecturer($_GET['lecturer_id'], $_GET['semester']);
		$this->load->model("Subject_model");
		$this->load->model("Group_model");
		$this->load->model("Venue_model");
		foreach($lectures as $lecture){
			$obj = [];
			$obj['lecture'] = $lecture;
			$obj['subject']= $this->Subject_model->getSubjectById($lecture->getSubjectId());
			$obj['group'] = $this->Group_model->getById($lecture->getGroupId());
			$obj['venues'] = $this->Venue_model->getVenuesForLecture($lecture->getId());
			array_push($data['lectures'][$lecture->getDay()][$lecture->getStartTime()], $obj);
		}
		//var_dump($data);
		//return;
		$this->load->view("templates/header");
		$this->load->view("views/timetables/TimeTableLecturerView", $data);
		$this->load->view("templates/footer");
	}
}
