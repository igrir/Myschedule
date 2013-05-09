<?php
class teman_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	//mengambil teman berdasarkan user tertentu
	function select_teman_by_user($user_id){
		$data = $this->db->get_where('teman', array('uid_1' => $user_id));
		return $data->result();
	}
	
	//menambah teman baru
	function insert_teman($uid1, $uid2){
		$query = $this->db->insert('teman', array('uid_1'=>$uid1, 'uid_2'=>$uid2));
		return $query;
	}

	//mengecek apakah $uid1 sudah berteman dengan $uid2
	function is_teman($uid1, $uid2){
		$query = $this->db->get_where('teman', array('uid_1'=>$uid1, 'uid_2'=>$uid2));

		$result = $query->num_rows();

		if ($result == 1) {
			return true;
		}else{
			return false;
		}
	}
	
	
}
?>