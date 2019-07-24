<?php 

function swal_error($title, $text, $type, $timer, $condition, $link)
{	
	?>
	<script type="text/javascript">
		setTimeout(function(){
			var getlink = $(this).attr('href');
			swal({
				title : "<?= $title ?>",
				text : "<?= $text ?>",
				type : "<?= $type ?>",
				timer : "<?= $timer ?>",
				showConfirmButton : <?= $condition ?>
			});
		}, 1);
		window.setTimeout(function() {
			window.location.replace("<?= $link ?>");
		}, <?= $timer ?>);
	</script>
	<?php
	
}

function sweetalert($title, $text, $type, $timer, $condition, $link)
{
	?>
	<script type="text/javascript">
		setTimeout(function() {
			swal({
				title : "<?= $title ?>",
				text : "<?= $text ?>",
				type : "<?= $type ?>",
				timer : "<?= $timer ?>",
				showConfirmButton : <?= $condition ?>
			});
		}, 1000);
		window.setTimeout(function() {
			window.location.replace("<?= $link ?>");
		}, <?= $timer ?>);
	</script>
	<?php
}


function swal_hapus($title, $text, $link)
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('.delete_link').on('click',function(){
				swal({
					title: "Are You Sure...?",
					text: "This Data Will Deleted From Database.!",
					type: "warning",
					html: true,
					confirmButtonColor: '#d9534f',

					confirmButtonColor: "#DD6B55",
					showCancelButton: true,
				}, function(){
					window.location.replace("<?= $link ?>");
				});
				return false;
			});
		});
	</script>
	<?php
}

?>