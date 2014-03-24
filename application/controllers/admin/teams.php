<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('admin/division'); 
		$this->load->model('admin/team'); 
		if ($this->session->userdata('role') != 'admin') redirect(base_url('admin/game_schedule'));
    }

	/**
	 * displays a table of teams
     * @param get this information about filtering
     * @return array this list of teams
	*/
	function index(){
		$filter_data = '';
		$filter_names = array('id', 'league_type_id', 'status');

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
		$config['total_rows'] = $this->team->count_filtered($data['filter']);

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
		$config['base_url'] = base_url('admin/teams?limit='.$limit.'&'.$filter_data);
		$config['query_string_segment'] = 'per_page';
		$config['per_page'] = $limit; 

		//initialize pagination
		$this->pagination->initialize($config);
		//add to array list of filtered teams 
		$data['teams'] = $this->team->get_list($config['per_page'], $this->input->get('per_page'), $data['filter']);
		//add to array list of all divisions
		$data['list'] = $this->division->names_list();
		//add to array number show pages
		$data['limit'] = $limit;
		//add to array filter information
		$data['filter_data'] = $filter_data;
		//print_r($data['teams'][0]['home_win']);
		$result_names = ['home_win', 'visitor_win', 'home_loss', 'visitor_loss', 'home_ties', 'visitor_ties'];
		//iterate teams
		foreach ($data['teams'] as $key => $value) {
			//iterate through all the possible outcomes
			foreach($result_names as $result_name) {
				if ($str = $data['teams'][$key][$result_name]) {
					$count = substr_count( $str, "," )+1;
					$data['teams'][$key][$result_name]= $count;
				}
			}
			//summation results
			$data['teams'][$key]['wins'] = $data['teams'][$key]['home_win']+$data['teams'][$key]['visitor_win'];
			$data['teams'][$key]['loses'] = $data['teams'][$key]['home_loss']+$data['teams'][$key]['visitor_loss'];
			$data['teams'][$key]['ties'] = $data['teams'][$key]['home_ties']+$data['teams'][$key]['visitor_ties'];

			//counting the number of wins as a percentage
			$number_of_games = $data['teams'][$key]['wins']+$data['teams'][$key]['loses']+$data['teams'][$key]['ties'];
			if ($number_of_games) {
				$data['teams'][$key]['average'] = round(100/($number_of_games)*$data['teams'][$key]['wins']);
			} else {
				$data['teams'][$key]['average'] = 0;
			}	
		}

		$this->load->view('admin/teams', $data);
	}
	/**
	 * performs mass action
     * @param Post this the action and selected teams id
     * @return ...
	*/
	function action(){
		switch($this->input->post('action')){
			case 'delete':
				$this->team->delete($this->input->post('team_ids'));
	  			redirect(base_url('admin/teams'));
	  			break;
			case 'active':
				$data['id'] = $this->input->post('team_ids');
				$data['status']['status'] = '1';
				$this->team->update_status($data);
	  			redirect(base_url('admin/teams'));
	  			break;
			case 'inactive':
				$data['id'] = $this->input->post('team_ids');
				$data['status']['status'] = '0';
				$this->team->update_status($data);
	  			redirect(base_url('admin/teams'));
				break;		 
		} 
	}
	/**
	 * add team to db
     * @param Post this team data
     * @return error or success
	*/
	function add(){
		// if form is submitted
		if ($data = $this->input->post()) {
			// generates an array of data to write to the database
			$team = $this->process_team_data();

			$this->load->library('form_validation');
			$this->load->library('validation');
			//check the validity of data
			if($this->validation->team_validate()) {
				$team_id = $this->team->add($team);
				$this->session->set_flashdata('success', 'Add success');		
				redirect(base_url('admin/teams/edit?id='.$team_id));
			}
		} 
		//load data to fill in a form
		$data['list'] = $this->division->names_list();
		//if the form is not submitted or  data are not valid	
		$this->load->view('admin/add_team', $data);
	}
	/**
	 * delete team from db
     * @param Post this team id
     * @return ...
	*/
	function delete(){
		$this->team->delete($this->input->post('id'));
	}
	/**
	 * edit team data in db
     * @param Post this team data, and Get this team id
     * @return error or success
	*/
	function edit(){
		// if form is submitted
		if ($data = $this->input->post()) {
			// generates an array of data to write to the database
			$team = $this->process_team_data();

			$this->load->library('form_validation');
			$this->load->library('validation');
			//check the validity of data
			if($this->validation->team_validate()) {
				//if the data are valid update the db
				$this->team->edit($this->input->get('id'), $team);
				$this->session->set_flashdata('success', 'Edit success');

				redirect(base_url('admin/teams/edit?id='.$this->input->get('id')));
			}
		}
		//load data to fill in a form
		$data['team_data'] = $this->team->team_data($this->input->get('id'));
		$data['division_list'] = $this->division->names_list();
		//if the form is not submitted or  data are not valid	
		$this->load->view('admin/edit_team', array('data' => $data));
	}
	/**
	 * generates an array of data to write to the database
     * @param Post this team data
     * @return array this team data
	*/
	private function process_team_data() {
		$fields_names = ['name', 'division_id', 'league_type_id', 'status', 'is_visitor'];
		foreach($fields_names as $field) {
			$team[$field] = $this->input->post($field);
		}
		return $team;
	}
}