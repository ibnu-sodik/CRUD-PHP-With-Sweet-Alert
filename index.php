
<!DOCTYPE html>
<html>
<head>
	<title>CRUD With Sweet Alert</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">


				<?php 
				// call connection.php
				include 'connection.php';

				// call function sweetalert.php
				include 'sweetalert.php';

				$show 		= isset($_GET['show'])?$_GET['show']:'';
				$link 		= "?content=index";

				switch ($show) {
					case 'delete':
					$delete = $mysqli->query("DELETE FROM sweetalert WHERE id = '$_GET[id]'");
					if($delete) sweetalert("Success..!", "Data Was Successfully Deleted.", "success", "3000", "false", $link);
					break;

					case 'action':
					if ($_POST['action']=="Edit") {
						$mysqli->query("UPDATE sweetalert SET 
							full_name = '$_POST[full_name]', nim_id = '$_POST[nim_id]', address = '$_POST[address]' WHERE id = '$_POST[id]'
							");
						$text = "Data Was Successfully Updated";
						echo sweetalert("Success..!", $text, "success", "3000", "false", $link);
					}elseif ($_POST['action'] == "Add") {
						$mysqli->query("INSERT INTO sweetalert SET 
							full_name = '$_POST[full_name]', nim_id = '$_POST[nim_id]', address = '$_POST[address]'
							");
						$text = "Data Was Successfully Added";
						echo sweetalert("Success..!", $text, "success", "3000", "false", $link);
					}
					break;

					case 'form':

					if (isset($_GET['id'])) {
						$query = $mysqli->query("SELECT * FROM sweetalert WHERE id = '$_GET[id]'");
						$row = $query->fetch_array();
						$clue = "Edit";
					} else {
						$row = array("full_name" => "", "nim_id" => "", "address" => "" );
						$clue = "Add";
					}
					?>
					<h1><?= $clue ?> Data From <?= $row['full_name'] ?></h1>
					<form class="form-horizontal" action="<?= $link ?>&show=action" method="POST" accept-charset="utf-8">
						<input type="hidden" name="action" value="<?= $clue ?>">
						<input type="hidden" name="id" value="<?= $row['id'] ?>">
						<div class="form-group">
							<label class="control-label" for="full_name">Full Name</label>
							<div class="col-sm-6">
								<input type="text" name="full_name" id="full_name" class="form-control" value="<?= $row['full_name'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label" for="nim_id">ID</label>
							<div class="col-sm-6">
								<input type="number" name="nim_id" id="nim_id" class="form-control" value="<?= $row['nim_id'] ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label">Address</label>
							<div class="col-sm-6">
								<textarea name="address" class="form-control" rows="3"><?= $row['address'] ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Save</button>
							<a href="index.php" class="btn btn-default">Cancel</a>
						</div>
					</form>
					<?php

					break;

					default:
					?>
					<h1>CRUD With Sweet Alert</h1>
					<hr>
					<a href="<?=$link?>&show=form" class="btn btn-primary" style="margin-bottom: 20px;">Add Data</a>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Full Name</th>
									<th>ID</th>
									<th>Address</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=0;
								$query = $mysqli->query("SELECT * FROM sweetalert");
								while($row = $query->fetch_array()):
									$no++;
									?>
									<tr>
										<td class="text-center"><?= $no ?></td>
										<td class="text-center"><?= $row['full_name'] ?></td>
										<td class="text-center"><?= $row['nim_id'] ?></td>
										<td class="text-center"><?= $row['address'] ?></td>
										<td class="text-center">
											<a href="<?= $link ?>&show=form&id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
											<a class="delete_link btn btn-danger" href="<?= $link ?>&show=delete&id=<?= $row['id'] ?>">Delete</a>
										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
					<?php
					break;
				}


				?>


			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
</body>
</html>


