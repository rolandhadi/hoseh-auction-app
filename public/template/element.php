<!DOCTYPE html>
<html>
<head>	
	<title>Twenty one : Element</title>
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
				<li class="active">Element</li>
		    </ol>
			<h1 class="title-header">Bootstrap</h1>
			<div class="row">
				<div class="col-md-12">
					<h3>Collapse <small>collapse.js</small></h3>
					<p>Flexible plugin that utilizes a handful of classes for easy toggle behavior.</p>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default active">
					    <div class="panel-heading" role="tab" id="headingOne">
					      <h4 class="panel-title">
					        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					          Collapsible Group Item #1
					        </a>
					      </h4>
					    </div>
					    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					      <div class="panel-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					      </div>
					    </div>
					  </div>
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingTwo">
					      <h4 class="panel-title">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					          Collapsible Group Item #2
					        </a>
					      </h4>
					    </div>
					    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
					      <div class="panel-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					      </div>
					    </div>
					  </div>
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="headingThree">
					      <h4 class="panel-title">
					        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
					          Collapsible Group Item #3
					        </a>
					      </h4>
					    </div>
					    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
					      <div class="panel-body">
					        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
					      </div>
					    </div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Example: Mobile and desktop</h3>
					<p>Don't want your columns to simply stack in smaller devices? Use the extra small and medium device grid classes by adding <code>.col-xs-*</code> <code>.col-md-*</code> to your columns. See the example below for a better idea of how it all works.</p>
				    <div class="show-grid">
				      <div class="col-xs-12 col-md-8">.col-xs-12 .col-md-8</div>
				      <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
				    </div>
				    <div class="show-grid">
				      <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
				      <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
				      <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
				    </div>
				    <div class="show-grid">
				      <div class="col-xs-6">.col-xs-6</div>
				      <div class="col-xs-6">.col-xs-6</div>
				    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Headings</h3>
					<p>All HTML headings, <code>&lt;h1&gt;</code> through <code>&lt;h6&gt;</code>, are available. <code>.h1</code> through <code>.h6</code> classes are also available, for when you want to match the font styling of a heading but still want your text to be displayed inline.</p>
					<table class="table">
				      <tbody>
				        <tr>
				          <td><h1>h1. Bootstrap heading <small>Secondary text</small></h1></td>
				        </tr>
				        <tr>
				          <td><h2>h2. Bootstrap heading <small>Secondary text</small></h2></td>
				        </tr>
				        <tr>
				          <td><h3>h3. Bootstrap heading <small>Secondary text</small></h3></td>
				        </tr>
				        <tr>
				          <td><h4>h4. Bootstrap heading <small>Secondary text</small></h4></td>
				        </tr>
				        <tr>
				          <td><h5>h5. Bootstrap heading <small>Secondary text</small></h5></td>
				        </tr>
				        <tr>
				          <td><h6>h6. Bootstrap heading <small>Secondary text</small></h6></td>
				        </tr>
				      </tbody>
				    </table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Tables</h3>
					<p>For basic styling&mdash;light padding and only horizontal dividers&mdash;add the base class <code>.table</code> to any <code>&lt;table&gt;</code>. It may seem super redundant, but given the widespread use of tables for other plugins like calendars and date pickers, we've opted to isolate our custom table styles.</p>
				    <table class="table table-striped">
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>First Name</th>
				          <th>Last Name</th>
				          <th>Username</th>
				        </tr>
				      </thead>
				      <tbody>
				        <tr>
				          <td>1</td>
				          <td>Mark</td>
				          <td>Otto</td>
				          <td>@mdo</td>
				        </tr>
				        <tr>
				          <td>2</td>
				          <td>Jacob</td>
				          <td>Thornton</td>
				          <td>@fat</td>
				        </tr>
				        <tr>
				          <td>3</td>
				          <td>Larry</td>
				          <td>the Bird</td>
				          <td>@twitter</td>
				        </tr>
				      </tbody>
				    </table>
				    <h4>Hover rows</h4>
				    <table class="table table-hover">
				      <thead>
				        <tr>
				          <th>#</th>
				          <th>First Name</th>
				          <th>Last Name</th>
				          <th>Username</th>
				        </tr>
				      </thead>
				      <tbody>
				        <tr>
				          <td>1</td>
				          <td>Mark</td>
				          <td>Otto</td>
				          <td>@mdo</td>
				        </tr>
				        <tr>
				          <td>2</td>
				          <td>Jacob</td>
				          <td>Thornton</td>
				          <td>@fat</td>
				        </tr>
				        <tr>
				          <td>3</td>
				          <td colspan="2">Larry the Bird</td>
				          <td>@twitter</td>
				        </tr>
				      </tbody>
				    </table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Forms</h3>
					<p>Individual form controls automatically receive some global styling. All textual <code>&lt;input&gt;</code>, <code>&lt;textarea&gt;</code>, and <code>&lt;select&gt;</code> elements with <code>.form-control</code> are set to <code>width: 100%;</code> by default. Wrap labels and controls in <code>.form-group</code> for optimum spacing.</p>
					<form role="form">
				      <div class="form-group">
				        <label for="exampleInputEmail1">Email address</label>
				        <input type="email" placeholder="Enter email" id="exampleInputEmail1" class="form-control">
				      </div>
				      <div class="form-group">
				        <label for="exampleInputPassword1">Password</label>
				        <input type="password" placeholder="Password" id="exampleInputPassword1" class="form-control">
				      </div>
				      <div class="form-group">
				        <label for="exampleInputFile">File input</label>
				        <input type="file" id="exampleInputFile">
				        <p class="help-block">Example block-level help text here.</p>
				      </div>
				      <div class="checkbox">
				        <label>
				          <input type="checkbox"> Check me out
				        </label>
				      </div>
				      <button class="btn btn-default" type="submit">Submit</button>
				    </form>
				    <h4>Inline form</h4>
				    <form role="form" class="form-inline">
				      <div class="form-group">
				        <label for="exampleInputEmail2" class="sr-only">Email address</label>
				        <input type="email" placeholder="Enter email" id="exampleInputEmail2" class="form-control">
				      </div>
				      <div class="form-group">
				        <div class="input-group">
				          <div class="input-group-addon">@</div>
				          <input type="email" placeholder="Enter email" class="form-control">
				        </div>
				      </div>
				      <div class="form-group">
				        <label for="exampleInputPassword2" class="sr-only">Password</label>
				        <input type="password" placeholder="Password" id="exampleInputPassword2" class="form-control">
				      </div>
				      <div class="checkbox">
				        <label>
				          <input type="checkbox"> Remember me
				        </label>
				      </div>
				      <button class="btn btn-default" type="submit">Sign in</button>
				    </form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Checkboxes and radios</h3>
					<p>Checkboxes are for selecting one or several options in a list, while radios are for selecting one option from many.</p>
					<p>A checkbox or radio with the <code>disabled</code> attribute will be styled appropriately. To have the <code>&lt;label&gt;</code> for the checkbox or radio also display a "not-allowed" cursor when the user hovers over the label, add the <code>.disabled</code> class to your <code>.radio</code>, <code>.radio-inline</code>, <code>.checkbox</code>, <code>.checkbox-inline</code>, or <code>&lt;fieldset&gt;</code>.</p>
					<form role="form">
				      <div class="checkbox">
				        <label>
				          <input type="checkbox" value="">
				          Option one is this and that&mdash;be sure to include why it's great
				        </label>
				      </div>
				      <div class="checkbox disabled">
				        <label>
				          <input type="checkbox" disabled="" value="">
				          Option two is disabled
				        </label>
				      </div>
				      <br>
				      <div class="radio">
				        <label>
				          <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios">
				          Option one is this and that&mdash;be sure to include why it's great
				        </label>
				      </div>
				      <div class="radio">
				        <label>
				          <input type="radio" value="option2" id="optionsRadios2" name="optionsRadios">
				          Option two can be something else and selecting it will deselect option one
				        </label>
				      </div>
				      <div class="radio disabled">
				        <label>
				          <input type="radio" disabled="" value="option3" id="optionsRadios3" name="optionsRadios">
				          Option three is disabled
				        </label>
				      </div>
				    </form>
				    <h4>Inline checkboxes and radios</h4>
				    <form role="form">
				      <label class="checkbox-inline">
				        <input type="checkbox" value="option1" id="inlineCheckbox1"> 1
				      </label>
				      <label class="checkbox-inline">
				        <input type="checkbox" value="option2" id="inlineCheckbox2"> 2
				      </label>
				      <label class="checkbox-inline">
				        <input type="checkbox" value="option3" id="inlineCheckbox3"> 3
				      </label>
				    </form>
				    <h4>Selects</h4>
				    <form role="form">
				      <select class="form-control">
				        <option>1</option>
				        <option>2</option>
				        <option>3</option>
				        <option>4</option>
				        <option>5</option>
				      </select>
				      <br>
				      <select class="form-control" multiple="">
				        <option>1</option>
				        <option>2</option>
				        <option>3</option>
				        <option>4</option>
				        <option>5</option>
				      </select>
				    </form>
				    <h4>Disabled inputs</h4>
				    <form role="form">
				      <input type="text" disabled="" placeholder="Disabled input here…" id="disabledInput" class="form-control">
				    </form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Buttons</h3>
					<p>Use any of the available button classes to quickly create a styled button.</p>
					<button class="btn btn-default" type="button">Default</button>
					<button class="btn btn-primary" type="button">Primary</button>
					<button class="btn btn-success" type="button">Success</button>
					<button class="btn btn-info" type="button">Info</button>
					<button class="btn btn-warning" type="button">Warning</button>
					<button class="btn btn-danger" type="button">Danger</button>
					<button class="btn btn-link" type="button">Link</button>
					<h4>Sizes</h4>
				    <p>
				      <button class="btn btn-primary btn-lg" type="button">Large button</button>
				      <button class="btn btn-default btn-lg" type="button">Large button</button>
				    </p>
				    <p>
				      <button class="btn btn-primary" type="button">Default button</button>
				      <button class="btn btn-default" type="button">Default button</button>
				    </p>
				    <p>
				      <button class="btn btn-primary btn-sm" type="button">Small button</button>
				      <button class="btn btn-default btn-sm" type="button">Small button</button>
				    </p>
				    <p>
				      <button class="btn btn-primary btn-xs" type="button">Extra small button</button>
				      <button class="btn btn-default btn-xs" type="button">Extra small button</button>
				    </p>
				    <h4>Single button dropdowns</h4>
				    <div class="btn-group">
				      <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">Default <span class="caret"></span></button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">Primary <span class="caret"></span></button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">Success <span class="caret"></span></button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">Info <span class="caret"></span></button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle" type="button">Warning <span class="caret"></span></button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle" type="button">Danger <span class="caret"></span></button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <h4>Single button dropdowns</h4>
				    <div class="btn-group">
				      <button class="btn btn-default" type="button">Default</button>
				      <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button">
				        <span class="caret"></span>
				        <span class="sr-only">Toggle Dropdown</span>
				      </button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button class="btn btn-primary" type="button">Primary</button>
				      <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
				        <span class="caret"></span>
				        <span class="sr-only">Toggle Dropdown</span>
				      </button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button class="btn btn-success" type="button">Success</button>
				      <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button">
				        <span class="caret"></span>
				        <span class="sr-only">Toggle Dropdown</span>
				      </button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button class="btn btn-info" type="button">Info</button>
				      <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">
				        <span class="caret"></span>
				        <span class="sr-only">Toggle Dropdown</span>
				      </button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button class="btn btn-warning" type="button">Warning</button>
				      <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle" type="button">
				        <span class="caret"></span>
				        <span class="sr-only">Toggle Dropdown</span>
				      </button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				    <div class="btn-group">
				      <button class="btn btn-danger" type="button">Danger</button>
				      <button data-toggle="dropdown" class="btn btn-danger dropdown-toggle" type="button">
				        <span class="caret"></span>
				        <span class="sr-only">Toggle Dropdown</span>
				      </button>
				      <ul role="menu" class="dropdown-menu">
				        <li><a href="#">Action</a></li>
				        <li><a href="#">Another action</a></li>
				        <li><a href="#">Something else here</a></li>
				        <li class="divider"></li>
				        <li><a href="#">Separated link</a></li>
				      </ul>
				    </div><!-- /btn-group -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Input groups</h3>
					<p>Extend form controls by adding text or buttons before, after, or on both sides of any text-based <code>&lt;input&gt;</code>. Use <code>.input-group</code> with an <code>.input-group-addon</code> to prepend or append elements to a single <code>.form-control</code>.</p>
				    <div class="input-group">
				      <span class="input-group-addon">@</span>
				      <input type="text" placeholder="Username" class="form-control">
				    </div>
				    <br>
				    <div class="input-group">
				      <input type="text" class="form-control">
				      <span class="input-group-addon">.00</span>
				    </div>
				    <br>
				    <div class="input-group">
				      <span class="input-group-addon">$</span>
				      <input type="text" class="form-control">
				      <span class="input-group-addon">.00</span>
				    </div>
				    <h4>Checkboxes and radio addons</h4>
				    <div class="row">
				      <div class="col-lg-6">
				        <div class="input-group">
				          <span class="input-group-addon">
				            <input type="checkbox">
				          </span>
				          <input type="text" class="form-control">
				        </div><!-- /input-group -->
				      </div><!-- /.col-lg-6 -->
				      <div class="col-lg-6">
				        <div class="input-group">
				          <span class="input-group-addon">
				            <input type="radio">
				          </span>
				          <input type="text" class="form-control">
				        </div><!-- /input-group -->
				      </div><!-- /.col-lg-6 -->
				    </div><!-- /.row -->
				    <h4>Button addons</h4>
				    <div class="row">
				      <div class="col-lg-6">
				        <div class="input-group">
				          <span class="input-group-btn">
				            <button type="button" class="btn btn-default">Go!</button>
				          </span>
				          <input type="text" class="form-control">
				        </div><!-- /input-group -->
				      </div><!-- /.col-lg-6 -->
				      <div class="col-lg-6">
				        <div class="input-group">
				          <input type="text" class="form-control">
				          <span class="input-group-btn">
				            <button type="button" class="btn btn-default">Go!</button>
				          </span>
				        </div><!-- /input-group -->
				      </div><!-- /.col-lg-6 -->
				    </div><!-- /.row -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Breadcrumbs</h3>
					<p>Indicate the current page's location within a navigational hierarchy.</p>
					<ol style="margin-bottom: 5px;" class="breadcrumb">
				      <li><a href="#">Home</a></li>
				      <li><a href="#">Library</a></li>
				      <li class="active">Data</li>
				    </ol>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Pagination</h3>
					<p>Provide pagination links for your site or app with the multi-page pagination component, or the simpler <a href="#pagination-pager">pager alternative</a>.</p>
					<ul class="pagination">
				      <li class="disabled"><a href="#">«</a></li>
				      <li class="active"><a href="#">1</a></li>
				      <li><a href="#">2</a></li>
				      <li><a href="#">3</a></li>
				      <li><a href="#">4</a></li>
				      <li><a href="#">5</a></li>
				      <li><a href="#">»</a></li>
				    </ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Label</h3>
					<p>Add any of the below mentioned modifier classes to change the appearance of a label.</p>
				    <span class="label label-default">Default</span>
				    <span class="label label-primary">Primary</span>
				    <span class="label label-success">Success</span>
				    <span class="label label-info">Info</span>
				    <span class="label label-warning">Warning</span>
				    <span class="label label-danger">Danger</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Badges</h3>
					<p>Add the badges component to any list group item and it will automatically be positioned on the right.</p>
					<div class="row">
						<div class=" col-md-4 col-lg-5">
						    <ul class="list-group">
						      <li class="list-group-item">
						        <span class="badge">14</span>
						        Cras justo odio
						      </li>
						      <li class="list-group-item">
						        <span class="badge">2</span>
						        Dapibus ac facilisis in
						      </li>
						      <li class="list-group-item">
						        <span class="badge">1</span>
						        Morbi leo risus
						      </li>
						    </ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Togglable tabs <small>tab.js</small></h3>
					<p>Add quick, dynamic tab functionality to transition through panes of local content, even via dropdown menus.</p>
				    <ul role="tablist" class="nav nav-tabs" id="myTab">
				      <li class="active"><a data-toggle="tab" role="tab" href="#home">Home</a></li>
				      <li><a data-toggle="tab" role="tab" href="#profile">Profile</a></li>
				      <li class="dropdown">
				        <a data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop1" href="#">Dropdown <span class="caret"></span></a>
				        <ul aria-labelledby="myTabDrop1" role="menu" class="dropdown-menu">
				          <li><a data-toggle="tab" role="tab" tabindex="-1" href="#dropdown1">@fat</a></li>
				          <li><a data-toggle="tab" role="tab" tabindex="-1" href="#dropdown2">@mdo</a></li>
				        </ul>
				      </li>
				    </ul>
				    <div class="tab-content" id="myTabContent">
				      <div id="home" class="tab-pane fade in active">
				        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
				      </div>
				      <div id="profile" class="tab-pane fade">
				        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
				      </div>
				      <div id="dropdown1" class="tab-pane fade">
				        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
				      </div>
				      <div id="dropdown2" class="tab-pane fade">
				        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
				      </div>
				    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Alert messages <small>alert.js</small></h3>
					<p>Add dismiss functionality to all alert messages with this plugin.</p>
					<div class="alert alert-default fade in">
				      <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
				    </div>
				    <div class="alert alert-primary fade in">
				      <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
				    </div>
				    <div class="alert alert-success fade in">
				      <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
				    </div>
				    <div class="alert alert-info fade in">
				      <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
				    </div>
					<div class="alert alert-warning fade in">
				      <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
				    </div>
					<div class="alert alert-danger fade in">
				      <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				      <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
				    </div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>Expertise Skills</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. of Quisque ultricies vestibulum molestie. Graphic Design the power of Suspendisse ultricies Graphic Design the power of Suspendisse potenti.</p>
					<div class="progress">
						<div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped">
							<span class="sr-only">40% Complete (success)</span>
						</div>
					</div>
					<div class="progress">
						<div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info progress-bar-striped">
							<span class="sr-only">20% Complete (info)</span>
						</div>
					</div>
					<div class="progress">
						<div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning progress-bar-striped">
							<span class="sr-only">60% Complete (warning)</span>
						</div>
					</div>
					<div class="progress">
						<div style="width: 80%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger progress-bar-striped">
							<span class="sr-only">80% Complete (danger)</span>
						</div>
					</div>
					<div class="progress">
						<div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-primary progress-bar-striped">
							<span class="sr-only">100% Complete (primary)</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include "footer.php"; ?>
</body>
</html>