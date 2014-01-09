<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	function index(){
		$this->load->helper('form');
		$this->load->view('admin/auth');
		if ($this->session->userdata('id')==1){
			redirect(base_url('admin/menu'));
		} else { 
			if (($this->input->post('email') == 'admin@admin.com') && ($this->input->post('password') == 'admin')) {
				$this->session->set_userdata('id', '1');
				redirect(base_url('admin/menu'));
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