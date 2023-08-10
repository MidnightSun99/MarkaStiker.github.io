<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
include "header.php";
$xpage	="kontak";
?>
<div class="row">
	<div class="col-lg-8">
		<h1 class="mt-4">Kontak</h1><hr/>
		<?php
		echo "<p align=\"justify\">
			<table>
				<tr>
					<td valign=\"top\" width=\"40px\">Alamat</td>
					<td valign=\"top\" width=\"40px\">:</td>
					<td valign=\"top\" width=\"40px\">".$xalamat."</td>
				</tr>
				<tr>
					<td valign=\"top\" width=\"40px\">No. Telp</td>
					<td valign=\"top\" width=\"40px\">:</td>
					<td valign=\"top\" width=\"40px\">".$xnotelp."</td>
				</tr>
				<tr>
					<td valign=\"top\" width=\"40px\">Whatsapp</td>
					<td valign=\"top\" width=\"40px\">:</td>
					<td valign=\"top\" width=\"40px\">".$xwa."</td>
				</tr>
				<tr>
					<td valign=\"top\" width=\"40px\"></td>
					<td valign=\"top\" width=\"40px\"></td>
					<td valign=\"top\">";
					?>
					<a href="https://wa.me/<?php echo str_replace("+","",$xwa); ?>" class="btn btn-secondary">Chat WhatsApp</a>
					<?php
					echo "</td>
				</tr>
				<tr>
					<td valign=\"top\" width=\"40px\">Email</td>
					<td valign=\"top\" width=\"40px\">:</td>
					<td valign=\"top\" width=\"40px\">".$xemail."</td>
				</tr>
				
			</table>
			<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15819.56587648686!2d110.7918034!3d-7.5867909!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a157082347d0b%3A0x681fac2ad128d311!2sMarkastiker%20%7C%7C%20Cetak%20Stiker%20Solo!5e0!3m2!1sid!2sid!4v1687415354819!5m2!1sid!2sid\" width=\"700\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>
		</p>";
		?>
	</div>
	<?php include "sidemenu.php"; ?>
</div>
<?php
include "footer.php";
?>