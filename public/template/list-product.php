<!DOCTYPE html>
<html>
<head>	
	<title>Twenty one : List products</title>
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
				<li><a href="list-product.php">Category</a></li>
				<li class="active">Smart phone</li>
		    </ol>
		    
			<div class="sidebar">
				<h3 class="title-nav">Category</h3>
				<ul class="nav">
					<li><h4><a href="">Computer <span>(142)</span> <i class="fa fa-chevron-right"></i></a></h4>
						<ul>
							<li>Lenovo</li>
							<li>Dell</li>
							<li>Toshiba</li>
							<li>Asus</li>
						</ul>
					</li>
					<li class="active"><h4><a href="">Smart phone <span>(655)</span> <i class="fa fa-chevron-down"></i></a></h4>
						<ul>
							<li class="active"><i></i><a href="#">Samsung</a></li>
							<li><i></i><a href="#">Apple</a></li>
							<li><i></i><a href="#">Sony</a></li>
						</ul>
					</li>
					<li><h4><a href="">Camera <span>(56)</span> <i class="fa fa-chevron-right"></i></a></h4>
					</li>
					<li><h4><a href="">Sport <span>(122)</span> <i class="fa fa-chevron-right"></i></a></h4>
					</li>
				</ul>
				<h3 class="title-nav">Price rate</h3>
				<div class="nav-price">
					<form>
						<input type="text" id="amount" readonly="readonly" />
						<div id="slider-range"></div>
						<button class="btn btn-primary">Filter</button>
					</form>
				</div>
			</div>
			<div class="section">
			<h2>Smart Phone</h2>
				<div class="orderby">Default sorting
					<select class="form-control">
						<option>Sort by popularity</option>
						<option>Sort by average rating</option>
						<option>Sort by newness</option>
						<option>Sort by price: low to high</option>
						<option>Sort by price: high to low</option>
					</select>
				</div>
				<div class="row list-thumbnail">
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="thumbnail">
							<a href="product-detail.php">
								<img src="assets/img/products/1.jpg" alt="" />
								<img class="hover" src="assets/img/products/1-1.jpg" alt="" />
							</a>
							<div class="caption">
								<h3>iPhone 6 (16GB Space Grey, Silver)</h3>
								<h5 class="price">$200.00</h5>
								<a href="" class="like active"><i class="fa fa-heart"></i> 12</a>
							</div>
				        </div>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="thumbnail">
							<a href="product-detail.php">
								<span class="label-save">Save <i>5%</i></span>
								<img src="assets/img/products/2.jpg" alt="" />
							</a>
							<div class="caption">
								<h3>HTC Desire 820 Gray-Blue</h3>
								<h5 class="price">$95.00<span class="strike">$100.00</span></h5>
								<a href="" class="like active"><i class="fa fa-heart"></i> 2</a>
							</div>
				        </div>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="thumbnail">
							<a href="product-detail.php">
								<img src="assets/img/products/9.jpg" alt="" />
							</a>
							<div class="caption">
								<h3>Samsung Galaxy S5</h3>
								<h5 class="price">$699.99</h5>
								<a href="" class="like active"><i class="fa fa-heart"></i> 34</a>
							</div>
				        </div>
					</div>
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="thumbnail">
							<a href="product-detail.php">
								<span class="label-save">Save <i>7%</i></span>
								<img src="assets/img/products/4.jpg" alt="" />
							</a>
							<div class="caption">
								<h3>LG Nexus 5</h3>
								<h5 class="price">$319.00<span class="strike">$349.00</span></h5>
								<a href="" class="like active"><i class="fa fa-heart"></i> 7</a>
							</div>
				        </div>
					</div>
				</div>
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