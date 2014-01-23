<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	function index(){
		if ($this->session->userdata('id')==1){
			redirect(base_url('admin/system_users'));
		} else { 
			$this->load->view('admin/auth');
			if (($this->input->post('email') == 'admin@admin.com') && ($this->input->post('password') == 'admin')) {
				$this->session->set_userdata('id', '1');
				redirect(base_url('admin/system_users'));
			} else {
				$this->session->set_flashdata('error', 'Incorrect login or password');
			}
		}
	}
	function logout(){
		$this->session->unset_userdata('id');
		redirect(base_url());
	}
}