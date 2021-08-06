<!DOCTYPE html>
<html>
<head>	
	<title>Twenty one : Order Tracking</title>
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
				<li class="active">Order Tracking</li>
		    </ol>
		    
			<div class="sidebar">
				<ul class="nav">
					<li><h4><a href="manage-profile.php">My Account <i class="fa fa-chevron-right"></i></a></h4>
						<ul>
							<li><i></i><a href="manage-profile.php">Manage Profile</a></li>
							<li><i></i><a href="wishlist.php">Wishlist</a></li>
							<li><i></i><a href="history.php">History</a></li>
						</ul>
					</li>
					<li class="active"><h4><a href="order-tracking.php">Order Tracking</a></h4></li>
					<li><h4><a href="">Logout</a></h4></li>
				</ul>
			</div>
			<div class="section">
			<h2>Order Tracking</h2>
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="80">Order ID</th>
							<th>Product</th>
							<th width="100" class="text-right">Total</th>
							<th width="100" class="text-right">Date</th>
							<th width="100">Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>12</td>
							<td>
								<ul>
									<li>Samsung Galaxy S5</li>
									<li>iPhone 6 (32GB Gold)</li>
								</ul>
							</td>
							<td class="text-right">$1599.99</td>
							<td class="text-right">2015-11-18 12:17:38</td>
							<td><span class="label label-success">Received</span></td>
						</tr>
						<tr>
							<td>221</td>
							<td>
								<ul>
									<li>Headphone Black</li>
								</ul>
							</td>
							<td class="text-right">$90.00</td>
							<td class="text-right">2015-01-01 20:12:11</td>
							<td><span class="label label-danger">Cancelled</span></td>
						</tr>
						<tr>
							<td>221</td>
							<td>
								<ul>
									<li>Headphone Black</li>
								</ul>
							</td>
							<td class="text-right">$90.00</td>
							<td class="text-right">2015-01-01 20:12:11</td>
							<td><span class="label label-info">Being prepared</span></td>
						</tr>
						<tr>
							<td>221</td>
							<td>
								<ul>
									<li>Headphone Black</li>
								</ul>
							</td>
							<td class="text-right">$90.00</td>
							<td class="text-right">2015-01-01 20:12:11</td>
							<td><span class="label label-warning">On hold</span></td>
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