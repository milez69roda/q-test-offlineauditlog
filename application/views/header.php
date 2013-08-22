<!DOCTYPE html>
<html>
<head>
<title>Offline Auditors log</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?php echo base_url(); ?>"/>

<!-- Bootstrap -->
<!--<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">-->
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/datepicker.css" rel="stylesheet" media="screen">

<script src="js/jquery.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/apps.js"></script>

 
<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		font-size: 12px !important;
		padding-top: 45px;
	}

	.row-fluid{ 
		padding: 5px 10px;
	}
  
	.dataTable thead tr th {
		background-color: #EEE !important;
		border-bottom: 1px solid #000000;
		border-left: 1px solid #fff; 
	}
	
	.row{
		margin-left: 0px !important;
	}
</style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

<script>
$(document).ready(function () {

	/* $("a[data-toggle=tooltip]").tooltip({
	  'selector': '',
	  'placement': 'top'
	}); */
	
	/* $("body").on('hover', 'a[data-toggle=tooltip]', function(event){
		alert(1);
	}) */
});
	
</script>
	
</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#" style="font-weight: bold">Offline Auditors log</a>
          <div class="nav-collapse collapse">
		   <?php 
				 
		   ?>
            <ul class="nav">
				<li <?php echo @($nactive == 'home')?'class="active"':''; ?>><a href="#">Home</a></li> 
				<li <?php echo @($nactive == 'channel')?'class="active"':''; ?> class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Channel <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php 
							foreach( $this->channels as $key=>$row ): 
								if( in_array($key, $this->ch_access) ):
						?>
									<li><a href="<?php echo $row->ch_link?>"><?php echo $row->ch_name; ?></a></li>
						<?php 
								endif; 
							endforeach; ?>
						 
					</ul>
				</li>
				<li <?php echo @($nactive == 'overview')?'class="active"':''; ?>><a href="overview">Overview</a></li> 
				<?php if( $this->session->userdata('OFFAL_ISSUPER') ): ?>		 				
				<li class="dropdown">				
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Summary <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li <?php echo @($nactive == 'scorecard')?'class="active"':''; ?>><a href="scorecard/audits">Scorecard Reports</a></li>
						<li <?php echo @($nactive == 'management')?'class="active"':''; ?>><a href="management/audits">Management Reports</a></li>
					</ul>
				</li> 
				<?php endif; ?>
            </ul>
		
            		
            <div class=" pull-right" style="color: #ccc; position: relative; line-height: 38px;"> 
				<div class="dropdown">	 
					<div class="dropdown">
					Logged in as  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href=""> <?php echo $this->session->userdata('OFFAL_FULLNAME'); ?> (<?php echo $this->session->userdata('OFFAL_AUDITOR_CODE'); ?>) <b class="caret" style="margin-top: 17px;"></b> </a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li><a href="myaccount">Manage Account</a></li> 
						<li class="divider"></li>
						<li><a href="logout">Logout</a></li>    
					</ul>
					</div>
				</div>
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
	
	<div class="<?php echo isset($container)?$container:'container'; ?>">	 