<?php
class List_account_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get_list_account($table="mybox_account") {
		$result = $this->db->select("*")
				 ->from($table)
				 ->get();
		$cases = FALSE;
		if ($result->num_rows == 0) {
			$cases = FALSE;
		} else {
			$cases = $result->result();
		}
		return $cases;
	}
	function add($account, $table='mybox_account') {
		return $this->db->insert($table, $account);
	}
	function update_account($account,$old_id,$table='mybox_account') {
		$this->db->where('id', $old_id);
		if($this->db->update($table, $account)) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
	function delete_account($accountid, $table='mybox_account') {
		$this->db->where('id', $accountid);
		return $this->db->delete($table);
	}
	
}