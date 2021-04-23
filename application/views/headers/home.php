<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo lang('home'); ?></title>
	<link rel="shortcut icon" href="<?php if(isset($system->logo) && $system->logo != '') echo base_url().$system->logo; ?>">

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>gentelella-master/vendors/nprogress/nprogress.css" rel="stylesheet">	<!-- PNotify -->    <link href="<?php echo base_url(); ?>gentelella-master/vendors/pnotify/dist/pnotify.css" rel="stylesheet">    <link href="<?php echo base_url(); ?>gentelella-master/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">    <link href="<?php echo base_url(); ?>gentelella-master/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>gentelella-master/build/css/custom.<?php echo $this->loginuser->dir; ?>.min.css" rel="stylesheet">	<style>      /* Always set the map height explicitly to define the size of the div       * element that contains the map. */	  #map {		text-align:center;		min-height: 500px;		width: 80%;		height:100%;	  }      /* Optional: Makes the sample page fill the window. */      html, body {        height: 100%;        margin: 0;        padding: 0;      }	  <!--a[href^="http://maps.google.com/maps"]{display:none !important}	  a[href^="https://maps.google.com/maps"]{display:none !important}-->	  .gmnoprint a, .gmnoprint span, .gm-style-cc {		display:none;	  }	  .gmnoprint div {		background:none !important;	  }    </style>	<?php if($this->loginuser->dir == 'ltr') { ?>		<style>			#map {				border-top-left-radius: 55px;				border-bottom-right-radius: 55px;			}		</style>	<?php } else { ?>		<style>			#map {				border-top-right-radius: 55px;				border-bottom-left-radius: 55px;			}		</style>		<?php }?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">