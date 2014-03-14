<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game_schedule extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('admin/division');
		$this->load->model('admin/schedule_game');
		$this->load->model('admin/roles');
		$this->load->model('admin/team');
		$this->load->model('admin/additional_requests');
		$this->load->library('parser');
		if (!$this->session->userdata('id')) redirect(base_url('admin/auth'));
    } 

	/**
	 * displays a table of games
     * @param get this information about filtering
     * @return array this list of games
	*/
	function index(){		
		$filter_data = '';
		$filter_names = array('division', 'team', 'league', 'date');

		//create an array with informations about filtering
		foreach($filter_names as $filter_name) {
		 	$current_filter_name = $this->input->get($filter_name);

		 	//if there is a filter add it to a string and array
		 	if (strlen($current_filter_name)) {
		 		$filter_data = $filter_data.$filter_name.'='.$current_filter_name.'&';
		 		$data['filter'][$filter_name] = $current_filter_name;
		 	} else {
		 		$data['filter'][$filter_name] = '';
		 	}
		}

		// number of filtered rows
		$config['total_rows'] = $this->schedule_game->count_filtered($data['filter']);
		//determination  the numbers of shown  pages 
		if ($limit = $this->input->get('limit')) { 
			if ($limit == 'all') $limit = $config['total_rows'];
		} else {
			$limit = 10;
		}

		// pagination configuration array
		$config['page_query_string'] = TRUE;
		$config['first_link'] = 'To start';
		$config['last_link'] = 'To end';
		$config['next_link'] = 'next';
		$config['prev_link'] = 'previous';
		$config['uri_segment'] = 4;
		$config['base_url'] = base_url('admin/game_schedule?limit='.$limit.'&'.$filter_data);
		$config['query_string_segment'] = 'per_page';
		$config['per_page'] = $limit; 

		//initialize pagination
		$this->pagination->initialize($config); 
		//add to array list of filtered games 
		$data['schedule'] = $this->schedule_game->get_list($config['per_page'], $this->input->get('per_page'), $data['filter']);

		//add to array divisions list
		$data['divisions'] = $this->division->names_list();
		//add to array teams list
		$data['teams'] = $this->team->names_list();
		//add to array number show pages
		$data['limit'] = $limit;
		//add to array filter information
		$data['filter_data'] = $filter_data;
		$this->load->view('admin/game_schedule', $data);

	} 

	/**
	 * add game to db
     * @param Post this game data
     * @return error or success
	*/
	function add(){
		// if form is submitted
		if ($data = $this->input->post()) {
			// generates an array of data to write to the database
			$game_data = $this->process_game_data();

			$this->load->library('form_validation');
			$this->load->library('validation');

			//check the validity of data
			if($this->validation->game_validate()) {

				$date = DateTime::createFromFormat('m/d/Y', $game_data['date']);
				$game_data['date'] = $date->format('Y-m-d');

				//adding a game to the database and save id to variable
				$data_game['game_id'] = $this->schedule_game->add($game_data);
				//if the data is successfully added
				if ($data_game['game_id']) {
					$this->session->set_flashdata('success', 'Game has been created');
					redirect(base_url('admin/game_schedule/edit?id='.$data_game['game_id']));
				}
			}
		}
			//if the form is not submitted or  data are not valid
			$data['divisions'] = $this->division->names_list();	
			$data['location'] = $this->additional_requests->names_list();	
			$this->load->view('admin/add_game', $data);
	}

	/**
	 * edit game data in db
     * @param Post this game data, and Get this game id
     * @return error or success
	*/
	function edit(){
		// if form is submitted

		if ($data_post = $this->input->post()) {

			// generates an array of data to write to the database
			$game_data = $this->process_game_data();

			$this->load->library('form_validation');
			$this->load->library('validation');

			//check the validity of data
			if($this->validation->game_validate()) {

				$date = DateTime::createFromFormat('m/d/Y', $game_data['date']);
				$game_data['date'] = $date->format('Y-m-d');

				//if the data is successfully added
				if ($this->schedule_game->edit($this->input->get('id'), $game_data)) {
					$this->session->set_flashdata('success', 'Edit game successfully');	
				} else {
					$this->session->set_flashdata('error', 'Database error');
				}				
				redirect(base_url('admin/game_schedule/edit?id='.$this->input->get('id')));
				
			}
		}

		//loading game data
		$data['game_data'] = $this->schedule_game->game_data($this->input->get('id'));
		$data['teams'] = $this->additional_requests->get_teams_for_division_id($data['game_data'][0]['division_id']);

		$date = DateTime::createFromFormat('Y-m-d', $data['game_data'][0]['date']);
		$data['game_data'][0]['date'] = $date->format('m/d/Y');

		$data['divisions'] = $this->division->names_list();	
		$data['location'] = $this->additional_requests->names_list();
		$this->load->view('admin/edit_game', $data);
	}

	/**
	 * performs mass action
     * @param Post this the action and selected user id
     * @return ...
	*/
	function action(){
		switch($this->input->post('action')){
			case 'delete':
				$this->schedule_game->delete($this->input->post('game_schedul_ids'));
	  			redirect(base_url('admin/game_schedule'));
	  			break;
			case 'active':
				$data['id'] = $this->input->post('game_schedul_ids');
				$data['status']['status'] = '1';
				$this->schedule_game->update_status($data);
	  			redirect(base_url('admin/game_schedule'));
	  			break;
			case 'inactive':
				$data['id'] = $this->input->post('game_schedul_ids');
				$data['status']['status'] = '0';
				$this->schedule_game->update_status($data);
	  			redirect(base_url('admin/game_schedule'));
				break;		 
		} 
	}

	/**
	 * edit result game in db
     * @param Post this result game, and Get this game id
     * @return error or success
	*/	
	function results(){
		// if form is submitted
		if ($data_post = $this->input->post()) {
			// generates an array of data
			$result['home_team_result'] = $this->input->post('home_team_result');
			$result['visitor_team_result'] = $this->input->post('visitor_team_result');

			$this->load->library('form_validation');
			$this->load->library('validation');
			//check the validity of data
			if($this->validation->result()) {
				//if the data is successfully added
				if ($this->schedule_game->edit($this->input->get('id'), $result)) {
					$this->session->set_flashdata('success', 'Add results successfully');
				} else {
					$this->session->set_flashdata('error', 'Database error');
				}
			}
			redirect(base_url('admin/game_schedule'));
		}
		$data['game_data'] = $this->schedule_game->teams_by_id_game($this->input->get('id'));
		$this->load->view('admin/game_result', $data);
	}

	/**
	 * generates an array of data to write to the database
     * @param Post this user data
     * @return array this user data
	*/
	private function process_game_data() {
		$fields_names = ['practice', 'date', 'time', 'division_id', 'home_team_id', 'visitor_team_id', 'location_id'];
		foreach($fields_names as $field) {
			$game[$field] = $this->input->post($field);
		}
		return $game;
	}

	/**
     * checks for a email in the database,
     * @param string $email
     * @return TRUE or FALSE and info  email is busy
     */


	function date_check($str) {
		$date = DateTime::createFromFormat('m/d/Y', $str);
		$timestamp = strtotime($date->format('d-m-Y'));
		if($timestamp && ($timestamp >= time())) {
			return TRUE;
		} else {
			$this->form_validation->set_message('date_check', 'Incorrect date.');
			return FALSE;
		}
	}

	/**
     * check phone for validate
     * @param string 
     * @return TRUE or FALSE
     */
	function time_check($str) {
		if (preg_match("/(2[0-3]|[01][0-9]):[0-5][0-9]/", $str)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('time_check', 'Incorrect time.');
			return FALSE;
		}
	}

}
