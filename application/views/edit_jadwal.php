		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Edit jadwal</span>
					<br/>

				</center>


				<div class="tengah">	

					<form action="<?php echo base_url()?>index.php/jadwal/edit_jadwal" method="POST">
						<span class="abu">Nama jadwal</span><br/>
						<input type="text" class="input-form" value="<?php echo $nama_jadwal?>" name="nama_jadwal"/><br/>
						<span class="abu">Hari</span><br/>
						<select class="input-form" name="hari">
							<option value="1" <?php if ($hari == 1) echo 'selected'?> >Senin</option>
							<option value="2" <?php if ($hari == 2) echo 'selected'?>>Selasa</option>
							<option value="3" <?php if ($hari == 3) echo 'selected'?>>Rabu</option>
							<option value="4" <?php if ($hari == 4) echo 'selected'?>>Kamis</option>
							<option value="5" <?php if ($hari == 5) echo 'selected'?>>Jumat</option>
							<option value="6" <?php if ($hari == 6) echo 'selected'?>>Sabtu</option>
							<option value="7" <?php if ($hari == 7) echo 'selected'?>>Minggu</option>
						</select>
						<br/>
						<span class="abu">Jam mulai (format JJ:MM:SS)</span><br/>
						<input type="text" class="input-form" name="jam_mulai" value="<?php echo $jam_mulai?>"/><br/>
						<span class="abu">Jam akhir (format JJ:MM:SS)</span><br/>
						<input type="text" class="input-form" name="jam_akhir" value="<?php echo $jam_akhir?>"/><br/>

						<input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal?>"/>
						<input type="submit" class="input-button" value="Edit jadwal"/>
					</form>

				</div>
				

			</div>
