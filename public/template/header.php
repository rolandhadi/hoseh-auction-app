<div class="color-switch">
	<ul>
		<li><a id="brown" class="brown change" href="#brown"><i class="fa fa-check"></i></a></li>
		<li><a id="red" class="red change" href="#red"><i class="fa fa-check"></i></a></li>
		<li><a id="yellow" class="yellow change" href="#yellow"><i class="fa fa-check"></i></a></li>
		<li><a id="blue" class="blue change" href="#blue"><i class="fa fa-check"></i></a></li>
		<li><a id="green" class="green change" href="#green"><i class="fa fa-check"></i></a></li>
		<li><a id="gray" class="gray change" href="#gray"><i class="fa fa-check"></i></a></li>
		<li><a id="modernstyle" class="modernstyle change" href="#modernstyle"><i class="fa fa-check"></i></a></li>
	</ul>
	<i class="fa fa-paint-brush"></i>
</div>
<div class="nav-top">
	<div class="userbar">
		<div class="contact">
			<a href="" class="tel"><i class="fa fa-phone"></i> (+66) 81 915 5555</a>
			<span class="split"></span>
			<a href="" class="email"><i class="fa fa-envelope-o"></i> admin@hoseh-sg.com</a>
		</div>
		<div class="lang">
			<a href="" id="lang" class="dropdown-toggle" data-toggle="dropdown">Thai <span class="caret"></span></a>
			<ul class="dropdown-menu" aria-labelledby="lang">
				<li><a href="" >Thai</a></li>
				<li><a href="" >Eng</a></li>
			</ul>
		</div>
		<span class="split"></span>
		<!-- Before Login -->
		<a href="login.php">Login</a> <span>or</span> <a href="login.php">Register</a>
		<!-- End Before Login -->
		<!-- after Login -->
		<?php /* <div class="member">
			<a href="" id="user" class="dropdown-toggle" data-toggle="dropdown">Name User <span class="caret"></span></a>
			<ul class="dropdown-menu" aria-labelledby="user">
				<li>
					<a href="">
						<img src="assets/img/user.png" class="avatar">
						<div class="avatar-text">
							<h4>Nameuser</h4>
							View Profile
						</div>
					</a>
				</li>
				<li><a href="" ><i class="fa fa-edit"></i> Edit Profile</a></li>
				<li><a href="" ><i class="fa fa-power-off"></i> Logout</a></li>
			</ul>
		</div> */ ?>
		<!-- End after Login -->
	</div>
</div>
<header class="header">
	<div class="inner-header">
		<div class="logo">
			<a href="index.php"><img src="{{ asset('img/logo@3x.png') }}" alt="abc point" /></a>
			<!--<div class="cc">
				<span><i class="fa fa-phone"></i> +66 2 123 4567</span>
			</div>-->
		</div>
		<div class="searchbar">
			<div class="search-toggle">
				<i class="fa fa-search icon-search"></i>
				<i class="fa fa-remove icon-remove"></i>
			</div>
			<div class="search">
				<input type="text" placeholder="Search Product" class="search-box" /><!-- fix inline-block --><button class="search-btn"><i class="fa fa-search"></i></button>
			</div>
			<a href="wishlist.php" class="wishlist"><i class="fa fa-heart"></i> <b>21</b></a>
			<a href=".checkout" data-toggle="modal" class="basket"><i class="fa fa-shopping-cart"></i> <b>$ 12,000</b> <span>4</span></a>
		</div>
		<!--<div class="section-button">
			<a href="" class="active">Online Service <i class="fa fa-angle-down"></i></a>
			<a href="">Corporate  <i class="fa fa-angle-right"></i></a>
		</div>-->
	</div>
</header>
<nav class="nav-main">
	<a href="javascript:void(0);" class="nav-toggle"><i class="fa fa-align-justify"></i></a>
	<ul class="inner-nav-main">
		<li class="category">
			<a href="#">
				<div class="nav-text">
					<h2>Category</h2>
				</div>
				<i class="fa fa-angle-right"></i>
			</a>
			<div class="nav-sub">
				<ul class="inner-nav-sub">
					<li class="col-xs-4">
						<h4>Computer</h4>
						<ul>
							<li>
								<a href="http://www.google.com">New Products</a>
							</li>
							<li class="sub-menu">
								<a href="#" class="sub-menu-toggle">Apple <div class="label label-danger"><div class="arrow"></div>New</div> <span class="fa fa-angle-right"></span></a>
								<ul>
									<li>
										<a href="list-product.php">Macbook Pro</a>
									</li>
									<li>
										<a href="list-product.php">Macbook Air</a>
									</li>
									<li>
										<a href="list-product.php">iMac</a>
									</li>
									<li>
										<a href="list-product.php">Mac Pro</a>
									</li>
									<li>
										<a href="list-product.php">Mac Mini</a>
									</li>
									<li>
										<a href="list-product.php">OS X Yosemite</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="list-product.php">Lenovo <div class="label label-danger"><div class="arrow"></div>New</div></a>
							</li>
							<li>
								<a href="list-product.php">Samsung</a>
							</li>
							<li>
								<a href="list-product.php">Microsoft</a>
							</li>
						</ul>
					</li><!-- fix inline-block
					--><li class="col-xs-4">
						<h4>Sports</h4>
						<ul>
							<li>
								<a href="list-product.php">Sport Tops & Vests</a>
							</li>
							<li>
								<a href="list-product.php">Swimware</a>
							</li>
							<li>
								<a href="list-product.php">Footware</a>
							</li>
							<li>
								<a href="list-product.php">Sport Underware</a>
							</li>
						</ul>
					</li><!-- fix inline-block
					--><li class="col-xs-4">
						<h4>Video Games & Consoles</h4>
						<ul>
							<li>
								<a href="list-product.php">Action</a>
							</li>
							<li>
								<a href="list-product.php">Adventure</a>
							</li>
							<li>
								<a href="list-product.php">Shooter</a>
							</li>
							<li>
								<a href="list-product.php">Role-Playing Games (RPGs)</a>
							</li>
						</ul>
					</li>
				</ul>
				<ul class="inner-nav-sub">
					<li class="col-xs-4">
						<h4>Phones & Accessories</h4>
						<ul>
							<li>
								<a href="list-product.php">iPhone</a>
							</li>
							<li>
								<a href="list-product.php">Samsung</a>
							</li>
							<li>
								<a href="list-product.php">Sony</a>
							</li>
							<li>
								<a href="list-product.php">Azus</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</li><!--
		--><li class="active">
			<a href="index.php">
				<div class="nav-text">
					<h2 class="text">Home</h2>
					<h2 class="icon"><i class="fa fa-home"></i></h2>
				</div>
			</a>
		</li><!--
		--><li>
			<a href="list-product.php">
				<div class="nav-text">
					<h2>Products</h2>
				</div>
			</a>
		</li><!--
		--><li>
			<a href="element.php">
				<div class="nav-text">
					<h2>Element</h2>
				</div>
			</a>
			<!--<ul class="nav-sub">
				<li></li>
				<li>หมวดหมู่</li>
				<li></li>
			</ul>-->
		</li><!--
		--><li>
			<a href="contact.php">
				<div class="nav-text">
					<h2>Contact us</h2>
				</div>
			</a>
			<!--<ul class="nav-sub">
				<li></li>
				<li>หมวดหมู่</li>
				<li></li>
			</ul>-->
		</li>
	</ul>
</nav>


<!-- Modal Checkout -->
<div class="modal checkout fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Your Order</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Product Detail</th>
								<th class="text-right" style="width: 90px;">Order</th>
								<th class="text-right" style="width: 80px;">Amount</th>
								<th style="width: 20px;"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><img src="assets/img/products/1.jpg" style="width: 50px;" class="pull-left hidden-xs" alt="" /> Samsung Galaxy S5
								</td>
								<td class="text-right">
									<div class="quantity">
									    <div class="minus">
									    	<a class="ddd" href="#">-</a>
									    </div>
									    <div class="input">
									        <input type="text" class="quntity-input" value="1" />
									    </div>
									    	<div class="plus"> <a class="ddd" href="#">+</a>
									    </div>
									</div>
								</td>
								<td class="text-right">$2,000</td>
								<td class="text-right">
									<a href=""><i class="fa fa-trash-o red"></i></a>
								</td>
							</tr>
							<tr>
								<td class="text-right" colspan="2"><b>Total Amount</b></td>
								<td class="text-right">$2,000</td>
								<td class="text-right"></td>
							</tr>
						</tbody>
				    </table>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>
				<a href="checkout.php" class="btn btn-primary">Checkout</a>
			</div>
	    </div><!-- /.modal-content -->
	</div>
</div>
<!-- Modal -->
