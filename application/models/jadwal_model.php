<?php
class jadwal_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	//mengambil jadwal berdasarkan user tertentu
	function select_by_user($user_id){
		$this->db->order_by('jam_mulai');
		$data = $this->db->get_where('jadwal', array('user_id' => $user_id));
		return $data->result();
	}
	
	//mengambil jadwal berdasarkan id tertentu
	function select_by_id($id_jadwal){
		$query = $this->db->get_where('jadwal', array('id_jadwal' => $id_jadwal));
		return $query->row();
	}

	//menambah jadwal baru
	function insert_jadwal($data){
		$query = $this->db->insert('jadwal', $data);

		return $query;
	}

	//edit jadwal
	function edit_jadwal($id_jadwal, $data){
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->update('jadwal', $data); 
		
	}
	
	//hapus jadwal
	function hapus_jadwal($id_jadwal){
		$query = $this->db->delete('jadwal',array('id_jadwal' => $id_jadwal));
		return $query;
	}

}
?>