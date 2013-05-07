<?php
class kategori_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	//mengambil kategori berdasarkan user tertentu
	function select_kategori_by_user($username){
		$this->db->order_by('id_kategori', 'desc');
		$data = $this->db->get_where('kategori', array('username' => $username));
		return $data->result();
	}
	
	//menambah kategori
	function insert_kategori($data){
		$this->db->insert('kategori', $data);
	}
	
	
}
?>