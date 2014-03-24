<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_user extends CI_Model {

    function states_list() {
		return $this->db->select('name')
						->select('id')
		    			->get('states')
		    			->result_array();
    }
    function roles_list() {
		return $this->db->select('name')
						->select('id')
		    			->get('roles')
		    			->result_array();
    }
    function count_filtered($filter) {
    	if ($filter['division'] || $filter['role'])  $this->db->join('roles_to_users', 'roles_to_users.user_id = users.id', 'left'); 	
    	$this->users_filter($filter);
    	return $this->db->count_all_results('users');
    }
	function get_list($num, $offset, $filter) {	

		$this->db->join('roles_to_users', 'roles_to_users.user_id = users.id', 'left')
				 ->join('roles', 'roles.id = roles_to_users.role_id', 'left')
				 ->join('divisions', 'divisions.id = roles_to_users.division_id', 'left')
				 ->join('teams', 'teams.id = roles_to_users.team_id', 'left')
				 ->select('GROUP_CONCAT(roles.name ORDER BY roles.id SEPARATOR "|||") as role_name', false)
				 ->select('GROUP_CONCAT(divisions.name ORDER BY roles.id SEPARATOR "|||") as division_name', false)
				 ->select('GROUP_CONCAT(teams.name ORDER BY roles.id SEPARATOR "|||") as team_name', false)
				 ->select('users.last_name as last_name')
				 ->select('users.first_name as first_name')
				 ->select('users.home_phone')
				 ->select('users.status')
				 ->select('users.email')
				 ->select('users.id')
				 ->group_by('users.last_name');

		$this->users_filter($filter);

		return $this->db->get('users', $num, $offset)
						->result_array();
	}

	function auth($email, $password){
		$this->db->join('roles_to_users', 'roles_to_users.user_id = users.id', 'left');
		$this->db->select('GROUP_CONCAT(roles_to_users.role_id) as roles', false);
		$this->db->select('GROUP_CONCAT(roles_to_users.division_id) as divisions', false);
		$this->db->select('users.id');
   		$this->db->where('email', $email);
   		$this->db->where('password', $password)
   				 ->group_by('users.id');
		$result = $this->db->get('users')->result_array();
		
		return (empty($result)) ? FALSE : $result;
	}

	function users_filter($filter) {
		if(strlen($filter['division'])){
			$this->db->where('roles_to_users.division_id', $filter['division']);
		}
		if(strlen($filter['role'])){
			$this->db->where('roles_to_users.role_id', $filter['role']);
		}
	}
	function update_status($data) {
		$this->db->where_in('id', $data['id']);
		 $this->db->update('users', $data['status']);
	}
	function add($data) {
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	function edit($id, $data) {
		$this->db->where('id', $id);
		 $this->db->update('users', $data);
		return $this->db->insert_id();
	}

	function delete($id) {
		$this->db->where_in('id', $id);
		return $this->db->delete('users'); 

	}
    function get_email_by_id($email) {
        return $this->db->select('id')
        				->where('email', $email)
        				->get('users')
        				->result_array();
    }
	function user_data($id) {
		$this->db->where('id', $id);
		return $this->db->get('users')->result_array();
	}
    public static function encrypt_pass($pass) {
    	return md5($pass);
	}
}