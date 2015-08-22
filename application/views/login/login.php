<div class="login-container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center m-b-md">
                <h3>PLEASE LOGIN TO HERE</h3>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                <?php if($this->session->flashdata('message')) : ?><div class="alert alert-warning"><?php echo $this->session->flashdata('message');?></div><?php endif; ?>
					<?php echo form_open('login/do_login',array('id'=>'loginfrm'));?>
                        
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <?php echo form_input(array('name'=>'username','id'=>'username','class'=>'form-control','placeholder'=>'Username','value'=>set_value('username')));?>
                                <?php echo form_error('username', '<p class="text-danger">', '</p>');?>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <?php echo form_password(array('name'=>'password','id'=>'password','class'=>'form-control','placeholder'=>'Password'));?>
								<?php echo form_error('password','<p class="text-danger">', '</p>');?>
                            </div>
                           	<?php  echo form_submit('submit','Login','class=" btn btn-success btn-block"');?>
                        </form>
                </div>
            </div>
        </div>
 	</div>
</div>