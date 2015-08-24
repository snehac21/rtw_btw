<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
}
</style>
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="<?php echo base_url(); ?>/index.php/admin/home">Dashboard</a></li>
                    <li>
                        <span>Masters</span>
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


<div>
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-body ">
				<div style="padding:20px;">
					<?php echo $output; ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
