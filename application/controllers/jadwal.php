<?php 

class jadwal extends CI_Controller {

	public function index()
	{
		

		$data['title'] = 'jadwal';

		//menampilkan view
		$this->load->view('template/header', $data);

		echo "coba kawan";

		$this->load->view('template/footer', $data);

	}

	/*
	 *  PAGE
	 *
	 *	Edit jadwal
	 */
	public function edit(){
		$data['title'] = "Edit Jadwal";
		$this->load->view("template/header", $data);
		$this->load->view("template/header_bar", $data);
		$this->load->view("edit_jadwal", $data);
		$this->load->view("template/footer", $data);
	}

	/*
	 *  PAGE
	 *
	 *	Tambah jadwal
	 */
	public function tambah(){
		$data['title'] = "Tambah Jadwal";
		$this->load->view("template/header", $data);
		$this->load->view("template/header_bar", $data);
		$this->load->view("tambah_jadwal", $data);
		$this->load->view("template/footer", $data);
	}
	
	function __Construct()
	{
        parent ::__construct();
	}
	//insert jadwal
    function tambah_jadwal()
    {
        $data['judul'] = 'Insert Data User';
        $this->load->view('user', $data);
    }

    function simpan_jadwal()
    {   
        $this->load->model('jadwal_model');
        $this->jadwal_model->insert_jadwal();
        $data['judul']='Insert Data Berhasil';
        $this->load->view('notifikasi', $data);
    }
	
	//update jadwal
	function update_jadwal()
    {
        $this->load->model('jadwal_model');
        $data['judul'] = 'Tambah Jadwal';
        $data['tambah_jadwal'] = $this->jadwal_model->select_by_user();
        $this->load->view('tambah_jadwal', $data);
    }

    function edit_jadwal($id_user)
    {
        $data['judul']='Update Jadwal';
        $this->load->model('jadwal_model');
        $data['edit_jadwal']=$this->jadwal_model->edit_jadwal($id_jadwal);
        $this->load->view('edit_jadwal', $data);
    }

    function simpan_edit_jadwal()
    {
        $id_jadwal = $this->input->post('id_jadwal');
        $nama_jadwal = $this->input->post('nama_jadwal');
        $hari = $this->input->post('hari');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_akhir = $this->input->post('jam_akhir');
        
        $data['judul'] = 'Update Jadwal';
        $this->load->model('jadwal_model');
        $data['update'] = $this->jadwal_model->simpan_edit_jadwal($id_jadwal, $nama_jadwal, $hari, $jam_mulai, $jam_akhir);        
        $this->load->view('update', $data);
    }
	
}

?>