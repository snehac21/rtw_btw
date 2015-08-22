<div class="page-content">
	<div class="page-header position-relative">
		<h1>Edit User
		</h1>
	</div><!--/.page-header-->

	<div class="row-fluid">
		<div class="span8">
		<div class="widget-box">
											<div class="widget-header">
												<h4>Update User</h4>

												
											</div>

											<div class="widget-body">
												<div class="widget-main">
													
													<?php echo form_open('admin/save_user',array('class'=>'form-horizontal','id'=>'edituserfrm'));?>
													<?php echo form_hidden('uid',$uid);?>
													<div class="control-group">
														<label class="control-label" for="form-field-1">Select Role</label>
														<div class="controls">
															<?php echo isset($role) ? form_dropdown('role',$role_arr,$role) : form_dropdown('role',$role_arr,set_value('role'));?>
															<?php echo form_error('role', '<div class="red">', '</div>');?>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="form-field-1">Username</label>
														<div class="controls">
															<?php echo isset($username) ? form_input(array('name'=>'username','id'=>'username','class'=>'span12','value'=>$username)) : form_input(array('name'=>'username','id'=>'username','class'=>'span12','value'=>set_value('username')));?>
														<?php echo form_error('username', '<div class="red">', '</div>');?>
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
													<?php echo anchor('admin/users_listing','Back','class="btn btn-info"');?>
													</div>
												</div>
											</div>
										</div>
		</div>
	</div>
</div>