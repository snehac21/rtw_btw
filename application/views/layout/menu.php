<!-- Navigation -->
<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            <a href="index-2.html">
                <img src="<?php echo base_url(); ?>images/profile.jpg" class="img-circle m-b" alt="logo">
            </a>

            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase"><?php echo $this->session->userdata['first_name'].' '.$this->session->userdata['last_name']; ?></span>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#">
                        <small class="text-muted"><?php foreach($this->session->userdata('user_group_id') as $user_g_id) { echo '<p>'.get_group_name($user_g_id).'</p>'; } ?></small>
                    </a>
                </div>
            </div>
        </div>
        <?php if($this->session->userdata) : ?>
        <ul class="nav" id="side-menu">
                <li class="active">
                    <a href="<?php echo base_url();?>/index.php/admin/home"> <span class="nav-label">Dashboard</span></a>
                </li>
        <?php if(in_array(1, $this->session->userdata('user_group_id'))) : ?>
                <li>
                    <a href="#"><span class="nav-label">Users</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url(); ?>index.php/admin/users_listing">Manage Users</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/admin/add_new_user">Add New User</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><span class="nav-label">Masters</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url(); ?>index.php/masters/country_management">Country</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/masters/state_management">State</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/masters/city_management">City</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/masters/designation_management">Designation</a></li>
                    </ul>
                </li>
        <?php endif; ?>

        <?php if(in_array(2, $this->session->userdata('user_group_id')) || in_array(1, $this->session->userdata('user_group_id'))) : ?>
                <li>
                    <a href="#"><span class="nav-label">Cases</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url(); ?>index.php/cases/caseform">Add Case</a></li>
                        <li><a href="<?php echo base_url(); ?>index.php/cases/listing">Case Listing</a></li>
                    </ul>
                </li>
            <?php endif; ?>     
        </ul>
         <?php endif; ?> 
    </div>
</aside>

<!-- Main Wrapper -->
<div id="wrapper" style = "min-height:1317px!important">