<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin | Profile</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="jscript.php"></script>
	<style>
		.image{
			height: 50px; width: 50px; border: 1px solid #ddd; padding: 2px;
			cursor: pointer;
		}
		.profile-image{
			max-height: 160px; height: 100%; width:auto; max-width: 160px; border: 1px solid #ddd; padding: 3px; border-radius: 2px;
		}
		td{
			vertical-align: middle !important;
			padding: 2px !important;
		}
		tr{
			border-bottom: 1px solid #ddd !important;
		}
		.modal{
			z-index: 9999 !important;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-2">
				<br>
				<a href="#" data-toggle="modal" data-target="#profileModal" class="btn btn-primary pull-left">Add New Profile</a>
			</div>
		</div>
	<!-- DataTable -->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table" id="dataTable">
			</table>
		</div>
	</div>
	<!-- End DataTable -->
	</div>

	<!-- Add new profile modal -->
	<div class="modal" id="profileModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Fill Your Details</h4>
					<div id="msg"></div>
				</div>
				<form action="controller.php" method="POST" id="addProfileForm" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="col-md-12"><div class="form-group">
							<input type="hidden" name="addNewProfile" value="addNewProfile" id="addNewProfile">
							<input type="text" name="name" id="name" placeholder="Name" class="form-control">
						</div></div>
						<div class="col-md-12"><div class="form-group">
							<input type="text" name="phone" id="phone" placeholder="Phone" class="form-control">
						</div></div>
						<div class="col-md-12"><div class="form-group">
							<input type="text" name="email" id="email" placeholder="Email" class="form-control">
						</div></div>
						<div class="col-md-12"><div class="form-group">
							<input type="file" name="photo" id="photo" placeholder="Photo" class="form-control">
						</div></div>
						<div class="col-md-12"><div class="form-group">
							<textarea name="aboutyou" id="aboutyou" placeholder="Describe About you" cols="30" rows="3" class="form-control"></textarea>
						</div></div>
					</div>
					<div class="modal-footer">
						<div class="col-md-12">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Add Profile</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End Add new profile modal -->



	<!-- Update profile modal -->
	<div class="modal" id="updateProfileModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Update Your Details</h4>
					<div id="msgUpdate"></div>
				</div>
					<div id="UpdateFormDisplay"></div>
			</div>
		</div>
	</div>
	<!-- Update profile modal -->
</body>
</html>