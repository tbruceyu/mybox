<?php
class Files extends CI_Controller {
	public $user_id;
	
	public function __construct() {
		parent::__construct();
		$this->user_id = 2;
	}
	public function list_files($dir_id) {
//		$this->load->library('box', array('client_id'=>"41a8gnjftgmms40s8sapcyz0iftl78z9", 
//										  'client_secret'=>"fAeduj4Yfty4dUPaopDcfyfhIHi8SqU3"));
//		$this->box->get_code();
		$this->load->model('files_model');
		$files = $this->files_model->get_byuser_dir(2, 0);
		$path = "ROOT";
		$view_data = array('title'=>'My Files', 'main_content'=>'files_list_view', 'files'=>$files, "path"=>$path);
		$this->load->view('include/template_view', $view_data);
		
	}
	
}