<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('admin/division'); 
		$this->load->model('admin/team'); 
    }
	function index(){
		if ($this->session->userdata('id')==1){
			

			$filter_data = '';
			$filter_names = array('id', 'league_type_id', 'status');
			foreach($filter_names as $filter_name) {
			 	$current_filter_name = $this->input->get($filter_name);
			 	if (strlen($current_filter_name)) {
			 		$filter_data = $filter_data.$filter_name.'='.$current_filter_name.'&';
			 		$data['filter'][$filter_name] = $current_filter_name;
			 	} else {
			 		$data['filter'][$filter_name] = '';
			 	}
			}

			$config['total_rows'] = $this->team->count_filtered($data['filter']);
			if ($limit = $this->input->get('limit')) { 
				if ($limit == 'all') $limit = $config['total_rows'];
			} else {
				$limit = 10;
			}

			$config['page_query_string'] = TRUE;
			$config['first_link'] = 'To start';
			$config['last_link'] = 'To end';
			$config['next_link'] = 'next';
			$config['prev_link'] = 'previous';
			$config['uri_segment'] = 4;
			$config['base_url'] = base_url('admin/teams?limit='.$limit.'&'.$filter_data);
			$config['query_string_segment'] = 'per_page';
			$config['per_page'] = $limit; 
			$this->pagination->initialize($config); 
			$data['divisions'] = $this->team->get_list($config['per_page'], $this->input->get('per_page'), $data['filter']);
			$data['list'] = $this->division->names_list();
			$data['limit'] = $limit;
			$data['filter_data'] = $filter_data;
			$this->load->view('admin/teams', $data);
		} else {
			redirect(base_url('admin/auth'));
		}
	}
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
	function add(){
		if ($this->session->userdata('id')==1){
			if ($data = $this->input->post()) {
				$team = $this->process_team_data();
				$this->team->add($team);
				$this->session->set_flashdata('item', 'Add success');		
				redirect(base_url('admin/teams'));
			} else {
				$data['list'] = $this->division->names_list();
				$this->load->view('admin/add_team', $data);
			}
		} else {
			redirect(base_url('admin/auth'));
		}

	}
	function delete(){
		if ($this->session->userdata('id')==1){
			$this->team->delete($this->input->post('id'));
		} else {
			redirect(base_url('admin/auth'));
		}
	}

	function edit(){
		if ($this->session->userdata('id')==1){
			if ($data = $this->input->post()) {
				$team = $this->process_team_data();
				$this->team->edit($this->input->get('id'), $team);
				$this->session->set_flashdata('item', 'Edit success');		
				redirect(base_url('admin/teams/edit?id='.$this->input->get('id')));
			} else {
				$data['team_data'] = $this->team->team_data($this->input->get()['id']);
				$data['division_list'] = $this->division->names_list();
				$this->load->view('admin/edit_team', array('data' => $data));
			}
		} else {
			redirect(base_url('admin/auth'));
		}

	}
	private function process_team_data() {
		$fields_names = ['name', 'division_id', 'league_type_id', 'status', 'is_visitor'];
		foreach($fields_names as $field) {
			$team[$field] = $this->input->post($field);
		}
		return $team;
	}
}