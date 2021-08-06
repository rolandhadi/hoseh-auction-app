<!DOCTYPE html>
<html>
<head>	
	<title>Twenty one : My Account</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="user-scalable=0,initial-scale=1.0, maximum-scale=1, minimum-scale=1" />
	<?php include "css.php"; ?>
	<?php include "script.php"; ?>
</head>
<body>
	<div class="wrapper">
		<?php include "header.php"; ?>
		<div class="container">
			<ol class="breadcrumb">
				<li><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li><a href="manage-profile.php">My Account</a></li>
				<li class="active">Manage Profile</li>
		    </ol>
			<div class="sidebar">
				<ul class="nav">
					<li class="active"><h4><a href="manage-profile.php">My Account <i class="fa fa-chevron-right"></i></a></h4>
						<ul>
							<li class="active"><i></i><a href="manage-profile.php">Manage Profile</a></li>
							<li><i></i><a href="wishlist.php">Wishlist</a></li>
							<li><i></i><a href="history.php">History</a></li>
						</ul>
					</li>
					<li><h4><a href="order-tracking.php">Order Tracking</a></h4></li>
					<li><h4><a href="">Logout</a></h4></li>
				</ul>
			</div>
			<div class="section">
				<h2>Manage Profile</h2>
				<div class="row">
					<div class="col-sm-12">
						<h3>Change Password</h3>
						<form role="form" class="form-horizontal row">
							<div class="form-group col-sm-6">
								<label class="control-label">Old Password</label>
								<input type="text" placeholder="Old Password" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">New Password</label>
								<input type="text" placeholder="New Password" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Confirm Password</label>
								<input type="text" placeholder="Confirm Password" class="form-control">
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Save New Password</button>
								</div>
							</div>
						</form>
						<hr />
						<h3>Personal Information</h3>
						<form role="form" class="form-horizontal row">
							<div class="form-group col-sm-6">
								<label class="control-label">First Name</label>
								<input type="text" placeholder="First Name" value="Sittipat" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Last Name</label>
								<input type="text" placeholder="Last Name" value="Wongwiriyakul" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Email</label>
								<input type="text" placeholder="Email" value="admin@hoseh-sg.com" class="form-control" disabled="disabled">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Telephone</label>
								<input type="text" placeholder="Telephone" value="+66 2 123 4567" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Company</label>
								<input type="text" placeholder="Company" value="Home" class="form-control">
							</div>
							<div class="form-group col-sm-12">
								<label class="control-label">Address</label>
								<textarea rows="3" class="form-control" value="+66 2 123 4567" placeholder="Address">23/ 456 Jaransanitwong 35 Jaransanitwong Road Bangkoknoi Bangkok</textarea>
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">District</label>
								<select class="form-control">
									<option>Bangkoknoi</option>
								</select>
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Province</label>
								<select class="form-control">
									<option>Bangkok</option>
								</select>
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Country</label>
								<select class="form-control">
									<option>Thailand</option>
								</select>
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Zip code</label>
								<input type="text" placeholder="Zip code" value="12345" class="form-control">
							</div>
							<div class="form-group col-sm-12">
								<div class="checkbox">
									<label>
										<input type="checkbox" checked="checked"> Sign Up for Newsletter
									</label>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>
</html>