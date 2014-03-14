<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('admin/additional_requests');
        $this->load->model('admin/schedule_game');
    }

    function index(){
    	$data['date'] = $this->input->get('dates');
    	$data['schedule'] = $this->schedule_game->game_by_date($data['date']);
    	$this->load->view('calendar', $data);
    }


    function get_dates(){

		if (isset($_GET['year'])) {$year =$_GET['year']; 
		if ($year == '') { unset($year);}}
		if (isset($_GET['month'])) {
			$month =$_GET['month']; 
			if ($month == '') {
				unset($month);
			} elseif ($month < 10) {
				$month = '0'.$month;				
			}
		}

    	$dates = $this->additional_requests->date_this_game($year, $month);
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
}