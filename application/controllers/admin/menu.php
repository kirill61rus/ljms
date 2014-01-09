<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
	function index(){
		if ($this->session->userdata('id')==1){
			$this->load->helper('form');
			$this->load->view('admin/menu');
		} else {
			redirect(base_url('admin/auth'));
		}
	}
}