<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->title;?></title>

    <!-- Bootstrap -->
	 <?php echo "<link href=".base_url()."css/style.css rel='stylesheet'>";?>
	 <?php echo "<link href=".base_url()."css/bootstrap.css rel='stylesheet'>";?>
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="row">
		<menu class="col-lg-offset-1 col-lg-4  
					col-md-offset-0 col-md-4 
					col-sm-offset-0 col-sm-5
					col-xs-offset-0 col-xs-12" 
			  id="left_tab">
			<ul id="tabs">
				<li><a>Почта</a></li>
			</ul>
			<div id="content">
				<div id="tab1">
					<a href="<?php echo base_url().'index.php/mails/in';?>">Входящие</a>
				</div>
				<div id="tab1">
					<a href="<?php echo base_url().'index.php/mails/out';?>">Отправленные</a>
				</div>
			</div>
		</menu>
		<div class="col-lg-7  
					col-md-7 
					col-sm-7 
					col-xs-12">