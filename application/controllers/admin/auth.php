<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	function index(){
		if ($this->session->userdata('id')){
			redirect(base_url('admin/system_users'));
		} 
		if ($this->input->post()){
				$this->load->model('admin/system_user');
				$email    = $this->input->post('email');
				$password = System_user::encrypt_pass($this->input->post('password'));
				if($userData = $this->system_user->auth($email, $password)) {

						if(preg_match('/1/', $userData[0]['roles'])) {
							$userdata = array('id' =>$userData[0]['id'], 'role' => 'admin');
							$this->session->set_userdata($userdata);
							redirect(base_url('admin/system_users'));

						} elseif (preg_match('/4/', $userData[0]['roles'])) {

							$userdata = array('id' =>$userData[0]['id'], 'role' => 'manager', 'divisions' => $userData[0]['divisions']);
							$this->session->set_userdata($userdata);
							redirect(base_url('admin/game_schedule'));

						} elseif (preg_match('/3/', $userData[0]['roles'])) {
							$userdata = array('id' =>$userData[0]['id'], 'role' => 'coach', 'divisions' => $userData[0]['divisions']);
							$this->session->set_userdata($userdata);
							redirect(base_url('admin/game_schedule'));

						} else {
				$this->session->set_flashdata('error_small', 'Incorrect email/password');
				redirect(base_url('admin'));
				}
			}
		}
		$this->load->view('admin/auth');		
	}
	function logout(){
		$array_items = array('id' => '', 'role' => '', 'divisions' =>'');
		$this->session->unset_userdata($array_items);
		redirect(base_url());
	}
}