<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Roles extends CI_Model {

		function add($data) {
			$this->db->insert('roles_to_users', $data);
			return $this->db->insert_id();
		}   

		function roles_by_user_id($id){
			$this->db->join('roles', 'roles.id = roles_to_users.role_id');
			$this->db->join('divisions', 'divisions.id = roles_to_users.division_id', 'left');
			$this->db->join('teams', 'teams.id = roles_to_users.team_id', 'left');
			$this->db->where('user_id', $id);
			$this->db->select('roles.name as role_name');
			$this->db->select('roles_to_users.id');
			$this->db->select('divisions.name as division_name');
			$this->db->select('teams.name as team_name');
			return $this->db->get('roles_to_users')->result_array();
		} 
		function delete($id) {
			$this->db->where_in('id', $id);
			return $this->db->delete('roles_to_users'); 
		}
		function check_existence_role($data_role) {
			$this->role_filter($data_role);

			return $this->db->get('roles_to_users')
							  ->result_array();
		}
		function role_filter($filter) {

			if($filter['role_id'] == 1 || $filter['role_id'] == 5){
				$this->db->where('roles_to_users.user_id', $filter['user_id']);
				$this->db->where('roles_to_users.role_id', $filter['role_id']);
			}
			if($filter['role_id'] == 4 || $filter['role_id'] == 3){
				$this->db->where('roles_to_users.division_id', $filter['division_id']);
				$this->db->where('roles_to_users.team_id', $filter['team_id']);
			}
			if($filter['role_id'] == 2){
				$this->db->where('roles_to_users.division_id', $filter['division_id']);
			}
		}
	}