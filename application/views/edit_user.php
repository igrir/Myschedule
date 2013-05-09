
		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Edit user</span>
					<br/>

				</center>


				<div class="tengah">	

					<form action="<?php echo base_url()?>index.php/user/edit_bio" method="POST">	
						<span class="abu">Bio</span><br/>
						<textarea class="input-form" name="bio"><?php echo $bio?></textarea><br/>

						<input type="submit" class="input-button" value="Edit bio"/>
					</form>
					<hr/>
					<form>	
						<span class="abu">Gambar</span><br/>
						<input type="file">

						<input type="submit" class="input-button" value="Edit gambar"/>
					</form>
					<hr/>
					<form>
						<span class="abu">Password lama</span><br/>
						<input type="text" class="input-form"/><br/>
						<span class="abu">Password baru</span><br/>
						<input type="text" class="input-form"/><br/>
						<span class="abu">Password baru</span><br/>
						<input type="text" class="input-form"/><br/>

						<input type="submit" class="input-button" value="Edit password"/>
					</form>

				</div>
				

			</div>
