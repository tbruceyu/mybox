<?php
class Files extends CI_Controller {
	public function list_files() {
		$this->load->library('box', array('client_id'=>"41a8gnjftgmms40s8sapcyz0iftl78z9", 
											  'client_secret'=>"fAeduj4Yfty4dUPaopDcfyfhIHi8SqU3"));
		$this->box->get_code();
	}

}