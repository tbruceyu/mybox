<?php
class Account extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model("list_account_model");
	}
	public function list_account($ajax=0) {
		if ($ajax == 1) {
			$accounts_array = $this->list_account_model->get_list_account();
			$json_array = array();
				foreach($accounts_array as $accounts_row) {
					$json_array[] = array('id'=>$accounts_row->id,
										 'username' => $accounts_row->username,
										 'password' => $accounts_row->password,
										 'type' => $accounts_row->type,
										 'client_id' => $accounts_row->client_id,
										 'client_secret'=>$accounts_row->client_secret
									);
				}
			echo json_encode($json_array);
		} else {
			$view_data = array('main_content'=>'admin/list_account_view');
		$this->load->view('include/template_view', $view_data);
		}
	}
	public function add_account() {
		$account['id'] = $this->input->post('id');
		$account['username'] = $this->input->post('username');
		$account['password'] = $this->input->post('password');
		$account['type'] = $this->input->post('type');
		$account['client_id'] = $this->input->post('client_id');
		$account['client_secret'] = $this->input->post('client_secret');
		$this->load->model('list_account_model');
		if ($this->list_account_model->add($account)){
			echo json_encode($account);
		} else {
			echo json_encode(array('errorMsg'=>'Error!'));
		}
	}
	public function update_account() {
		$old_id = $_GET['id'];
		$account['id'] = $this->input->post('id');
		$account['username'] = $this->input->post('username');
		$account['password'] = $this->input->post('password');
		$account['type'] = $this->input->post('type');
		$account['client_id'] = $this->input->post('client_id');
		$account['client_secret'] = $this->input->post('client_secret');
		$this->load->model('list_account_model');
		if ($this->list_account_model->update_account($account,$old_id)){
			echo json_encode($account);
		} else {
			echo json_encode(array('errorMsg'=>'Error!'));
		}
	}
	public function destroy_account() {
		$accountid = $this->input->post('id');
		$this->load->model('list_account_model');
		$result = array();
		if ($this->list_account_model->delete_account($accountid)) {
			$result['success'] = true;
		} else {
			$result['errorMsg'] = "Error!";
		}
		echo json_encode($result);
	}
}