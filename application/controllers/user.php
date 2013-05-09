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

			if ($this->user_model->is_user_exist($this->input->post('username')) == false) {
				$this->user_model->insert_user();
				$data['title'] = "Login";
				$data['error'] = "";
				$this->load->view("template/header", $data);
				$this->load->view('login', $data);
				$this->load->view("template/footer", $data);
			}else{
				$data['title'] = "Login";
				$data['error'] = "sudah ada pengguna dengan nama '".$this->input->post('username')."' , gunakan nama lain";
				$this->load->view("template/header", $data);
				$this->load->view("daftar", $data);
				$this->load->view("template/footer", $data);
			}

			
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

					$link_edit = "<a href='".$base_url."index.php/jadwal/edit/".$id_jadwal."'>edit</a>";
					$link_copy = "<a href='".$base_url."index.php/jadwal/copy/".$id_jadwal."'>copy</a>";

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
					$foto_teman = "img/kosong.png";

					if ($userdata_teman->photo != 0) {
						$foto_teman = "photo/".$userdata_teman->photo;
					}

					$foto_view = "<img src='".base_url().$foto_teman."' width='40px' height='40px'/>";

					$link_teman = base_url()."index.php/user/u/".$username_teman;

					$tampil_teman .= "<a class='info' href='$link_teman'>
										".$foto_view."
										<span>".$username_teman."</span>
									 </a>";

				}

				$foto = $data_user->photo;
				$foto_tampil = "";
				if ($foto == 0) {
					$foto_tampil = "<img src='".base_url()."img/kosong.png' width='80px' height='80px'/>";
				}else{
					$foto_tampil = "<img src='".base_url()."photo/".$foto."' width='80px' height='80px'/>";
				}


				$data['teman'] = $tampil_teman;
				$data['photo'] = $foto_tampil;

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
			$data['error'] = "";
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

				$foto = $data_pengguna->photo;
				$foto_tampil = "";
				if ($foto == 0) {
					$foto_tampil = "<img src='".base_url()."img/kosong.png' width='80px' height='80px'/>";
				}else{
					$foto_tampil = "<img src='".base_url()."photo/".$foto."' width='80px' height='80px'/>";
				}
				$data['photo'] = $foto_tampil;

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
		 *	Edit password
		 */
		public function edit_pass(){

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {
				$username = $this->session->userdata("username");

				$datauser = $this->user_model->select_user($username);

				$data['username'] = $username;

				//data edit
				$pass_lama = $this->input->post('pass_lama');
				$pass_baru1 = $this->input->post('pass_baru1');
				$pass_baru2 = $this->input->post('pass_baru2');


				$data['error'] = "";

				//cek pass lama sama
				if ($this->user_model->cek_username_password($username, $pass_lama)) {
					//cek pass baru 1 dan 2 sama
					if ($pass_baru1 == $pass_baru2) {
						$this->user_model->ganti_password($username, $pass_baru1);
						$data['error'] = "Password telah diedit";
					}else{
						$data['error'] = "Password baru harus sama keduanya";
					}	
				}else{
					$data['error'] = "Password lama tidak benar";
				}
								
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
		 *	Edit gambar
		 */
		public function edit_photo(){

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {
				$username = $this->session->userdata("username");

				$datauser = $this->user_model->select_user($username);

				$data['username'] = $username;

				
				$data['error'] = "";


				$namafolder= "photo/"; //folder tempat menyimpan file

				/****   UPLOAD GAMBAR  *****/

				  if (!empty($_FILES["photo"]["tmp_name"]))
				  {
				      $jenis_gambar=$_FILES['photo']['type'];
				      if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
				      {      

				      	  $basename_gambar = $datauser->user_id.basename($_FILES['photo']['name']);
				          $gambar = $namafolder .$basename_gambar;
				          if (move_uploaded_file($_FILES['photo']['tmp_name'], $gambar)) {
				              
				              //file yang lama dihapus
				              $foto_lama = $datauser->photo;

				              if ($foto_lama !=  "0") {
				              		unlink($namafolder.$foto_lama);
				              }

			              	//simpan nama gambar di database
				            $this->user_model->simpan_update_user($datauser->user_id, array("photo"=>$basename_gambar));
				           	$data['error'] = "Foto berhasil diupload";

				          } else {
				             $data['error'] = "Foto gagal diupload";
				          }

				      } else {
				          $data['error'] = "Foto harus berjenis .jpg .gif .png";
				      }
				  
				  }else {
				        $data['error'] = "Anda belum memilih gambar";
				  }


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

		/*
		 *  Action
		 *
		 *	hapus teman
		 */
		public function del_friend(){
			$friend_username = $this->uri->segment(3);

			//mengecek login
			if ($this->session->userdata('LOGGED_IN')) {
				$username = $this->session->userdata("username");
				$datauser = $this->user_model->select_user($username);

				$friend_datauser = $this->user_model->select_user($friend_username);
				
				$query = $this->teman_model->delete_teman($datauser->user_id, $friend_datauser->user_id);

				if ($query) {
					redirect("user/u/".$friend_username);
				}

			}
		}
		
		//to do logout process
		function logout() {
			$this->session->sess_destroy();
			$data['error'] = 'Anda telah keluar.';
			$this->load->view("template/header", $data);
			$this->load->view('login', $data);
			$this->load->view("template/footer", $data);
		}
	}
?>