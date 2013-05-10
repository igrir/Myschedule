		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Daftar</span>
					<br/>

					<?php echo $error ?>
				</center>


				<div class="tengah">	
					<form method="POST" action="<?php echo base_url()?>index.php/user/add_user">
						<span class="abu">Username</span><br/>
						<input type="text" name="username" class="input-form"/><br/>
						
						<span class="abu">Password</span><br/>
						<input type="password" name="password" class="input-form"/><br/>
						
						<span class="abu">Bio</span><br/>
						<textarea type="text" name="bio" class="input-form"></textarea><br/>

						<input type="submit" class="input-button" value="daftar"/>
					</form>
				</div>
				
				<center>
					<span class="info">
						<a href="#">Anda pengguna baru? Daftar disini</a>
					</span>
				</center>

			</div>

