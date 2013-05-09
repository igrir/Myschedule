
		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>

					<span class="judul">Edit user</span>
					<br/>
					<br/>
					<span class="alert"><?php echo $error ?></span><br/>

				</center>


				<div class="tengah">	

					<form action="<?php echo base_url()?>index.php/user/edit_bio" method="POST">	
						<span class="abu">Bio</span><br/>
						<textarea class="input-form" name="bio"><?php echo $bio?></textarea><br/>

						<input type="submit" class="input-button" value="Edit bio"/>
					</form>
					<hr/>

					<form action="<?php echo base_url()?>index.php/user/edit_photo" method="post" enctype="multipart/form-data" name="FormUpload" id="FormUpload">
						<span class="abu">Gambar</span><br/>
						<center>
							<?php echo $photo?><br/>
							<br/>
						</center>
						<input type="file" name="photo">
						<br/>
						<input type="submit" class="input-button" value="Upload gambar"/>
					</form>
					
					<hr/>
					<form action="<?php echo base_url()?>index.php/user/edit_pass" method="POST">
						<span class="abu">Password lama</span><br/>
						<input type="password" class="input-form" name="pass_lama"/><br/>
						<span class="abu">Password baru</span><br/>
						<input type="password" class="input-form" name="pass_baru1"/><br/>
						<span class="abu">Password baru</span><br/>
						<input type="password" class="input-form" name="pass_baru2"/><br/>

						<input type="submit" class="input-button" value="Edit password"/>
					</form>

				</div>
				

			</div>
