<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	function index(){
		if ($this->session->userdata('id')==1){
			redirect(base_url('admin/system_users'));
		} else { 
			if ($this->input->post()){
					if (($this->input->post('email') == 'admin@admin.com') && ($this->input->post('password') == 'admin')) {
					$this->session->set_userdata('id', '1');
					redirect(base_url('admin/system_users'));
				} else {
					$this->session->set_flashdata('error_small', 'Incorrect email/password');
					redirect(base_url('admin'));
				}
			} else {
				$this->load->view('admin/auth');
			}
		}
	}
	function logout(){
		$this->session->unset_userdata('id');
		redirect(base_url());
	}
}