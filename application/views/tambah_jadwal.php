		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Tambah jadwal</span>
					<br/>

				</center>


				<div class="tengah">	

					<form action="<?php echo base_url()?>index.php/jadwal/add_jadwal" method="POST">
						<span class="abu">Nama jadwal</span><br/>
						<input type="text" class="input-form" name="nama_jadwal"/><br/>
						<span class="abu">Hari</span><br/>
						<select class="input-form" name="hari">
							<option value="1">Senin</option>
							<option value="2">Selasa</option>
							<option value="3">Rabu</option>
							<option value="4">Kamis</option>
							<option value="5">Jumat</option>
							<option value="6">Sabtu</option>
							<option value="7">Minggu</option>
						</select>
						<br/>
						<span class="abu">Jam mulai (format JJ:MM:SS)</span><br/>
						<input type="text" class="input-form" name="jam_mulai"/><br/>
						<span class="abu">Jam akhir (format JJ:MM:SS)</span><br/>
						<input type="text" class="input-form" name="jam_akhir"/><br/>


						<input type="submit" class="input-button" value="Tambah jadwal"/>
					</form>

				</div>
				
				<center>
					<span class="info">
						<a href="#">Anda pengguna baru? Daftar disini</a>
					</span>
				</center>

			</div>