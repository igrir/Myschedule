		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Daftar</span>
					<br/>

				</center>


				<div class="tengah">	
					<form method="POST" action="<?php echo base_url()?>index.php/user/add_user">
						<span class="abu">Username</span><br/>
						<input type="text" class="input-form"/><br/>
						<span class="abu">Password</span><br/>
						<input type="text" class="input-form"/><br/>
						<span class="abu">Password</span><br/>
						<input type="text" class="input-form"/><br/>
						<span class="abu">Bio</span><br/>
						<textarea class="input-form"></textarea><br/>

						<input type="submit" class="input-button" value="daftar"/>
					</form>
				</div>
				
				<center>
					<span class="info">
						<a href="#">Anda pengguna baru? Daftar disini</a>
					</span>
				</center>

			</div>

