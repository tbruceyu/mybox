<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_index extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function index()	{
		$data['css'] = 'index.css';
	    $data['title'] = 'My box demo';
	    $data['js'] = array('index.js');
	    $data['main_content'] = 'admin/admin_index_view';
	    $this->load->view('include/template_view',$data);
	}
	public function login() {
		$this->load->view('login_view');
	}
	public function do_login() {
		redirect('index');
	}
}
