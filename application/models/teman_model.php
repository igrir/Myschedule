<?php
class teman_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	//mengambil teman berdasarkan user tertentu
	function select_teman_by_user($username){
		$this->db->order_by('uid_1', 'desc');
		$data = $this->db->get_where('teman', array('username' => $username));
		return $data->result();
	}
	
	//menambah teman baru
	function insert_teman($data){
		$this->db->insert('teman', $data);
	}
	
	
}
?>