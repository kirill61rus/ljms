<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<link href="style/reset.css" rel="stylesheet" type="text/css" />
		<link href="style/style.css" rel="stylesheet" type="text/css" />
		<!--[if IE 7]>
			<link href="style/ie7.css" rel="stylesheet" type="text/css" />
		<![endif]-->
		<title><?=isset($title) ? $title : 'LJMS' ?></title>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="logo"></div>
				<div id="auth_area"></div>
				<?php $this->load->view('include/menu')?>
			</div>
			<div id="content">
				<?php $this->load->view('include/leftsidebar')?>
				<div id="base" class="column">
					<div class="content">
		
