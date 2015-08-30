<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="<?php echo base_url(); ?>/index.php/admin/home">Dashboard</a></li>
                    <li>
                        <span>Cases</span>
                    </li>
                    <li class="active">
                        <span>Case Listing</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Cases Listing
            </h2>
        </div>
    </div>
</div>

<div>
<div class="row">
    <div class="col-lg-12">
        <div class="hpanel">
            <div class="panel-body ">
                <table id="casetbl" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="center">Case Id.</th>
                            <th class="center">Request Date/Time</th>
                            <th class="center">Product</th>
                            <th class="center">Customer Type</th>
                            <th class="center">Name of Customer</th>
                            <th class="center">Tentative Travel Date</th>
                            <th class="center">Status</th>
                            <th class="center">Next Follow Up</th>
                            <th class="center">Assigned To</th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if(isset($case_list)){ 
                    $i=1;
                            foreach($case_list as $case) { ?>
                        <tr>

                            <td class="center"><?php echo $case['case_code'];?></td>
                            <td class="center"><?php echo date('d-m-Y H:i:s',$case['created']) ; ?></td>
                            <td class="center"><?php echo $product_type_master[$case['product_type_id']]; ?></td>
                            <td class="center"><?php echo $user_groups[$case['user_group_id']]; ?></td>
                            <td class="center"><?php echo $user_info[$case['customer_id']]; ?></td>
                            <td class="center"><?php echo date('d-m-Y H:i:s',$case['travel_date']); ?></td>
                            <td class="center"><?php echo $tr_status[$case['tr_status']]; ?></td>
                            <td class="center"><?php echo '-'; ?></td>
                            <td class="center"><?php echo '-'; ?></td>
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