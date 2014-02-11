<?php $this->load->view('include/header')?>


<?php echo form_open('admin/auth', array('class' => 'text_center'))?>

    <h5>Administrator Login Only</h5>	
    <?php $this->flash->show(); ?>

    <div class="form-group">
    	<div class="form-label">
			<?php echo form_label('E-mail', 'email'); ?>
		</div>
	    <div class="form-control">
			<?php $data = array('name' => 'email', 'required' => 'true', 'autofocus' => 'true');
			echo form_input($data);
			?>
	    </div>
	</div>

	<div class="form-group">
    	<div class="form-label">
			<?php echo form_label('Password', 'password'); ?>
		</div>
	    <div class="form-control">
			<?php $data = array('name' => 'password', 'required' => 'true');
			echo form_password($data);
			?>
	    </div>
	</div>

<?php
	$data = array('value' => 'Login', 'class'=> 'button');
	echo form_submit($data);
	?>

<?php echo form_close()?>



<?php $this->load->view('include/footer')?>