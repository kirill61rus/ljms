<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/additional_requests');
        $this->load->model('admin/schedule_game');
        $this->load->model('admin/division'); 
        $this->load->model('admin/team');
    }
	/**
	 * show Games by date
     * @param get this date
     * @return array
	*/
    function index(){
    	$data['date'] = $this->input->get('dates');
    	$data['schedule'] = $this->schedule_game->game_by_date($data['date']);
    	$this->load->view('calendar', $data);
    }

	/**
	 * return array with dates Games
     * @param 
     * @return array
	*/
    function get_dates(){
    	//preparing data for transmission to the server
		if (isset($_GET['year'])) $year = $_GET['year']; 

		if (isset($_GET['month'])) {
			$month = $_GET['month']; 
			if ($month < 10) {
				$month = '0'.$month;				
			}
		}
		//request to the server
    	$dates = $this->additional_requests->date_this_game($year, $month);
    	//if the response contains an array, process it
    	if ($dates) {
	    	foreach ($dates as $key => $value) {
	    		$date[$key] = $dates[$key]['date'];
	    	}
			$resalt = json_encode($date);
			echo $resalt;
	    } else {
	    	echo '';
	    }

    }
	/**
	 * show all about division
     * @param get this division id
     * @return array
	*/
    function division(){
    	$id = $this->input->get('id');
    	$data['division_data'] = $this->division->get_all_about($id);
    	$data['ljms_team'] = $this->team->get_ljms_team($id);
    	$data['non_conference_team'] = $this->team->get_non_conference_teams($id);
    	$data['schedule'] = $this->schedule_game->game_for_division($id);
    	$this->load->view('about_division', $data);
    } 
	/**
	 * returm divisions list
     * @param 
     * @return array
	*/
	function return_names_list(){
		$divisions = $this->division->names_list();
		echo json_encode($divisions);
	}
}