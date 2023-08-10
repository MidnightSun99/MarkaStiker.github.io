<br/><br/>
</div>
<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Copyright &copy;<?php echo $xthn." ".$xjudul1." by ".$xfounder;?></p>
	</div>
</footer>
<script src="jquery/jquery.min.js"></script>
<script src="jquery/bootstrap-datepicker.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="datatables/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function(){
		$('.datepicker1').datepicker({
			format: 'dd-mm-yyyy'
		});
		$('.datepicker2').datepicker({
			format: 'dd-mm-yyyy'
		});
		$('#myTable').dataTable();
		$('#myTable1').dataTable({
			"aaSorting": [[ 0, "desc" ]]
		});
		modal.style.display = "block";
	});
	var modal = document.getElementById('myModal');
	var span = document.getElementsByClassName("close")[0];
	span.onclick = function() {
		modal.style.display = "none";
	}
	btn.onclick = function() {
		modal.style.display = "block";
	}
	window.onclick = function(event) {
		if (event.target == modal) {
		modal.style.display = "none";
		}
	}
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
	}
	function RestrictSpace(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode == 32)
			return false;
			return true;
	}
	function konfirmasi(data){
		tanya = confirm('Anda yakin ingin hapus data?');
		if (tanya == true) return true;
		else return false;
	}
	function showStuff(id){
		document.getElementById(id).style.display = 'block';
	}
	function hideStuff(id){
		document.getElementById(id).style.display = 'none';
	}
	function pilih_pelanggan(pelanggan){
		$('#pelanggan').val(pelanggan);
		var page    = 'cari.php?x=caripelanggan';
		$.ajax({
			url: page,
			data : 'pelanggan='+pelanggan,
			type: "post", 
			dataType: "html",
			timeout: 10000,
			success: function(resp){
				$('#caripasien').html(resp);
			}
		});
	}
	function caripelanggan(pelanggan){
		var page    = 'cari.php?x=caripelanggan';
		if(pelanggan.length>0){
			var loading = '<p>Loading ...</p>';
			showStuff('caripelanggan');
			$('#caripelanggan').html(loading);
			$.ajax({
				url: page,
				data : 'pelanggan='+pelanggan,
				type: "post", 
				dataType: "html",
				timeout: 10000,
				success: function(resp){
					$('#caripelanggan').html(resp);
				}
			});
		}
	}
</script>
</body>
</html>