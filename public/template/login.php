<!DOCTYPE html>
<html>
<head>	
	<title>Twenty One : Login & Register</title>
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
				<li class="active">Login & Register</li>
		    </ol>
			<div class="row">
				<!-- login -->
				<div class="col-sm-5">
					<h1 class="title-header">Login</h1>
					<form role="form" class="form-horizontal">
						<div class="form-group">
							<label class="control-label">Username or Email</label>
							<input type="text" placeholder="Username or Email" class="form-control">
						</div>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="text" placeholder="Password" class="form-control">
						</div>
						<div class="form-group">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Remember Password
								</label>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Login</button>
							<a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> Connect with Facebook</a>
						</div>
						<div class="form-group">
							<div class="text-right">
								<a href="">Lost Password ?</a>
							</div>
						</div>
				    </form>
				    <!--<div class="panel-border">
					    <h2>login with facebook</h2>
					    <a href="" class="btn btn-facebook"><i class="fa fa-facebook"></i> Connect with Facebook</a>
				    </div>-->
				</div>
				<!--  -->
				<div class="col-sm-7">
					<div class="panel">
						<h1 class="title-header">New Customers</h1>
						<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
						<form role="form" class="form-horizontal row">
							<h5 class="col-sm-12">Personal Information</h5>
							<div class="form-group col-sm-6">
								<label class="control-label">First Name</label>
								<input type="text" placeholder="First Name" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Last Name</label>
								<input type="text" placeholder="Last Name" class="form-control">
							</div>
							<div class="form-group col-sm-12">
								<label class="control-label">Username or Email</label>
								<input type="text" placeholder="Username or Email" class="form-control">
							</div>
							<div class="form-group col-sm-12">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Sign Up for Newsletter
									</label>
								</div>
							</div>
							<h5 class="col-sm-12">Login Information</h5>
							<div class="form-group col-sm-6">
								<label class="control-label">Password</label>
								<input type="password" class="form-control">
							</div>
							<div class="form-group col-sm-6">
								<label class="control-label">Confirm Password
</label>
								<input type="password" class="form-control">
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