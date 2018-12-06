<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CalendarController extends CI_Controller {

	public function integrate(){
		$authCode = $_POST['authCode'];
		$this->load->library("google");
		$this->load->library("session");
		$this->google->setUserId($this->session->userdata('user_id'));
		if($this->google->checkAuthorize($authCode)){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else{
			echo "fuck";
		}
	}

	public function setAccountLecturer(){
		$this->load->library("session");
		if($this->session->userdata("type") != "staff"){
			$this->load->view("templates/header");
			$this->load->view("errors/unauthorized_access");
			$this->load->view("templates/footer");
			return;
		}
		$this->load->model("CalendarInfo_model");
		$calendar = $this->CalendarInfo_model->get();
		$calendar->setUserId($this->session->userdata("user_id"));
		$calendar->setType("staff");
		$calendar->setTimetableId($_POST['lecturer']);
		$calendar->save();
		redirect(base_url("profile"), 'refresh');
	}

	public function refresh(){
		$this->load->model("Lecture_model");
		$this->load->model("Subject_model");
		$this->load->model("Venue_model");
		$this->load->model("CalendarInfo_model");
		$this->load->library("session");

		$calender = $this->CalendarInfo_model->getCalendarInfo($this->session->userdata('user_id'));
		$semester = 1;

		$data = [];
		if($calender->getType() == "staff"){
			$lectures = $this->Lecture_model->getLecturesForLecturer($calender->getTimetableId(), $semester);
			foreach($lectures as $lecture){
				$a = [];
				$a['lecture'] = $lecture;
				$a['subject'] = $this->Subject_model->getSubjectById($lecture->getSubjectId());
				$a['venues'] = [];
				foreach($this->Venue_model->getVenuesForLecture($lecture->getId()) as $venue){
					array_push($a['venues'], $venue->getName());
				}
				array_push($data, $a);
			}
		}

		if($calender->getType() == "student"){
			$lectures = $this->Lecture_model->getLecturesForGroup($calender->getTimetableId(), $semester);
			foreach($lectures as $lecture){
				$a = [];
				$a['lecture'] = $lecture;
				$a['subject'] = $this->Subject_model->getSubjectById($lecture->getSubjectId());
				$a['venues'] = [];
				foreach($this->Venue_model->getVenuesForLecture($lecture->getId()) as $venue){
					array_push($a['venues'], $venue->getName());
				}
				array_push($data, $a);
			}
		}


		$this->load->library("google");
		$this->google->setUserId($this->session->userdata('user_id'));
		$client = $this->google->getClient();
		if($client == false){
			exit("Error");
		}

		foreach($data as $d){
			/*echo $d['lecture']->getDay()."</br>";
			echo $d['subject']->getCode()." - ".$d['subject']->getName()."</br>";
			echo $d['lecture']->getStartTime()."</br>";
			foreach($d['venues'] as $venue){
				echo $venue->getName()."</br>";
			}
			echo "</br>";*/

			$date = new DateTime();
			$day = $d['lecture']->getDay();
			$dayName = "";
			switch($day){
				case 1:
					$dayName = "monday";
					break;
				case 2:
					$dayName = "tuesday";
					break;
				case 3:
					$dayName = "wednesday";
					break;
				case 4:
					$dayName = "thursday";
					break;
				case 5:
					$dayName = "friday";
					break;

			}
			$date->modify('next '.$dayName);
			$start = $date->format("Y-m-d")."T".str_pad($d['lecture']->getStartTime(), 2, '0', STR_PAD_LEFT).":00:00";
			//echo $start;
			//echo " TO ";
			$end = $date->format("Y-m-d")."T".str_pad($d['lecture']->getStartTime()+1, 2, '0', STR_PAD_LEFT).":00:00";
			//echo $end;
			//echo "</br>";

			$service = new Google_Service_Calendar($client);
			$event = new Google_Service_Calendar_Event(array(
				'summary' => $d['subject']->getCode()." - ".$d['subject']->getName(),
				'location' => implode(", ", $d['venues']),
				'start' => array(
					'dateTime' => $start,
					'timeZone' => 'Asia/Colombo',
				),
				'end' => array(
					'dateTime' => $end,
					'timeZone' => 'Asia/Colombo',
				),
			));

			$calendarId = 'primary';
			$event = $service->events->insert($calendarId, $event);
			//printf('Event created: %s\n', $event->htmlLink);
			//echo "</br>";
		}
		redirect(base_url("profile"), 'refresh');
	}

}
