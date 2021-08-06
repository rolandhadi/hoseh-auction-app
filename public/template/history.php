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
				<li class="active">History</li>
		    </ol>		    
			<div class="sidebar">
				<ul class="nav">
					<li class="active"><h4><a href="manage-profile.php">My Account <i class="fa fa-chevron-right"></i></a></h4>
						<ul>
							<li><i></i><a href="manage-profile.php">Manage Profile</a></li>
							<li><i></i><a href="wishlist.php">Wishlist</a></li>
							<li class="active"><i></i><a href="history.php">History</a></li>
						</ul>
					</li>
					<li><h4><a href="order-tracking.php">Order Tracking</a></h4></li>
					<li><h4><a href="">Logout</a></h4></li>
				</ul>
			</div>
			<div class="section">
			<h2>History</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="40">ID</th>
							<th>Product</th>
							<th width="100" class="text-right">Price</th>
							<th width="150" class="text-right">Date</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>12</td>
							<td>
								<img src="assets/img/products/9.jpg" alt="Samsung Galaxy S5" width="60" class="pull-left" /> Samsung Galaxy S5
							</td>
							<td class="text-right">$699.99</td>
							<td class="text-right">2015-11-18 12:17:38</td>
						</tr>
						<tr>
							<td>221</td>
							<td>
								<img src="assets/img/products/5.jpg" alt="Headphone Black" width="60" class="pull-left" /> Headphone Black
							</td>
							<td class="text-right">$90.00</td>
							<td class="text-right">2015-01-01 20:12:11</td>
						</tr>
					</tbody>
			    </table>
				<ul class="pagination pagination-sm">
					<li><a href="#"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
					<li class="active"><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
			    </ul>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>
</html>