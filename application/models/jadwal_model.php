<?php
class jadwal_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	//mengambil jadwal berdasaekan user tertentu
	function select_by_user($username){
		$this->db->order_by('id_jadwal', 'desc');
		$data = $this->db->get_where('jadwal', array('username' => $username));
		return $data->result();
	}
	
	//menambah jadwal baru
	function insert_jadwal($data){
		$this->db->insert('jadwal', $data);
	}
	
	//edit jadwal
	function edit_jadwal($id_jadwal){
		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->update('jadwal', $data); 
		
	}
	
	//hapus jadwal
	function hapus_jadwal($data){
		$query = $this->db->delete('jadwal',$data);
	}
	
	//ambil jam mulai
	function ambil_jam_mulai($id_jadwal){
		$query = $this->db->query('select time_format(jam_mulai,' '%H:%i'')from jadwal where id_jadwal=$id_jadwal');
	}
	
	//ambil jam akhir
	function ambil_jam_akhir($id_jadwal){
		$query = $this->db->query('select time_format(jam_akhir,' '%H:%i'')from jadwal where id_jadwal=$id_jadwal');
	}
}
?>