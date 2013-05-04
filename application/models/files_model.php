<?
class Files_model extends CI_Model {
	function get_byuser_dir($user_id, $dir_id) {
		$result = $this->db->get_where('files', array('user_id'=>$user_id, 'dir_id'=>$dir_id));
		return $result->result();
	}
}
