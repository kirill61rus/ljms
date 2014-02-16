<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisions extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('admin/division'); 
    }
	function index(){
		if ($this->session->userdata('id')==1){
			

			$filter_data = '';
			$filter_names = array('id', 'season', 'status');
			foreach($filter_names as $filter_name) {
			 	$current_filter_name = $this->input->get($filter_name);
			 	if (strlen($current_filter_name)) {
			 		$filter_data = $filter_data.$filter_name.'='.$current_filter_name.'&';
			 		$data['filter'][$filter_name] = $current_filter_name;
			 	} else {
			 		$data['filter'][$filter_name] = '';
			 	}
			}
			// number of filtered rows
			$config['total_rows'] = $this->division->count_filtered($data['filter']);
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
			$config['base_url'] = base_url('admin/divisions?limit='.$limit.'&'.$filter_data);
			$config['query_string_segment'] = 'per_page';
			$config['per_page'] = $limit; 
			$this->pagination->initialize($config); 
			$data['divisions'] = $this->division->get_list($config['per_page'], $this->input->get('per_page'), $data['filter']);
			$data['list'] = $this->division->names_list();
			$data['limit'] = $limit;
			$data['filter_data'] = $filter_data;
			$this->load->view('admin/divisions', $data);
		} else {
			redirect(base_url('admin/auth'));
		}
	}
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

	function add(){
		if ($this->session->userdata('id')==1){
			if ($data = $this->input->post()) {
				$division = $this->process_division_data();
				$logo_format_validation = 'callback_image_check';
				if (empty($division['logo'])){ unset($division['logo']); $logo_format_validation ='';}
				$this->load->library('form_validation');
				$this->load->library('division_validation');
				if($this->division_validation->set_validation_rules($logo_format_validation)) {

					$division_id = $this->division->add($division);
					$this->session->set_flashdata('success', 'Division has been created');		
					redirect(base_url('admin/divisions/edit?id='.$division_id));
				} else {
					$this->load->view('admin/add_division');
				}
			} else {
				$this->load->view('admin/add_division');
			}
		} else {
			redirect(base_url('admin/auth'));
		}

	}
	function delete(){
		if ($this->session->userdata('id')==1){
			$this->division->delete($this->input->post('id'));
		} else {
			redirect(base_url('admin/auth'));
		}
	}
	function delete_logo(){
		if ($this->session->userdata('id')==1){
			$this->division->delete_logo($this->input->post('division_id'));
		} else {
			redirect(base_url('admin/auth'));
		}
	} 

	function edit(){
		if ($this->session->userdata('id')==1){
			if ($data = $this->input->post()) {
				$division = $this->process_division_data();
				$logo_format_validation = 'callback_image_check';
				if (empty($division['logo'])){ unset($division['logo']); $logo_format_validation ='';}

				$this->load->library('form_validation');
				$this->load->library('division_validation');
				if($this->division_validation->set_validation_rules($logo_format_validation)) {

					$this->division->edit($this->input->get('id'), $division);
					$this->session->set_flashdata('success', 'Edit division successfully');			
					redirect(base_url('admin/divisions/edit?id='.$this->input->get('id')));
				} else {
					$division_data = $this->division->division_data($this->input->get()['id']);
					$this->load->view('admin/edit_division', array('division_data' => $division_data));
				}				
			} else {
				$division_data = $this->division->division_data($this->input->get()['id']);
				$this->load->view('admin/edit_division', array('division_data' => $division_data));
			}
		} else {
			redirect(base_url('admin/auth'));
		}

	}
	private function process_division_data() {
		$this->load->library('logo');
		$fields_names = ['status', 'fall_ball', 'name', 'age_from', 'age_to', 'description', 'rules', 'base_fee', 'addon_fee'];
		foreach($fields_names as $field) {
			$division[$field] = $this->input->post($field);
		}
		$division['logo'] = $this->logo->upload_logo();
		return $division;
	}
	function age_check() {
		if ($this->input->post('age_to') <= $this->input->post('age_from')) {
			$this->form_validation->set_message('age_check', 'Incorrect years interval');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	function image_check() {
		if($_FILES['userfile']['type'] != 'image/jpeg'
		&&  $_FILES['userfile']['type'] != 'image/jpg'
		&&  $_FILES['userfile']['type'] != 'image/gif'
		&& $_FILES['userfile']['type'] != 'image/png'){
		 	$this->form_validation->set_message('image_check', 'Incorrect image format! Select jpg, png or gif');
		     return FALSE;
		}  else {
			return TRUE;
			}
		}
	}

