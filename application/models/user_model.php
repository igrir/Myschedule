<?php
class user_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	//cek username dan password untuk login
	function cek_username_password($username, $password){
		$query = $this->db->get_where('user', array('username' => $username, 'password' => $password));
		if($query->num_rows()== 1){
			return true;
		}else{
			return false;
		}
	}
	
	//insert user
	function insert_user(){
		$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'bio' => $this->input->post('bio'),
				'photo' => $this->input->post('photo'),
				);
		$this->db->insert('user',$data);
	}
	
	//update user
	function select_user($username){
		$this->db->select('user_id, username, bio, photo');
		$query = $this->db->get_where('user', array('username' => $username));
		return $query->row();
	}

	
	// function simpan_update_user($username, $data){
		// $this->db->where('username', $username);
	// }
	function is_user_exist($username){
		$this->db->select('user_id, username, bio, photo');
		$query = $this->db->get_where('user', array('username' => $username));
		$hasil = $query->num_rows();

		if ($hasil > 0) {
			return true;
		}else{
			return false;
		}
	}

	function select_user_by_id($user_id){
		$this->db->select('user_id, username, bio, photo');
		$query = $this->db->get_where('user', array('user_id' => $user_id));
		return $query->row();
	}


	//update user
	function simpan_update_user($user_id, $data){
		$this->db->where('user_id', $user_id);
		$this->db->update('user', $data);
	}
	
	//ganti password
	function ganti_password($username, $password){
		$this->db->where('username', $username);
		$this->db->update('user', array('password'=>$password));
	}
}
?>