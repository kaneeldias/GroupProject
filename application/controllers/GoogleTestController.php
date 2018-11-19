<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GoogleTestController extends CI_Controller {

	function __construct($params = array()) {
		parent::__construct();
		$this->load->library('google');
		echo $this->google->getLibraryVersion();
	}

	public function index(){
		$this->google->getClient();
	}

	public function index2(){
		$authCode = $_GET['authCode'];
		$this->google->getClient2($authCode);
	}

	public function index3(){
		$client = $this->google->getClient();
		$service = new Google_Service_Calendar($client);
		// Print the next 10 events on the user's calendar.
		$calendarId = 'primary';
		$optParams = array(
			'maxResults' => 10,
			'orderBy' => 'startTime',
			'singleEvents' => true,
			'timeMin' => date('c'),
		);
		$results = $service->events->listEvents($calendarId, $optParams);
		$events = $results->getItems();

		if (empty($events)) {
			print "No upcoming events found.\n";
		} else {
			print "Upcoming events:\n";
			foreach ($events as $event) {
				$start = $event->start->dateTime;
				if (empty($start)) {
					$start = $event->start->date;
				}
				printf("%s (%s)\n", $event->getSummary(), $start);
			}
		}
	}

	public function index4(){
		$client = $this->google->getClient();
		$service = new Google_Service_Calendar($client);
		$event = new Google_Service_Calendar_Event(array(
			'summary' => 'Google I/O 2015',
			'location' => '800 Howard St., San Francisco, CA 94103',
			'description' => 'A chance to hear more about Google\'s developer products.',
			'start' => array(
				'dateTime' => '2015-05-28T09:00:00-07:00',
				'timeZone' => 'America/Los_Angeles',
			),
			'end' => array(
				'dateTime' => '2015-05-28T17:00:00-07:00',
				'timeZone' => 'America/Los_Angeles',
			),
			'recurrence' => array(
				'RRULE:FREQ=DAILY;COUNT=2'
			),
			'attendees' => array(
				array('email' => 'lpage@example.com'),
				array('email' => 'sbrin@example.com'),
			),
			'reminders' => array(
				'useDefault' => FALSE,
				'overrides' => array(
					array('method' => 'email', 'minutes' => 24 * 60),
					array('method' => 'popup', 'minutes' => 10),
				),
			),
		));

		$calendarId = 'primary';
		$event = $service->events->insert($calendarId, $event);
		printf('Event created: %s\n', $event->htmlLink);

	}
}
