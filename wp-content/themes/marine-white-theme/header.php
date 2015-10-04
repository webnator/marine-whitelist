<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />


<title> Marine Whitelist </title>


<?php wp_head(); ?>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row">
    	<div class="col-md-10 col-md-offset-1">

    		<div class="col-xs-12 visible-xs visible-sm">
    			<div class="row">
    				<div class="col-xs-2">
    					<button type="button" 
    						class="btn btn-default btn-header header-toggler" 
    						data-toggler-target="menuBox"
    						aria-label="Left Align">
							  <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
							</button>
    				</div>
    				<div class="col-xs-8" style="text-align:center;">

    					<img 
			      		class="navbar-logo"
			      		src="<?php echo get_stylesheet_directory_uri(); ?>/img/MWL-Logo.png"/>

    				</div>
    				<div class="col-xs-2">
    					<button type="button" 
    						class="btn btn-default btn-header header-toggler"
    						data-toggler-target="searchBox"
    						aria-label="Left Align">
							  <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
							</button>
    				</div>
    			</div>
    		</div>

    		<div id="searchBox" class="mobile-box">
    			<form class="" role="search" style="margin-bottom:0px;">
		        <div class="col-xs-8">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">
		        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		      </form>

		      <span class="close-box-btn">x</span>
    		</div>


    		<div id="menuBox" class="mobile-box">
    			<ul class="ul-menu-box">
    				<li>About Us</li>
    				<li>Categories</li>
    				<li>Schedule</li>
    				<li>My Account</li>
    				<li class="highlight">Sign Up</li>

    			</ul>


		      <span class="close-box-btn">x</span>
    		</div>

 				
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		      	<li class="">
		      		<a href="#" class="list-logo">
		      			<img 
				      		class="navbar-logo"
				      		src="<?php echo get_stylesheet_directory_uri(); ?>/img/MWL-Logo.png"/>
		      		</a>
		      	</li>
		        <li class=""><a href="#">About Us <span class="sr-only">(current)</span></a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		          	Categories</a>
		          <div class="dropdown-menu dropdown-categories">
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		          	<div class="col-md-4">
		          		Boat
		          	</div>
		            
		          </div>
		        </li>

		        <li><a href="#">Schedule Service</a></li>
		        
		        <!-- <li><a href="#">My Account</a></li> -->

		        
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
		          	My Account</a>
		          <ul class="dropdown-menu">
		            <li><a href="#">Log In</a></li>
		            <li><a href="#">Register</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="#">Service Providers</a></li>
		          </ul>
		        </li>
		      </ul>
		      <form class="navbar-form navbar-right" role="search">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">
		        	<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
		      </form>
		      
		    </div><!-- /.navbar-collapse -->
		  </div>
		</div>
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid" style="padding-left:0px;">
	<div class='container'>
		<div class="row">
			<div class="col-md-12">
				<?php putRevSlider("home-slider"); ?>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-12">
				<div class="row">

				</div>
			</div>
		</div>
	</div>