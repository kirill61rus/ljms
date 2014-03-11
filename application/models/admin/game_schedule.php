<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_game extends CI_Model {

    /**
     * loads the divisionss from the database
     * @return array  this divisions list
     */
    function names_list() {
		return $this->db->select('name')
						->select('id')
		    			->get('divisions')
		    			->result_array();
    }
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
				 ->select('users.email')
				 ->select('users.id')
				 ->group_by('users.id');

		$this->users_filter($filter);

		return $this->db->get('users', $num, $offset)
						->result_array();
	}

	function users_filter($filter) {
		if(strlen($filter['division'])){
			$this->db->where('roles_to_users.division_id', $filter['division']);
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
	function get_teams_for_division_id($id){
		return $this->db->where('division_id', $id)
						->select('id, name')
						->get('teams')->result_array();
	}
    public static function encrypt_pass($pass) {
    	return md5($pass);
	}
}