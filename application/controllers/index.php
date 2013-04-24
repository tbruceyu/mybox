<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	public function index()	{
		$data['css'] = 'index.css';
	    $data['title'] = 'My box demo';
	    $data['js'] = array('index.js');
	    $data['main_content'] = 'index_view';
	    $this->load->view('includes/template_view',$data);
	}
	public function login() {
		$this->load->view('login_view');
	}
	public function do_login() {
		redirect('index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */