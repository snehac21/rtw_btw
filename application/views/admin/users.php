<div class="page-content">
	<div class="page-header position-relative">
		<h1>
			Users
			<small>
				<i class="icon-double-angle-right"></i>
				Listing
			</small>
		</h1>
	</div><!--/.page-header-->

	<div class="row-fluid">
		<div class="span12">
		<a class="btn btn-small btn-primary" href="<?php echo base_url();?>index.php/admin/add_new_user"><i class="icon-plus"></i>Add New User</a><br/><br/>
		<?php if($this->session->flashdata('message')) echo '<div class = "alert alert-success" >'.$this->session->flashdata('message').'</div>';?>
		<table id="usertbl" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th class="center">Sr.No.</th>
											<th class="center">Role</th>
											<th class="center">Username</th>
											<th class="center">Password</th>
											<th class="center">Last Updated At</th>
											<th class="center">Actions</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									if(isset($users_array)){ 
									$i=1;
											foreach($users_array as $user) { ?>
										<tr>
											<td class="center"><?php echo $i; ?></td>

											<td class="center"><?php echo $user['role']; ?></td>
											<td class="center"><?php echo $user['username']; ?></td>
											<td class="center"><?php echo $user['temp_pwd']; ?></td>
											<td class="center"><?php echo date('d-m-Y H:i:s',strtotime($user['updated'])); ?></td>
											<td class="td-actions">
												<div class="hidden-phone visible-desktop action-buttons">
													<a class="green" href="<?php echo base_url();?>index.php/admin/edit_user/<?php echo $user['uid'];?>">
														<i class="icon-pencil bigger-130"></i>
													</a>

													<a class="red" href="<?php echo base_url();?>index.php/admin/delete_user/<?php echo $user['uid'];?>" onclick="return confirm('Do you really want to delete this user ?')">
														<i class="icon-trash bigger-130"></i>
													</a>
												</div>
											</td>
										</tr>
									<?php $i++;}} ?>
									</tbody>
									</table>
		</div>
	</div>
</div>