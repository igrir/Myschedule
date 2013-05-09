		<div id="content">

			<div id="login">
					
				<div id="profil-bar">

					<div id="profil-kiri" class="kiri">
						<div id="profil-photo">
							<img src="<?php echo base_url()?>photo/ratna.jpg" width="80px" height="80px"/>
						</div>
					</div>
					
					<div id="profil-kanan" class="kiri">

						<div id="profil-username">@<?php echo $dat_username?>
						
						<?php


						//cek bukan profil sendiri
						if ($this->session->userdata('username') != $dat_username) {
							//cek sudah pernah ditemani
							$userdata1 = $this->user_model->select_user($this->session->userdata('username'));
							$userdata2 = $this->user_model->select_user($dat_username);

							if (! $this->teman_model->is_teman($userdata1->user_id, $userdata2->user_id) ) {
							?>
							<a href="<?php echo base_url()?>index.php/user/add_friend/<?php echo $dat_username?>" class="teman-button">+teman</a>
						<?php
							}
						}
						?>
						</div>
						<div id="profil-bio"><?php echo $dat_bio?></div>

					</div>
					
					

					<div class="clear"></div>
				</div>

				<div class="menu-jadwal">
					<a href="<?php echo base_url()?>index.php/jadwal/tambah">+ Tambah Jadwal</a>
				</div>


				<div id="jadwal-scroll">
					<div id="jadwal-container">

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Senin
								</span>
							</div>

							<?php echo $jadwal_senin?>

						</div>		

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Selasa
								</span>
							</div>

							<?php echo $jadwal_selasa?>

						</div>		

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Rabu
								</span>
							</div>

							<?php echo $jadwal_rabu?>

						</div>	

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Kamis
								</span>
							</div>

							<?php echo $jadwal_kamis?>

						</div>	

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Jumat
								</span>
							</div>

							<?php echo $jadwal_jumat?>

						</div>	

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Sabtu
								</span>
							</div>

							<?php echo $jadwal_sabtu?>

						</div>	

						<div class="jadwal-card">
							<div class="judul-jadwal">
								<span class="judul">
									Minggu
								</span>
							</div>

							<?php echo $jadwal_minggu?>

						</div>	



						<div class="clear"></div>
					</div> <!--jadwal container-->
				</div> <!--jadwal scroll-->

				<div>
					<span class="judul">Teman</span>
				</div>

				<div id="friend-list">
					<?php echo $teman ?>
					<!-- <a class="info" href="#">
						<img src="<?php echo base_url()?>photo/ratna.jpg" width="40px" height="40px"/>
						<span>@ratnaasri</span>
					</a> -->
					
				</div>

			</div>	
