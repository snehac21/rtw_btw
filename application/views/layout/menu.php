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
                        <small class="text-muted"><?php echo get_group_name($this->session->userdata['user_group_id']); ?></small>
                    </a>
                </div>
            </div>
        </div>
        <?php if($this->session->userdata['user_group_id'] == 1) : ?>
            <ul class="nav" id="side-menu">
                <li class="active">
                    <a href="<?php echo base_url();?>/index.php/admin/home"> <span class="nav-label">Dashboard</span></a>
                </li>
                <li>
                    <a href="#"><span class="nav-label">Users</span><span class="fa arrow"></span> </a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url(); ?>/index.php/admin/users_listing">Users Listing</a></li>
                        <li><a href="<?php echo base_url(); ?>/index.php/admin/add_new_user">Add New User</a></li>
                    </ul>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</aside>

<!-- Main Wrapper -->
<div id="wrapper" style = "min-height:1317px!important">