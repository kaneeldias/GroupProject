<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'auth/login';
$route['log-in'] = 'auth/log_in';
$route['logout'] = 'auth/logout';

$route['subjects'] = 'Subject/index';
$route['subjects/add'] = 'Subject/add';
$route['subjects/add/process'] = 'Subject/process_add';
$route['subjects/edit'] = 'Subject/edit';
$route['subjects/edit/process'] = 'Subject/process_edit';
$route['subjects/delete'] = 'Subject/delete';

$route['lecture-halls'] = 'LectureHall/index';
$route['lecture-halls/add'] = 'LectureHall/add';
$route['lecture-halls/add/process'] = 'LectureHall/process_add';
$route['lecture-halls/edit'] = 'LectureHall/edit';
$route['lecture-halls/edit/process'] = 'LectureHall/process_edit';
$route['lecture-halls/delete'] = 'LectureHall/delete';

$route['lecturer'] = 'lecturer/index';
$route['lecturer/add'] = 'lecturer/add';
$route['lecturer/add/process'] = 'lecturer/process_add';
$route['lecturer/edit'] = 'lecturer/edit';
$route['lecturer/edit/process'] = 'lecturer/process_edit';
$route['lecturer/delete'] = 'lecturer/delete';

$route['lecturers'] = 'lecturer/index';
$route['add-lecturer'] = 'lecturer/add';
$route['add-lecturer/process'] = 'lecturer/process_add';

$route['student-groups'] = 'StudentGroup/index';
$route['student-groups/add'] = 'StudentGroup/add';
$route['student-groups/add/process'] = 'StudentGroup/process_add';
$route['student-groups/edit'] = 'StudentGroup/edit';
$route['student-groups/edit/process'] = 'StudentGroup/process_edit';
$route['student-groups/delete'] = 'StudentGroup/delete';

$route['time-table/group'] = 'TimeTableController/GroupView';
$route['time-table/lecture-hall'] = 'TimeTableController/VenueView';
$route['time-table/lecturer'] = 'TimeTableController/LecturerView';
$route['time-table/select/student'] = 'TimeTableController/select';
$route['time-table/select/lecturer'] = 'TimeTableController/LecturerViewSelect';
$route['time-table/select/lecture-hall'] = 'TimeTableController/LectureHallViewSelect';
$route['generate-time-tables'] = 'TimeTableController/LecturerViewGenerate';
$route['generate-time-tables1'] = 'TimeTableController/LectureHallViewGenerate';
$route['generate-time-table-lecturer'] = 'TimeTableController/LecturerViewGenerate';
$route['generate-time-table-lecture-hall'] = 'TimeTableController/LectureHallViewGenerate';
$route['generate-time-table'] = 'TimeTableController/generate';
$route['add-lecture'] = 'lecture/add';
$route['time-table-view'] = 'TimeTableController/ViewSelect';
$route['generate-time-table-view'] = 'TimeTableController/ViewGenerate';

$route['signup'] = 'SignUp/submit';

$route['process_add'] = 'SignUp/process_add';
$route['insert-lecture-hall'] = 'LectureHall/InsertLectureHall';

$route['signup'] = 'SignUp/index';
$route['signup/bulk/process'] = 'SignUp/process_bulk';
$route['signup/process'] = 'SignUp/process_add';

$route['lecture/process'] = 'Lecture/process';
$route['lecture/delete'] = 'Lecture/delete';

$route['dashboard-admin'] = 'Dashboard/admin';
$route['dashboard-student'] = 'Dashboard/student';
$route['dashboard-lecturer'] = 'Dashboard/lecturer';
$route['dashboard-outsider'] = 'Dashboard/outsider';

$route['notes/update'] = "NotesController/update";

$route['booking/make'] = "BookingController/index";
$route['free-slots'] = "BookingController/index";
$route['booking'] = "BookingController/view";
$route['booking/process-select'] = "BookingController/process_select";
$route['booking/view-slots'] = "BookingController/view_slots";
$route['booking/process'] = "BookingController/process";
$route['booking/delete'] = "BookingController/delete";

$route['profile'] = 'Profile/index';
$route['profile/edit'] = 'Profile/edit';
$route['profile/edit/process'] = 'Profile/process_edit';

$route['equipment'] = 'Equipment/index';
$route['equipment/add']='Equipment/add';
$route['equipment/add/process'] = 'Equipment/process_add';
$route['equipment/edit'] = 'Equipment/edit';
$route['equipment/edit/process'] = 'Equipment/process_edit';
$route['equipment/delete'] = 'Equipment/delete';

$route['equipment/request'] = 'Equipment/request';
$route['equipment/request/process'] = 'Equipment/request_add';

$route['request'] = "RequestController/index";
$route['request/delete'] = "RequestController/delete";
$route['request/approve']="RequestController/approve";
$route['request/reject']="RequestController/reject";

$route['calendar/integrate'] = "CalendarController/integrate";
$route['calendar/refresh'] = "CalendarController/refresh";
$route['calendar/remove'] = "CalendarController/remove";
$route['calendar/setAccountLecturer'] = "CalendarController/setAccountLecturer";

$route['rubrics'] = "rubricController/index";
$route['rubrics/add'] = "rubricController/add";
$route['rubrics/add/process'] = "rubricController/process_add";
$route['rubrics/edit'] = "rubricController/edit";
$route['rubrics/edit/process'] = "rubricController/process_edit";
$route['rubrics/delete'] = 'rubricController/delete';



$route['validate/email-exists'] = "ValidatorController/emailExists";
$route['validate/code-exists'] = "ValidatorController/codeExists";
$route['validate/edit-code-exists'] = "ValidatorController/editCodeExists";
$route['validate/hall-code-exists'] = "ValidatorController/hallCodeExists";
$route['validate/edit-hall-code-exists'] = "ValidatorController/editHallCodeExists";
$route['validate/lecturer-id-exists'] = "ValidatorController/lecturerIdExists";
$route['validate/edit-lecturer-id-exists'] = "ValidatorController/editLecturerIdExists";
$route['validate/subject-code-exists'] = "ValidatorController/subjectCodeExists";
$route['validate/edit-subject-code-exists'] = "ValidatorController/editSubjectCodeExists";
$route['validate/group-name-exists'] = "ValidatorController/groupNameExists";
$route['validate/edit-group-name-exists'] = "ValidatorController/editGroupNameExists";