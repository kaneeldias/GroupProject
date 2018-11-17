<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CalendarController extends CI_Controller {

	public function integrate(){
		$authCode = $_POST['authCode'];
		$this->load->library("google");
		if($this->google->checkAuthorize($authCode)){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		else{
			echo "fuck";
		}
	}

}
