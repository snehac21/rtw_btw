<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="<?php echo base_url(); ?>/index.php/admin/home">Dashboard</a></li>
                    <li>
                        <span>Users</span>
                    </li>
                    <li class="active">
                        <span>Add New User</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Add New User
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">

<div>
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-body ">
                <form action = "<?php echo base_url();?>index.php/admin/save_user" id = "addUserForm" name = "addUserForm" method="post" class="form-horizontal">
                <div class="col-lg-6">
                    <div class="form-group"><label class="col-sm-4 control-label">Select User Type</label>
                        <div class="col-sm-8">
                            <?php $user_type_arr = array(''=>'Select') + $user_type_arr;
                            echo form_dropdown('user_type', $user_type_arr, '','class ="form-control m-b" ');
                            ?>
                            <?php echo form_error('user_type', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'user_email','id' => 'user_email','value'=> '','class' => 'form-control','placeholder' => 'Email');
                            echo form_input($data); ?>
                            <?php echo form_error('user_email', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Business Name</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'bus_name','id' => 'bus_name','value'=> '','class' => 'form-control','placeholder' => 'Business Name');
                                echo form_input($data); ?>
                            <?php echo form_error('bus_name', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'user_name','id' => 'user_name','value'=> '','class' => 'form-control','placeholder' => 'Name');
                                echo form_input($data); ?>
                            <?php echo form_error('user_name', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'new_password','id' => 'new_password','value'=> '','class' => 'form-control','placeholder' => 'New Password');
                            echo form_password($data); ?>
                            <?php echo form_error('new_password', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'confirm_password','id' => 'confirm_password','value'=> '','class' => 'form-control','placeholder' => 'Confirm Password');
                            echo form_password($data); ?>
                            <?php echo form_error('confirm_password', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group"><label class="col-sm-4 control-label">Contact no.</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'user_contact','id' => 'user_contact','value'=> '','class' => 'form-control','placeholder' => 'Contact No.');
                                echo form_input($data); ?>
                            <?php echo form_error('user_contact', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Alt. Contact no.</label>
                        <div class="col-sm-8">
                            <?php $data = array('name'=> 'alt_contact','id' => '','value'=> '','class' => 'form-control','placeholder' => 'Alt. Contact no.');
                                echo form_input($data); ?>
                            <?php echo form_error('alt_contact', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <?php $data = array('name'=> 'user_area','id' => 'user_area','value'=> '','class' => 'form-control','placeholder' => 'Enter Address','cols'=>'10','rows'=>'3');
                        echo form_textarea($data); ?>
                        <?php echo form_error('user_area', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">Country</label>
                    <div class="col-sm-8">
                        <?php 
                        $country_master = array(''=>'Select Country') + $country_master;
         ;               echo form_dropdown('user_country', $country_master, '','class ="form-control m-b" onchange = "countrywiseState(this.value)"');
                        ?>
                        <?php echo form_error('user_country', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">State</label>
                    <div class="col-sm-8">
                        <?php 
                        $state = array('' => '--');
                       // echo form_dropdown('user_state', $state, '');
                        ?>
                        <select name="user_state" class ="form-control m-b" onchange = "statewiseCity(this.value)" id="stateDropdown">
                        <?php foreach($state as $sk=>$sv) : ?>
                            <option value="<?php echo $sk; ?>"><?php echo $sv;?></option>
                        <?php endforeach; ?>
                        </select>
                        <?php echo form_error('user_state', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div>

                    <div class="form-group"><label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-8">
                        <?php 
                        $city = array('' => '--');
                        //echo form_dropdown('user_city', $city, '','class ="form-control m-b" ');
                        ?>
                         <select  name="user_city" class ="form-control m-b" id="cityDropdown">
                        <?php foreach($city as $sk=>$sv) : ?>
                            <option value="<?php echo $sk; ?>"><?php echo $sv;?></option>
                        <?php endforeach; ?>
                        </select>
                        <?php echo form_error('user_city', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div>
                </div>    
				<div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <?php echo form_submit('submit','Submit','class="btn btn-success"');
                            echo anchor('admin/home','Back','class="btn btn-default"');
                            ?>
                        </div>
                </div>	
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>

