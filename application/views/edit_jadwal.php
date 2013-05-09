		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Edit jadwal</span>
					<br/>

				</center>


				<div class="tengah">	

					<form>
						<span class="abu">Nama jadwal</span><br/>
						<input type="text" class="input-form" value="<?php echo $nama_jadwal?>"/><br/>
						<span class="abu">Hari</span><br/>
						<select class="input-form">
							<option>Senin</option>
							<option selected>Selasa</option>
							<option>Rabu</option>
							<option>Kamis</option>
							<option>Jumat</option>
							<option>Sabtu</option>
							<option>Minggu</option>
						</select>
						<br/>
						<span class="abu">Jam mulai</span><br/>
						<input type="text" class="input-form" value="<?php echo $jam_mulai?>"/><br/>
						<span class="abu">Jam akhir</span><br/>
						<input type="text" class="input-form" value="<?php echo $jam_akhir?>"/><br/>


						<input type="submit" class="input-button" value="Edit jadwal"/>
					</form>

				</div>
				

			</div>
