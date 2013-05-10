
		<div id="content">


			<div id="login">
				<center>

					<img src="<?php echo base_url()?>img/logo.png"/>
					<br/><br/>
				
					<span class="judul">Login</span>
					<br/>

				</center>


				<div class="tengah">
					<?php echo $error?>

					<form method="POST" action="<?php echo base_url()?>index.php/user/login">
						<span class="abu">Username</span><br/>
						<input type="text" name="username" class="input-form"/><br/>
						<span class="abu">Password</span><br/>
						<input type="password" name="password" class="input-form"/><br/>
						<input type="submit" class="input-button" value="login"/>
					</form>
				</div>
				
				<center>
					<span class="info">
						<a href="<?php echo base_url()?>index.php/user/daftar">Anda pengguna baru? Daftar disini</a>
					</span>
				</center>

			</div>