<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisions extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('admin/division'); 
		if (!$this->session->userdata('id')) redirect(base_url('admin/auth'));
    }
	/**
	 * displays a table of divisions
     * @param get this information about filtering
     * @return array this list of divisions
	*/
	function index(){

		$filter_data = '';
		$filter_names = array('id', 'season', 'status');

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
		$config['total_rows'] = $this->division->count_filtered($data['filter']);

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
		$config['base_url'] = base_url('admin/divisions?limit='.$limit.'&'.$filter_data);
		$config['query_string_segment'] = 'per_page';
		$config['per_page'] = $limit; 

		//initialize pagination
		$this->pagination->initialize($config); 
		
		//add to array list of filtered divisions
		$data['divisions'] = $this->division->get_list($config['per_page'], $this->input->get('per_page'), $data['filter']);
		//add to array list of all divisions
		$data['list'] = $this->division->names_list();
		//add to array number show pages
		$data['limit'] = $limit;
		//add to array filter information
		$data['filter_data'] = $filter_data;
		$this->load->view('admin/divisions', $data);
	}
	/**
	 * performs mass action
     * @param Post this the action and selected divisons id
     * @return ...
	*/
	function action(){
		switch($this->input->post('action')){
			case 'delete':
				$this->division->delete($this->input->post('division_ids'));
	  			redirect(base_url('admin/divisions'));
	  			break;
			case 'active':
				$data['id'] = $this->input->post('division_ids');
				$data['status']['status'] = '1';
				$this->division->update_status($data);
	  			redirect(base_url('admin/divisions'));
	  			break;
			case 'inactive':
				$data['id'] = $this->input->post('division_ids');
				$data['status']['status'] = '0';
				$this->division->update_status($data);
	  			redirect(base_url('admin/divisions'));
				break;		 
		} 
	}
	/**
	 * add division to db
     * @param Post this division data
     * @return error or success
	*/
	function add(){
		// if form is submitted
		if ($data = $this->input->post()) {
			// generates an array of data to write to the database
			$division = $this->process_division_data();

			$this->load->library('form_validation');
			$this->load->library('validation');
			//check the validity of data
			if($this->validation->division_validate()) {
				//processes the image and adds a link to an array
				$division = $this->process_logo($division);
				//add data to db if are valid
				$division_id = $this->division->add($division);
				$this->session->set_flashdata('success', 'Division has been created');	

				redirect(base_url('admin/divisions/edit?id='.$division_id));
			} 
		} 
		//if the form is not submitted or  data are not valid	
		$this->load->view('admin/add_division');
	}
	/**
	 * delete division from db
     * @param Post this division id
     * @return ...
	*/
	function delete(){
		$this->division->delete($this->input->post('id'));
	}
	/**
	 * delete logo 
     * @param Post this division id
     * @return ...
	*/
	function delete_logo(){
		$this->division->delete_logo($this->input->post('division_id'));
	} 
	/**
	 * edit division data in db
     * @param Post this division data, and Get this division id
     * @return error or success
	*/
	function edit(){
		// find division by ID for autoComplete form
		$division_data = $this->division->get_division_data_by_id($this->input->get('id'));
		// if form is submitted
		if ($data = $this->input->post()) {
			// generates an array of data to write to the database
			$division = $this->process_division_data();
			
			$this->load->library('form_validation');
			$this->load->library('validation');
			//check the validity of data
			if($this->validation->division_validate()) {
				//processes the image and adds a link to an array
				$division = $this->process_logo($division);
				//if the data are valid update the db
				$this->division->edit($this->input->get('id'), $division);
				$this->session->set_flashdata('success', 'Edited division');	

				redirect(base_url('admin/divisions/edit?id='.$this->input->get('id')));
			}		
		} 
		//if the form is not submitted or  data are not valid			
		$this->load->view('admin/edit_division', array('division_data' => $division_data));
	}
	/**
	 * generates an array of data to write to the database
     * @param Post this division data
     * @return array this division data
	*/
	private function process_division_data() {
		$this->load->library('logo');
		$fields_names = ['status', 'fall_ball', 'name', 'age_from', 'age_to', 'description', 'rules', 'base_fee', 'addon_fee'];
		foreach($fields_names as $field) {
			$division[$field] = $this->input->post($field);
		}
		return $division;
	}
	/**
	 * processes the image and adds a link to an array
     * @param download file
     * @return altered image this link or error
	*/
	private function process_logo($division) {
		//if the file is selected
		if (!empty($_FILES['userfile']['name'])) {
			$division['logo'] = $this->logo->upload_logo();
			//if the image format is not valid delete information about it from the array
			if (empty($division['logo'])) unset($division['logo']);
		}
		return $division;
	}
	/**
	 * checks the years interval
     * @param age from and age to. (Post)
     * @return True or False
	*/
	function age_check() {
		if ($this->input->post('age_to') <= $this->input->post('age_from')) {
			$this->form_validation->set_message('age_check', 'Incorrect years interval');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}