<div class="page-content">
	<div class="page-header position-relative">
		<h1>Change Settings
		</h1>
	</div><!--/.page-header-->

	<div class="row-fluid">
		<div class="span8">
		<div class="widget-box">
											<div class="widget-header">
												<h4>Change Settings</h4>

												
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<?php if($this->session->flashdata('message')) echo '<div class = "alert alert-success" >'.$this->session->flashdata('message').'</div>';?>
													<?php echo form_open('admin/save_settings',array('class'=>'form-horizontal','id'=>'settingfrm'));?>
													
													<div class="control-group">
														<label class="control-label" for="form-field-1">Admin Email For Mail Notification</label>
														<div class="controls">
															<?php echo form_input(array('name'=>'admin_email','id'=>'admin_email','class'=>'span12','value'=>$admin_email));?>
															<?php echo form_error('admin_email', '<div class="red">', '</div>');?>
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