<div class="page-content">
	<div class="page-header position-relative">
		<h1>Change Password
		</h1>
	</div><!--/.page-header-->

	<div class="row-fluid">
		<div class="span8">
		<div class="widget-box">
											<div class="widget-header">
												<h4>Change Password</h4>

												
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<?php if($this->session->flashdata('message')) echo '<div class = "alert alert-success" >'.$this->session->flashdata('message').'</div>';?>
													<?php echo form_open('login/save_password',array('class'=>'form-horizontal','id'=>'changepwdfrm'));?>
													
													<div class="control-group">
														<label class="control-label" for="form-field-1">Current Password</label>
														<div class="controls">
															<?php echo form_password(array('name'=>'current_pass','id'=>'current_pass','class'=>'span12','value'=>''));?>
															<?php echo form_error('current_pass', '<div class="red">', '</div>');?>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="form-field-1">Password</label>
														<div class="controls">
															<?php echo form_password(array('name'=>'pass','id'=>'pass','class'=>'span12','value'=>set_value('pass')));?>
															<?php echo form_error('pass', '<div class="red">', '</div>');?>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="form-field-1">Confirm Password</label>
														<div class="controls">
															<?php echo form_password(array('name'=>'cpass','id'=>'cpass','class'=>'span12','value'=>set_value('cpass')));?>
														<?php echo form_error('cpass', '<div class="red">', '</div>');?>
														</div>
													</div>
													<div class="form-actions">
													<?php echo form_submit('submit','Save','class="btn btn-primary"');?>
													<?php echo anchor('login/get_home_page','Back','class="btn btn-info"');?>
													</div>
												</div>
											</div>
										</div>
		</div>
	</div>
</div>