<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_users extends CI_Controller {
	function index(){
		if ($this->session->userdata('id')==1){
			$this->load->view('admin/system_users');
		} else {
			redirect(base_url('admin/auth'));
		}
	}
}