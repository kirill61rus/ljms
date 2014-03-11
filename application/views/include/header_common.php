<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<link href="<?=base_url('style/reset.css')?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('style/style.css')?>" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?=base_url();?>js/libraries/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/libraries/jquery.validate.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/delete.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/calendar.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/validation.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/mass_action.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/roles.js"></script>
		<script type="text/javascript" src="<?=base_url();?>js/teams_for_division.js"></script>
		<script type="text/javascript">var base_url = '<?php echo base_url() ?>';</script>
		<script type="text/javascript">var get_id = "<?php if ($this->input->get('id')) { echo'?id='.$this->input->get('id');} ?>";</script>

		<!--for date form -->
		<link rel="stylesheet" href="<?=base_url('style/jquery.datepick.css')?>">
		<script src="<?=base_url();?>js/libraries/jquery.datepick.js"></script>
		<script src="<?=base_url();?>js/libraries/jquery.mask.min.js"></script>

		<script type="text/javascript">
       		var current_method = '<?php echo $this->router->class;  ?>';
    	</script>
		<!--[if IE 7]>
			<link href="<?=base_url('style/ie7.css')?>" rel="stylesheet" type="text/css" />
		<![endif]-->
		<title><?=isset($title) ? $title : 'LJMS' ?></title>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<a href="<?=base_url()?>"><div id="logo"></div></a>
				<div id="auth_area">
					<?php 
					if ($this->session->userdata('id')) {
						echo "<a href=".base_url()."admin/auth/logout>Log out</a>";
					}
					?>
				</div>
				<?php $this->load->view('include/menu')?>
			</div>
			<div id="content">