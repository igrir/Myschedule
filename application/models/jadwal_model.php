<?php
class jadwal_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	
	//mengambil jadwal berdasarkan user tertentu
	function select_by_user($user_id){
		$this->db->order_by('id_jadwal', 'desc', 'nama_jadwal', 'hari', 'jam_mulai', 'jam_akhir');
		$data = $this->db->get_where('jadwal', array('user_id' => $user_id));
		return $data->result();
	}
	
	//menambah jadwal baru
	function insert_jadwal($data){
		$query = $this->db->insert('jadwal', $data);

		return $query;
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
		// $query = $this->db->query('select time_format(jam_mulai,' '%H:%i'')from jadwal where id_jadwal=$id_jadwal');
	}
	
	//ambil jam akhir
	function ambil_jam_akhir($id_jadwal){
		// $query = $this->db->query('select time_format(jam_akhir,' '%H:%i'')from jadwal where id_jadwal=$id_jadwal');
	}
}
?>