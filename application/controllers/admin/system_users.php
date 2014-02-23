<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_users extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('admin/division');
		$this->load->model('admin/system_user');
		$this->load->model('admin/roles');
		$this->load->library('parser');
		if (!$this->session->userdata('id')) redirect(base_url('admin/auth'));
    }
	function index(){		
		$filter_data = '';
		$filter_names = array('division', 'role');
		foreach($filter_names as $filter_name) {
		 	$current_filter_name = $this->input->get($filter_name);
		 	if (strlen($current_filter_name)) {
		 		$filter_data = $filter_data.$filter_name.'='.$current_filter_name.'&';
		 		$data['filter'][$filter_name] = $current_filter_name;
		 	} else {
		 		$data['filter'][$filter_name] = '';
		 	}
		}

		$config['total_rows'] = $this->system_user->count_filtered($data['filter']);
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
		$config['base_url'] = base_url('admin/system_users?limit='.$limit.'&'.$filter_data);
		$config['query_string_segment'] = 'per_page';
		$config['per_page'] = $limit; 
		$this->pagination->initialize($config); 
		$data['system_users'] = $this->system_user->get_list($config['per_page'], $this->input->get('per_page'), $data['filter']);
		$data['divisions'] = $this->division->names_list();
		$data['roles'] = $this->system_user->roles_list();
		$data['limit'] = $limit;
		$data['filter_data'] = $filter_data;
		$this->load->view('admin/system_users', $data);
	}
	function action(){
		switch($this->input->post('action')){
			case 'delete':
				$this->system_user->delete($this->input->post('system_user_ids'));
	  			redirect(base_url('admin/system_users'));
	  			break;
			case 'active':
				$data['id'] = $this->input->post('system_user_ids');
				$data['status']['status'] = '1';
				$this->system_user->update_status($data);
	  			redirect(base_url('admin/system_users'));
	  			break;
			case 'inactive':
				$data['id'] = $this->input->post('system_user_ids');
				$data['status']['status'] = '0';
				$this->system_user->update_status($data);
	  			redirect(base_url('admin/system_users'));
				break;		 
		} 
	}
	function add(){
		// if form is submitted
		if ($data = $this->input->post()) {

			// generates an array of data to write to the database
			$user = $this->process_user_data();

			$this->load->library('form_validation');
			$this->load->library('validation');



			if($this->validation->user_validate()) {

				//default status
				$user['status'] = 1;
				$user['password'] = System_user::encrypt_pass($user['password']);

				//adding a user to the database and save id to variable
				$data_role['user_id'] = $this->system_user->add($user);

				//number assigned roles
				$number_of_roles = count($this->input->post('role'));

				//set the counter to zero
				$counter = 0;			
				if ($data['role'][0]) {
					do {

						//create an array of datas role
						$data_role['role_id'] = $data['role'][$counter];
						$data_role['division_id'] = $data['div'][$counter];
						$data_role['team_id'] = $data['team'][$counter];

						//verify the existence of the role
						if (count($this->roles->check_existence_role($data_role))){
							$this->session->set_flashdata('error', 'Role already exists');
						} else {

							//if the role does not exist then add
							$this->roles->add($data_role);
						}
					} while (++$counter < $number_of_roles);
				}
				$this->session->set_flashdata('success', 'User has been created');
				redirect(base_url('admin/system_users/edit?id='.$data_role['user_id']));
			}
		}
			//if the form is not submitted or  data are not valid
			$data['divisions'] = $this->division->names_list();				
			$data['states'] = $this->system_user->states_list();
			$data['roles'] = $this->system_user->roles_list();
			$this->load->view('admin/add_user', $data);
	}
	function delete(){
		$this->system_user->delete($this->input->post('id'));
	}

	function edit(){
		if ($data = $this->input->post()) {
			$user = $this->process_user_data();
			$this->system_user->edit($this->input->get('id'), $user);
			$this->session->set_flashdata('item', 'Edit success');		

			$data_role['user_id'] = $this->input->get('id');
			$number_of_roles = count($this->input->post('role'));
			$counter = 0;

			//adding roles
			if ($data['role'][0]) {
				do {
					$data_role['role_id'] = $data['role'][$counter];
					$data_role['division_id'] = $data['div'][$counter];
					$data_role['team_id'] = $data['team'][$counter];
					if (count($this->roles->check_existence_role($data_role))){
						$this->session->set_flashdata('error', 'Role already exists');
					} else {
						$this->roles->add($data_role);
					}
				} while (++$counter < $number_of_roles);
			}
			redirect(base_url('admin/system_users/edit?id='.$this->input->get('id')));
		} else {
			$data['divisions']		  = $this->division->names_list();
			$data['roles']			  = $this->system_user->roles_list();
			$data['states'] 		  = $this->system_user->states_list();
			$data['user_data']  	  = $this->system_user->user_data($this->input->get()['id']);
			$data['roles_by_user_id'] = $this->roles->roles_by_user_id($this->input->get('id'));

			$this->load->view('admin/edit_user', $data);
		}
	}
	function get_teams_for_division_id(){
		$division_id = $this->input->post('div_id');
		$teams_in_division = $this->system_user->get_teams_for_division_id($division_id);
		echo json_encode($teams_in_division);
	}
	function delete_role(){
		$this->roles->delete($this->input->post('id'));
	}
	private function process_user_data() {
		$fields_names = ['first_name', 'last_name', 'address', 'city', 'state_id', 'zipcode', 'email', 'home_phone', 'cell_phone', 'alt_phone', 'password', 'alt_first_name', 'alt_last_name', 'alt_email', 'alt_phone_2'];
		foreach($fields_names as $field) {
			$team[$field] = $this->input->post($field);
		}
		return $team;
	}
	/**
     * checks for a email in the database,
     * @param string $email
     * @return TRUE or FALSE and info  email is busy
     */
	function email_check($str) {
		if(!$this->system_user->get_email_by_id($str)) {
			echo 'true';
			return TRUE;
		} else {
			$this->form_validation->set_message('email_check', 'The email is busy');
			echo 'false';
			return FALSE;
		}
	}
    /**
     * checks for a email in the database,
     * @param string $email
     * @return TRUE or FALSE
     */
	function email_jq_check(){
		$request_email = trim($this->input->post('email'));
		if($this->system_user->get_email_by_id($request_email)) {
			echo 'false';
		} else {
			 echo 'true';
		}
	}
	/**
     * check phone for validate
     * @param string 
     * @return TRUE or FALSE
     */
	function phone_check($str) {
		if (preg_match("/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/",$str) || !$str) {
			return TRUE;
			} else {
				$this->form_validation->set_message('phone_check', 'Please specify a valid phone number');
				return FALSE;
			}

	}
}