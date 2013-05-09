<?php
	
	//untuk handle API

	class user extends CI_Controller{

		public function __construct(){
			parent::__construct();   

			//load model database user
			$this->load->model('user_model');
			$this->load->library('session');
			$this->load->model('jadwal_model');
			$this->load->model('teman_model');
		}

		public function login(){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->cek_username_password($username,$password)) {

				//data untuk kebutuhan session
				$userdata = array('username'=>$username,
								  'LOGGED_IN'=>true);

				$this->session->set_userdata($userdata);

				$data['error']='';
				$data['title'] = "Jadwal";
				
				redirect('user');

			} else {
				$data['error']='Tidak ada username atau password tersebut';
				$this->load->view('login', $data);
				$this->load->view("template/header", $data);
				$this->load->view("template/footer", $data);
			}
		}
		
		public function add_user(){   
			$this->load->model('user_model');
			$this->user_model->insert_user();
			$data['title'] = "Login";
			$data['error'] = "";
			$this->load->view("template/header", $data);
			$this->load->view('login', $data);
			$this->load->view("template/footer", $data);
		}
		


		/*
		 *  PAGE
		 *
		 *	Halaman utama user (Jadwal dari user berada di sini)
		 */
		public function index(){
			$username = $this->session->userdata("username");

			redirect('user/u/'.$username);

		}


		/*
		 *  PAGE
		 *
		 *	Halaman berdasarkan user yang dicari
		 */
		public function u(){
			$data['title'] = "Jadwal";

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {

				
				
				$data['username'] = $this->session->userdata('username');
				

				$data['jadwal_senin'] = "";
				$data['jadwal_selasa'] = "";
				$data['jadwal_rabu'] = "";
				$data['jadwal_kamis'] = "";
				$data['jadwal_jumat'] = "";
				$data['jadwal_sabtu'] = "";
				$data['jadwal_minggu'] = "";

				$dat_username = $this->uri->segment(3);
				$data_user = $this->user_model->select_user($dat_username);

				$data['dat_username'] = $data_user->username;
				$data['dat_bio'] = $data_user->bio;

				foreach($this->jadwal_model->select_by_user($data_user->user_id) as $data_jadwal){
					$j_nama = $data_jadwal->nama_jadwal;
					$j_jam_mulai = $data_jadwal->jam_mulai;
					$j_jam_akhir = $data_jadwal->jam_akhir;

					$base_url = base_url();
					$id_jadwal = $data_jadwal->id_jadwal;

					$link_edit = "<a href='".$base_url."index.php/jadwal/edit/".$id_jadwal."'> edit </a>";
					$link_copy = "copy";

					if ($dat_username != $this->session->userdata('username')) {
						$link_edit = "";
					}
					if ($dat_username == $this->session->userdata('username')) {
						$link_copy = "";
					}

					$tampil_jadwal = "<div class='jadwal-content'>
										<span class='jadwal-judul'>".$j_nama."</span><br/>
										<span class='jadwal-waktu'>".$j_jam_mulai."-".$j_jam_akhir."</span><br/>
										<span class='jadwal-menu'>".$link_edit.$link_copy."												
										</span>
										<br/>
									  </div>";

					switch ($data_jadwal->hari) {
						case 1:
							$data['jadwal_senin'] .= $tampil_jadwal;
							break;
						case 2:
							$data['jadwal_selasa'] .= $tampil_jadwal;
							break;
						case 3:
							$data['jadwal_rabu'] .= $tampil_jadwal;
							break;
						case 4:
							$data['jadwal_kamis'] .= $tampil_jadwal;
							break;
						case 5:
							$data['jadwal_jumat'] .= $tampil_jadwal;
							break;
						case 6:
							$data['jadwal_sabtu'] .= $tampil_jadwal;
							break;
						case 7:
							$data['jadwal_minggu'] .= $tampil_jadwal;
							break;
					}

				};

				$tampil_teman = "";

				foreach($this->teman_model->select_teman_by_user($data_user->user_id) as $data_teman){

					$userdata_teman = $this->user_model->select_user_by_id($data_teman->uid_2);

					$username_teman = $userdata_teman->username;
					$foto_teman = "ratna.jpg";
					$link_teman = base_url()."index.php/user/u/".$username_teman;

					$tampil_teman .= "<a class='info' href='$link_teman'>
										<img src='".base_url()."photo/".$foto_teman."' width='40px' height='40px'/>
										<span>".$username_teman."</span>
									 </a>";

				}

				$data['teman'] = $tampil_teman;

				$this->load->view("template/header", $data);
				$this->load->view("template/header_bar", $data);
				$this->load->view("jadwal", $data);
				$this->load->view("template/footer", $data);
			}else{
				redirect('myschedule');
			}

			
		}
		
		
		public function daftar(){
			$data['title'] = "Daftar";
			$this->load->view("template/header", $data);
			$this->load->view("daftar", $data);
			$this->load->view("template/footer", $data);
		}

		/*
		 *  PAGE
		 *
		 *	Edit user
		 */
		public function edit(){
			$data['title'] = "Edit user";
			$data['error'] = "";

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {
				$username = $this->session->userdata("username");
				$data['username'] = $username;

				//data yang ditampilkan di halaman edit
				$data_pengguna = $this->user_model->select_user($username);

				$data['bio'] = $data_pengguna->bio;

				$this->load->view("template/header", $data);
				$this->load->view("template/header_bar", $data);
				$this->load->view("edit_user", $data);
				$this->load->view("template/footer", $data);
			}
		}

		/*
		 *  Action
		 *
		 *	Edit bio
		 */
		public function edit_bio(){

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {
				$username = $this->session->userdata("username");

				$datauser = $this->user_model->select_user($username);

				$data['username'] = $username;

				//data edit
				$bio = $this->input->post('bio');

				$this->user_model->simpan_update_user($datauser->user_id, array('bio'=>$bio));

				

				$data['error'] = "Bio telah diedit";
				//data yang ditampilkan di halaman edit
				$data_pengguna = $this->user_model->select_user($username);

				$data['bio'] = $data_pengguna->bio;

				$this->load->view("template/header", $data);
				$this->load->view("template/header_bar", $data);
				$this->load->view("edit_user", $data);
				$this->load->view("template/footer", $data);

			}
		}


		/*
		 *  Action
		 *
		 *	Tambah teman
		 */
		public function add_friend(){
			$friend_username = $this->uri->segment(3);

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {
				$username = $this->session->userdata("username");
				$datauser = $this->user_model->select_user($username);

				$friend_datauser = $this->user_model->select_user($friend_username);
				
				$query = $this->teman_model->insert_teman($datauser->user_id, $friend_datauser->user_id);

				if ($query) {
					redirect("user/u/".$friend_username);
				}

			}
		}
		
		//to do logout process
		function logout() {
			$this->session->sess_destroy();
			$data['error'] = 'You have been logged out.';
			$this->load->view("template/header", $data);
			$this->load->view('login', $data);
			$this->load->view("template/footer", $data);
		}
	}
?>