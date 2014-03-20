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
    	$tipe_teams = ['ljms_team', 'non_conference_team'];
    	foreach ($tipe_teams as $tipe_team) {

    		$result_names = ['home_win', 'visitor_win', 'home_loss', 'visitor_loss', 'home_ties', 'visitor_ties'];
			//iterate teams
			foreach ($data[$tipe_team] as $key => $value) {
				//iterate through all the possible outcomes
				foreach($result_names as $result_name) {
					if ($str = $data[$tipe_team][$key][$result_name]) {
						$count = substr_count( $str, "," )+1;
						$data[$tipe_team][$key][$result_name]= $count;
					}
				}
				//summation results
				$data[$tipe_team][$key]['wins'] = $data[$tipe_team][$key]['home_win']+$data[$tipe_team][$key]['visitor_win'];
				$data[$tipe_team][$key]['loses'] = $data[$tipe_team][$key]['home_loss']+$data[$tipe_team][$key]['visitor_loss'];
				$data[$tipe_team][$key]['ties'] = $data[$tipe_team][$key]['home_ties']+$data[$tipe_team][$key]['visitor_ties'];

				//counting the number of wins as a percentage
				$number_of_games = $data[$tipe_team][$key]['wins']+$data[$tipe_team][$key]['loses']+$data[$tipe_team][$key]['ties'];
				if ($number_of_games) {
					$data[$tipe_team][$key]['average'] = round(100/($number_of_games)*$data[$tipe_team][$key]['wins']);
				} else {
					$data[$tipe_team][$key]['average'] = 0;
				}	
			}
    	}
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