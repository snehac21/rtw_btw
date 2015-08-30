<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>

<!-- Site: HackForums.Ru | E-mail: abuse@hackforums.ru | Skype: h2osancho -->
<head>
    <!-- Page title -->
    <title>BTW VISAS ONLINE</title>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!--<link rel="shortcut icon" type="image/ico" href="favicon.ico" />-->

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/fontawesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/metisMenu/dist/metisMenu.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/animate.css/animate.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/vendor/jquery-ui/themes/base/all.css" />

    <!-- App styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/fonts/pe-icon-7-stroke/css/helper.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/styles/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/styles/custom.css">
	
	<script src="<?php echo base_url(); ?>public/vendor/jquery/dist/jquery.min.js"></script>

    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>
<body class = "<?php echo ($this->session->userdata('user_group_id')) ? 'show-sidebar':'hide-sidebar'?>">
</head>
<?php if($this->session->userdata('user_group_id'))
{
    ?>
<div id="header">
    <div class="color-line">
    </div>
    <div id="logo" class="light-version">
        <span>
           BTW VISAS ONLINE
        </span>
    </div>
    <nav role="navigation">
        <div class="header-link hide-menu"><i class="fa fa-bars"></i></div>
        <div class="small-logo">
            <span class="text-primary">BTW VISAS ONLINE</span>
        </div>
        
        <div class="navbar-right">
            <ul class="nav navbar-nav no-borders">
                <li class="dropdown">
                    <a href="<?php echo base_url();?>index.php/login/logout">
                        <i class="pe-7s-upload pe-rotate-90"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<?php }
?>