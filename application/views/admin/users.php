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
                        <span>Users Management</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Users Management
            </h2>
        </div>
    </div>
</div>

<div>
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-body ">
                <table id="usertbl" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">Sr.No.</th>
                            <th class="center">Roles</th>
                            <th class="center">Name</th>
                            <th class="center">Username</th>
                            <th class="center">Email</th>
                            <th class="center">Contact</th>
                            <th class="center">Country/State/City</th>
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

                            <td class="center"><?php echo implode('<br/>',get_all_user_groups_name($user['id']));?></td>
                            <td class="center"><?php echo $user['first_name'].' '.$user['last_name'] ; ?></td>
                            <td class="center"><?php echo $user['username']; ?></td>
                            <td class="center"><?php echo $user['email']; ?></td>
                            <td class="center"><?php echo $user['contact_no']; ?></td>
                            <td class="center"><?php echo $user['country'].'<br/>'.$user['state_name'].'<br/>'.$user['city']; ?></td>
                            <td class="center"><?php echo date('d-m-Y H:i:s',$user['updated']); ?></td>
                            <td class="td-actions">
                                --
                            </td>
                        </tr>
                    <?php $i++;}} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>