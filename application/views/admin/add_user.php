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
                <form action = "<?php echo base_url();?>index.php/admin/save_user" method="post" id = "addUserForm" name = "addUserForm" method="post" class="form-horizontal">
                <div class="col-lg-6">
                    <div class="form-group"><label class="col-sm-4 control-label">Select User Type</label>
                        <div class="col-sm-8">
                            <?php $user_type_arr = array(''=>'Select') + $user_type_arr;
                            $user_type = isset($user_group_id) ?  $user_group_id : set_value('user_type');
                            echo form_dropdown('user_type', $user_type_arr,$user_type,'class ="form-control m-b" id="user_type"');
                            ?>
                            <?php echo form_error('user_type', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <?php
                             $user_email = isset($email) ?  $email : set_value('user_email');
                             $data = array('name'=> 'user_email','id' => 'user_email','value'=> $user_email,'class' => 'form-control','placeholder' => 'Email');
                            echo form_input($data); ?>
                            <?php echo form_error('user_email', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div id="corporateDiv">
                    <div class="form-group"><label class="col-sm-4 control-label">Business Name</label>
                        <div class="col-sm-8">
                            <?php 
                            $bus_name = isset($first_name) ?  $first_name : set_value('bus_name');
                            $data = array('name'=> 'bus_name','id' => 'bus_name','value'=> $bus_name,'class' => 'form-control','placeholder' => 'Business Name');
                                echo form_input($data); ?>
                            <?php echo form_error('bus_name', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    </div>
                    <div id="personalDiv">
                      <div class="form-group"><label class="col-sm-4 control-label">First Name</label>
                        <div class="col-sm-8">
                            <?php 
                            $first_name = isset($first_name) ?  $first_name : set_value('first_name');
                            $data = array('name'=> 'first_name','id' => 'first_name','value'=> $first_name,'class' => 'form-control','placeholder' => 'First Name');
                                echo form_input($data); ?>
                            <?php echo form_error('first_name', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                      <div class="form-group"><label class="col-sm-4 control-label">Last Name</label>
                        <div class="col-sm-8">
                            <?php 
                            $last_name = isset($last_name) ?  $last_name : set_value('last_name');
                            $data = array('name'=> 'last_name','id' => 'last_name','value'=> $last_name,'class' => 'form-control','placeholder' => 'Last Name');
                                echo form_input($data); ?>
                            <?php echo form_error('last_name', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <?php $user_name = isset($username) ?  $username : set_value('user_name');
                            $data = array('name'=> 'user_name','id' => 'user_name','value'=> $user_name,'class' => 'form-control','placeholder' => 'Name');
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
                            <?php 
                            $user_contact = isset($contact_no) ?  $contact_no : set_value('user_contact');
                            $data = array('name'=> 'user_contact','id' => 'user_contact','value'=> $user_contact,'class' => 'form-control','placeholder' => 'Contact No.');
                                echo form_input($data); ?>
                            <?php echo form_error('user_contact', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Alt. Contact no.</label>
                        <div class="col-sm-8">
                            <?php $alt_contact = isset($alt_contact) ?  $alt_contact : set_value('alt_contact');
                            $data = array('name'=> 'alt_contact','id' => '','value'=> $alt_contact,'class' => 'form-control','placeholder' => 'Alt. Contact no.');
                                echo form_input($data); ?>
                            <?php echo form_error('alt_contact', '<p class="text-danger">', '</p>');?>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <?php $user_area = isset($address) ?  $address : set_value('user_area');
                        $data = array('name'=> 'user_area','id' => 'user_area','value'=> $user_area,'class' => 'form-control','placeholder' => 'Enter Address','cols'=>'10','rows'=>'3');
                        echo form_textarea($data); ?>
                        <?php echo form_error('user_area', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">Country</label>
                    <div class="col-sm-8">
                        <?php 
                        $country_master = array(''=>'Select Country') + $country_master;
                        $country_id = isset($country_id) ?  $country_id : set_value('user_country');
         ;               echo form_dropdown('user_country', $country_master, $country_id,'class ="form-control m-b" onchange = "countrywiseState(this.value)"');
                        ?>
                        <?php echo form_error('user_country', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div> 
                    <div class="form-group"><label class="col-sm-4 control-label">State</label>
                    <div class="col-sm-8">
                        <?php 
                        $state_master = isset($state_master) ? $state_master : array('' => '--');
                        $state = isset($state) ?  $state : set_value('user_state');
                       // echo form_dropdown('user_state', $state, '');
                        ?>
                        <select name="user_state" class ="form-control m-b" onchange = "statewiseCity(this.value)" id="stateDropdown">
                        <?php foreach($state_master as $sk=>$sv) : ?>
                            <option value="<?php echo $sk; ?>" <?php echo ($sk == $state) ? 'selected="selected"' : '' ?>><?php echo $sv;?></option>
                        <?php endforeach; ?>
                        </select>
                        <?php echo form_error('user_state', '<p class="text-danger">', '</p>');?>
                    </div>
                    </div>

                    <div class="form-group"><label class="col-sm-4 control-label">City</label>
                    <div class="col-sm-8">
                        <?php 
                        $city_master = isset($city_master) ? $city_master : array('' => '--');
                        $city = isset($city) ?  $city : set_value('user_city');
                        //echo form_dropdown('user_city', $city, '','class ="form-control m-b" ');
                        ?>
                         <select  name="user_city" class ="form-control m-b" id="cityDropdown">
                        <?php foreach($city_master as $sk=>$sv) : ?>
                            <option value="<?php echo $sk; ?>" <?php echo ($sk == $city) ? 'selected="selected"' : '' ?>><?php echo $sv;?></option>
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

