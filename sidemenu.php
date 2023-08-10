<?php
if(isset($_SESSION[$session])){
	if($_SESSION[$session] != $sessionenkrip){
		echo "<script language='JavaScript'>window.location = 'logout';</script>";
	}if($_SESSION[$session] == $sessionenkrip){
		?>
		<div class="col-md-4">
			<div class="card my-4">
				<h5 class="card-header">Produk Terlaris</h5>
				<div class="card-body">
				<?php
				foreach($arei1 as $x => $x_value){
					$idproduk	= $x;
					$query		= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$idproduk."'";
					$hasil		= mysqli_query($db, $query);
					$data		= mysqli_fetch_array($hasil);
					echo "<a href=\"produk?idproduk=".$data['idproduk']."\" style=\"color:#000;\"><center><h2>".$data['nama']."</h2>
					<img src=\"img/produk/".$data['idproduk'].".jpg\" width=\"50%\"></a></center><hr/>";
				}
				?>
				</div>
			</div>
			<div class="card my-4">
				<h5 class="card-header">My Account</h5>
				<div class="card-body">
					<p>
						Login Sebagai,<br/>
						<table>
							<tr>
								<td valign="top">Level<td>
								<td valign="top">:<td>
								<td valign="top"><b><?php echo $_SESSION['level']; ?></b><td>
							</tr>
							<tr>
								<td valign="top">Username<td>
								<td valign="top">:<td>
								<td valign="top"><b><?php echo $_SESSION['username']; ?></b><td>
							</tr>
							<tr>
								<td valign="top">Nama<td>
								<td valign="top">:<td>
								<td valign="top"><b><?php echo $_SESSION['nama']; ?></b><td>
							</tr>
						</table><hr/>
						<center>
							<a href="ubahakun?username=<?php echo $_SESSION['username']; ?>">Ubah Akun</a><hr/>
							<a href="logout">Logout</a>
						</center>
					</p>
				</div>
			</div>
			<?php
			if($_SESSION['level'] == "Pemilik"){
			?>
				<div class="card my-4">
					<h5 class="card-header">Menu Pemilik</h5>
					<div class="card-body">
						<a href="mkonsumen">Data Konsumen</a><hr/>
						<a href="mproduk">Data Produk</a><hr/>
						<a href="dtransaksi">Data Transaksi<?php
						$result = mysqli_query($db, "SELECT * FROM `tb_transaksitracking` WHERE `username` = '".$_SESSION['username']."' AND `notif` = 'Y'");
						if(mysqli_num_rows($result) > 0){
							echo " <span style=\"color:red;font-size:22px;\">&#9679;</span>";
						}
						?></a><hr/>
						<a href="laporan?op=transaksi">Laporan Transaksi</a><hr/>
					</div>
				</div>
			<?php
			}if($_SESSION['level'] == "Konsumen"){
			?>
				<div class="card my-4">
					<h5 class="card-header">Menu Konsumen</h5>
					<div class="card-body">
						<a href="keranjangbelanja">Keranjang Belanja</a><hr/>
						<a href="dtransaksi">Data Transaksi<?php
						$result = mysqli_query($db, "SELECT * FROM `tb_transaksitracking` WHERE `username` = '".$_SESSION['username']."' AND `notif` = 'Y'");
						if(mysqli_num_rows($result) > 0){
							echo " <span style=\"color:red;font-size:22px;\">&#9679;</span>";
						}
						?></a>
					</div>
				</div>
			<?php
			}
			?>
		</div>
		<?php
	}
}if(!isset($_SESSION[$session])){
	if(isset($_GET['op'])){
		$op	= $_GET['op'];
		if($op == "daftar"){
			$a	= $_POST['a'];
			$b	= md5($_POST['b']);
			$c	= $_POST['c'];
			$d	= $_POST['d'];
			$e	= $_POST['e'];
			$result = mysqli_query($db, "SELECT * FROM `tb_login` WHERE `username` = '".$a."'");
			if(mysqli_num_rows($result) > 0){
				echo "<script language='JavaScript'>alert('Gagal, Username Sudah Ada'); window.location = 'buatakun';</script>";
			}if(mysqli_num_rows($result) == 0){
				$result = mysqli_query($db, "SELECT * FROM `tb_login` WHERE `notelp` = '".$e."'");
				if(mysqli_num_rows($result) > 0){
					echo "<script language='JavaScript'>alert('Gagal, No. Telp Sudah Ada'); window.location = 'buatakun';</script>";
				}if(mysqli_num_rows($result) == 0){
					$query = "INSERT INTO `tb_login` (
								`username`, 
								`password`, 
								`nama`, 
								`alamat`, 
								`notelp`, 
								`level`
							) VALUES (
								'".$a."', '".$b."', '".$c."', '".$d."', '".$e."', 'Konsumen'
							)";
					$hasil = mysqli_query($db, $query);
					if ($hasil){
						echo "<script language='JavaScript'>alert('Berhasil, Silahkan Login'); window.location = 'login';</script>";
					}if (!$hasil){
						echo "<script language='JavaScript'>alert('Gagal'); window.location = 'buatakun';</script>";
					}
				}
			}
		}if($op == "masuk"){
			$username	= $_POST['username'];
			$password	= md5($_POST['password']);
			if (!ctype_alnum($username) OR !ctype_alnum($password)){
				echo "<script language='JavaScript'>alert('Anda Tidak Diijinkan!');window.location = 'logout';</script>";
			}if (ctype_alnum($username) AND ctype_alnum($password)){
				$query	= "SELECT * FROM `tb_login` WHERE `username`='".$username."' AND `password`='".$password."'";
				$hasil	= mysqli_query($db, $query);
				if(mysqli_num_rows($hasil)==1){
					$data	= mysqli_fetch_array($hasil);
					$_SESSION[$session]		= $sessionenkrip;
					$_SESSION['username']	= $data['username'];
					$_SESSION['level']		= $data['level'];
					$_SESSION['nama']		= $data['nama'];
					$query	= "DELETE FROM `tb_detail_transaksi` WHERE `username` = '".$data['username']."' AND `status` = 'Keranjang Belanja' AND `id_transaksi` = '0'";
					$hasil	= mysqli_query($db, $query);
					echo "<script language='JavaScript'>window.location = 'index';</script>";
				}if(mysqli_num_rows($hasil)==0){
					echo "<script language='JavaScript'>alert('Username atau Password Salah!');window.location = '".$_GET['page']."';</script>";
				}
			}
		}
	}
	if($xpage == "buatakun"){
	?>
	<center>
		<div class="col-lg-8">
			<div class="card my-4">
				<h5 class="card-header">Buat Akun</h5>
				<div class="card-body">
					<form method="post" action="<?php echo $xpage; ?>?op=daftar&page=<?php echo $xpage; ?>">
						<label>Username</label><br/>
						<input type="text" name="a" class="form-control" placeholder="Username" maxlength="15" style="width:100%" required/><br/>
						<label>Password</label><br/>
						<input type="password" name="b" class="form-control" placeholder="Password" maxlength="30" style="width:100%" required/><br/>
						<label>Nama</label><br/>
						<input type="text" name="c" class="form-control" placeholder="Nama" maxlength="72" style="width:100%" required/><br/>
						<label>Alamat</label><br/>
						<input type="text" name="d" class="form-control" placeholder="Alamat" maxlength="160" style="width:100%" required/><br/>
						<label>No. Telp</label><br/>
						<input type="text" name="e" class="form-control" placeholder="No. Telp" maxlength="15" style="width:100%" required/><br/>
						<input type="submit" value="DAFTAR" class="btn btn-secondary" style="width:100%"/>
					</form>
				</div>
			</div>
		</div>
	</center>
	<?php
	}if($xpage == "login"){
	?>
	<center>
		<div class="col-lg-8">
			<div class="card my-4">
				<h5 class="card-header">Login</h5>
				<div class="card-body">
					<form method="post" action="<?php echo $xpage; ?>?op=masuk&page=<?php echo $xpage; ?>">
						<label>Username</label><br/>
						<input type="text" name="username" class="form-control" placeholder="Username" maxlength="15" style="width:100%" required/><br/>
						<label>Password</label><br/>
						<input type="password" name="password" class="form-control" placeholder="Password" maxlength="30" style="width:100%" required/><br/>
						<input type="submit" value="MASUK" class="btn btn-secondary" style="width:100%"/>
					</form>
				</div>
			</div>
		</div>
	</center>
	<?php
	}if($xpage != "login" AND $xpage != "buatakun"){
	?>
	<div class="col-md-4">
		<div class="card my-4">
				<h5 class="card-header">Produk Terlaris</h5>
				<div class="card-body">
				<?php
				foreach($arei1 as $x => $x_value){
					$idproduk	= $x;
					$query		= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$idproduk."'";
					$hasil		= mysqli_query($db, $query);
					$data		= mysqli_fetch_array($hasil);
					echo "<a href=\"produk?idproduk=".$x."\" style=\"color:#000;\"><center><h2>".$data['nama']."</h2>
					<img src=\"img/produk/".$x.".jpg\" width=\"50%\"></a></center><hr/>";
				}
				?>
				</div>
			</div>
		<div class="card my-4">
			<h5 class="card-header">Login</h5>
			<div class="card-body">
				<form method="post" action="<?php echo $xpage; ?>?op=masuk&page=<?php echo $xpage; ?>">
					<label>Username</label><br/>
					<input type="text" name="username" class="form-control" placeholder="Username" maxlength="15" style="width:100%" required/><br/>
					<label>Password</label><br/>
					<input type="password" name="password" class="form-control" placeholder="Password" maxlength="30" style="width:100%" required/><br/>
					<input type="submit" value="MASUK" class="btn btn-secondary" style="width:100%"/>
				</form>
			</div>
		</div>
	</div>
	<?php
	}
}
?>