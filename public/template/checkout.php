<!DOCTYPE html>
<html>
<head>	
	<title>Twenty one : Checkout</title>
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
				<li class="active">Checkout</li>
		    </ol>
			<form class="form-horizontal">
				<div class="row">
					<div class="col-sm-7">
						<h1 class="title-header">Address</h1>						
						<div class="add-thumbnail">
							<div class="col-sm-12 col-md-6">
								<h3><i class="fa fa-truck"></i>Delivery Address</h3>				
								<div class="btn">
									<div class="thumbnail">
										<div class="caption">
											<i class="fa fa-truck"></i>
											<h4>123/456 Jaransanitwong Rord. Bangkhunsri Bangkoknoi Bangkok 10700</h4>
											<p>Tel : 081-123-4567</p>
											<p>E-mail : Test@test.com</p>
										</div>
										<div class="change">
									        <a href="#select_address" data-toggle="modal">
										        <i class="fa fa-edit"></i>
										        <h3>Edit Address</h3>
									        </a>
								        </div>
							        </div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<h3><i class="fa fa-envelope"></i> Billing Address</h3>
								<div class="btn" style="display: none;">
									<div class="thumbnail">
										<div class="caption">
											<i class="fa fa-envelope"></i>
											<h4>123/456 Jaransanitwong Rord. Bangkhunsri Bangkoknoi Bangkok 10700</h4>
											<p>Tel : 081-123-4567</p>
											<p>E-mail : Test@test.com</p>
										</div>
										<div class="change">
									        <a href="#select_address" data-toggle="modal">
										        <i class="fa fa-edit"></i>
										        <h3>Edit Address</h3>
									        </a>
								        </div>
							        </div>
								</div>
								<div class="add" style="display: block;">
									<a class="thumbnail" href="#select_address" data-toggle="modal">
										<div class="caption">
											<i class="fa fa-plus-circle"></i>
											<h3>Add New Address</h3>
										</div>
							        </a>
								</div>		
							</div>
						</div>
						
						<!-- Modal Select Address -->
						<div class="modal fade" id="select_address">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title">Edit Address</h4>
									</div>
									<div class="modal-body">
										<div class="btn-group add-thumbnail">	
											<div class="col-xs-12 col-sm-6 col-md-3 btn active">
												<a class="thumbnail" href="">
													<div class="caption">
														<i class="fa fa-check-circle"></i>
														<h4>123/456 Jaransanitwong Rord. Bangkhunsri Bangkoknoi Bangkok 10700</h4>
														<p>Tel : 081-123-4567</p>
														<p>E-mail : Test@test.com</p>
													</div>
										        </a>
										        <div class="manage">
											        <!--<a href="" class="btn-primary">
												        <i class="fa fa-check"></i> เลือก
											        </a>-->
											        <a href="#edit_address" data-toggle="modal" data-dismiss="modal" class="btn-default">
												        <i class="fa fa-edit"></i>
											        </a>
											        <a href="" class="btn-danger">
												        <i class="fa fa-trash-o"></i>
											        </a>
										        </div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-3 btn">
												<a class="thumbnail" href="">
													<div class="caption">
														<i class="fa fa-check-circle"></i>
														<h4>123/456 Jaransanitwong Rord. Bangkhunsri Bangkoknoi Bangkok 10700</h4>
														<p>Tel : 081-123-4567</p>
														<p>E-mail : Test@test.com</p>
													</div>
										        </a>
										        <div class="manage">
											        <a href="#edit_address" data-toggle="modal" data-dismiss="modal" class="btn-default">
												        <i class="fa fa-edit"></i>
											        </a>
											        <a href="" class="btn-danger">
												        <i class="fa fa-trash-o"></i>
											        </a>
										        </div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-3 add">
												<a href="#edit_address" data-toggle="modal" data-dismiss="modal" class="thumbnail">
													<div class="caption">
														<i class="fa fa-plus-circle"></i>
														<h3>Add New Address</h3>
													</div>
										        </a>
											</div>				
										</div>
									</div>
							    </div><!-- /.modal-content -->
							</div>
						</div>
						<!-- Modal Select Address -->
						
						<!-- Modal Edit Address -->
						<div class="modal fade" id="edit_address">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										<h4 class="modal-title">Edit Address</h4>
									</div>
									<div class="modal-body">
										<div class="form-slidedown">
											<div class="form-group">
												<label class="col-sm-3 control-label">Name <span>*</span></label>
												<div class="col-sm-9">
													<input type="text" class="col-sm-4 form-control required" placeholder="Name" name="name" aria-required="true">
													<small>Please fill in English Do not include spaces and special characters. (Ex. ?!:;/\()^&amp;*) </small>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Mobile <span>*</span></label>
												<div class="col-sm-9">
													<input type="text" class="col-sm-4 form-control required" value="" placeholder="0899999999" aria-required="true">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Email <span>*</span></label>
												<div class="col-sm-9">
													<input type="email" class="col-sm-6 form-control required" placeholder="Email" name="email" aria-required="true">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Address</label>
												<div class="col-sm-9">
													<textarea class="col-sm-10 form-control">Jaransanitwong</textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">District</label>
												<div class="col-sm-9">
													<select class="form-control col-sm-4">
														<option>Bangkoknoi</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Province</label>
												<div class="col-sm-9">
													<select class="form-control col-sm-4">
														<option>Bangkok</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Country</label>
												<div class="col-sm-9">
													<select class="form-control col-sm-4">
														<option>Thailand</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Zip code</label>
												<div class="col-sm-9">
													<input type="text" placeholder="" value="" class="col-sm-4 form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<a href="#select_address" class="btn btn-default" data-toggle="modal" data-dismiss="modal">cancel</a>
										<a href="" class="btn btn-primary">Save</a>
									</div>
							    </div><!-- /.modal-content -->
							</div>
						</div>
						<!-- Modal Edit Address -->		
					</div>
					
					<div class="col-sm-5">
						<div class="panel">
							<h1 class="title-header">Your Order</h1>	
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Product Detail</th>
										<th class="text-right">Order</th>
										<th class="text-right">Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><img src="assets/img/products/9.jpg" style="width: 50px;" class="pull-left hidden-xs" alt="" /> Samsung Galaxy S5</td>
										<td class="text-right">1</td>
										<td class="text-right">$2,000</td>
									</tr>
								</tbody>
						    </table>			
							<div class="list-item">
							 	<div class="form-group">
									<label>price</label>
									<span class="pull-right">$3,870</span>
							 	</div>
							 	
							 	<div class="form-group">
								 	<label>Shipping </label>
									<span class="pull-right">Free</span>
							 	</div>
							 	<div class="form-group">
								 	<label>Discount</label>
									<span class="pull-right">$0</span>
							 	</div>
							 	<div class="form-group last">
								 	<label>Amount</label>
									<span class="pull-right"><strong>$62,770</strong></span>
							 	</div>
							</div>			
							<hr />
							<h1 class="title-header">Payment Methods</h1>
							<div class="list-item">
								<div class="form-group">
									<div class="radio">
										<label>
											<input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios">
											Direct Bank Transfer
										</label>
										<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
									</div>
								</div>
							</div>
							<div class="list-item">
								<div class="form-group">
									<div class="radio">
										<label>
											<input type="radio" checked="" value="option2" id="optionsRadios2" name="optionsRadios">
											Cheque Payment
										</label>
									</div>
								</div>
							</div>
							<div class="list-item">
								<div class="form-group">
									<div class="radio">
										<label>
											<input type="radio" checked="" value="option3" id="optionsRadios3" name="optionsRadios">
											PayPal
										</label>
									</div>
								</div>
							</div>
							<div class="form-group text-right">
								<a href="" class="btn btn-default">Back</a>
								<a href="complete.php" class="btn btn-primary">Confirm Order</a>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>
</html>