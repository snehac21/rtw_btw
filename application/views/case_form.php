<style>
.datepicker, .datepicker2{
    position:absolute;
}
</style>
<?php

/**
    Created on : 2015-07-25
    Created By : Sunita Mistry
    Purpose : Add Inquiry Form 
    Filename : case_form.php
**/

$count = array();
for($i =0 ; $i <= 50 ; $i++){
    $count[$i] = $i; 
}

$count_adult = array();
for($i =1 ; $i <= 50 ; $i++){
    $count_adult[$i] = $i; 
}

$age = array(''=>'Select Age');
for($i = 0; $i <= 100 ; $i++){
    $age[$i] = $i;
}
?>

<div class="normalheader transition animated fadeIn small-header">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="#">
                <div class="clip-header">
                    <i class="fa fa-arrow-down"></i>
                </div>
            </a>
            <h2 class="font-light m-b-xs">
               Add New Inquiry
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">

 <div class="col-lg-8">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    <a class="closebox"><i class="fa fa-times"></i></a>
                </div>
                 Add New Inquiry
            </div>
            <div class="panel-body">
                <form action = "<?php echo base_url(); ?>index.php/cases/saveCases" id = "inquiryForm" name = "inquiryForm" method="post" class="form-horizontal">
                    <div class = "row">
                    <div class="col-lg-12 ">
                        <div class = "input-group ">
                        <?php $data = array('name'=> 'customer','id' => 'customer','value'=> '','class' => 'form-control','placeholder' => 'Type Customer Name/Code/Email/Phone');
                        echo form_input($data); 

                        $data1 = array('type'=>'hidden','name'=> 'customer_id','id' => 'customer_id','value'=> '');
                        echo form_input($data1);
                        ?>
                        <!--<input type="text" class="form-control" placeholder = "Type Customer Name/Code/Email/Phone"> -->
                        <span class="input-group-btn"> 
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="true"> + <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target="#myModal" onclick = "setType(4)">Add as Agent</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#myModal" onclick = "setType(5)">Add as Corporate</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#myModal" onclick = "setType(6)">Add as Walkin</a></li>
                                </ul>
                        </span>
                        </div>
                    </div>
                
                <div class="col-lg-6">
                    <input type = "hidden" name = "cust_code" id = "cust_code" value = "" />
                                            <label class = "col-sm-2 control-label">Name</label>
                                            <div class = "col-sm-10">
                                             <?php $data = array('name'=> 'cust_name','id' => 'cust_name','value'=> '','class' => 'form-control whiteborder ','placeholder' => '');
                        echo form_input($data); ?>
                                            </div>
                                        </div>

                <div class="col-lg-6">
                                            <label class = "col-sm-2 control-label">Mobile</label>
                                            <div class = "col-sm-10">
                                            <?php $data = array('name'=> 'cust_mobile','id' => 'cust_mobile','value'=> '','class' => 'form-control whiteborder ','placeholder' => '');
                        echo form_input($data); ?>
                                        </div>
                                        </div>

                <div class="col-lg-6">
                                            <label class = "col-sm-2 control-label">Email</label>
                                            <div class = "col-sm-10">
                                            <?php $data = array('name'=> 'cust_email','id' => 'cust_email','value'=> '','class' => 'form-control whiteborder ','placeholder' => '');
                        echo form_input($data); ?>
                                        </div>
                                    </div>

                <div class="col-lg-6">
                                            <label class = "col-sm-2 control-label">Type</label>
                                            <div class = "col-sm-10">
                                                <label id = "cust_type" class = "form-control whiteborder"></label>
                                         </div>  
                                        </div>
                                    </div>

                 <div class="hr-line-dashed"></div>

                 <h4>WHAT IS YOUR INQUIRY FOR ? </h4>
                    <div class="form-group"><label class="col-sm-2 control-label">Product</label>
                    <div class="col-sm-10">

                        <?php 
                       $product_type_master = array(''=>'Select Product Type') + $product_type_master;
                        echo form_dropdown('product', $product_type_master, '1','class ="form-control m-b" onchange = "showProductDetails(this.value)"');
                        ?>
                    </div>
                    </div>      

                    <!-- Visa Form -->
                    <div id = "visa" class = "product" style= "border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                     <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        $country_opt = array('' => 'Select Country' ) + $country_master;
                        echo form_dropdown('visa_country', $country_opt, '','class ="form-control m-b" onchange = "countrywiseVal(this.value);"');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Visa Type</label>
                    <div class="col-sm-10" id = "visa_type_div">
                        <div id = "div1">
                        <?php 
                        $options = array('' => 'Select Visa Type');
                        echo form_dropdown('visa_type', $options, '','class ="form-control m-b" onchange = "visaVal(this.value);"');
                        ?>

                        </div>

                        <div id = "div2" style = "display:none;">

                            <input type = "hidden" name = "visa_urgent_days" id = "visa_urgent_days" value = "" />

                            <div class="col-md-5 forum-info animated-panel zoomIn" id = "visa_submitted" style="animation-delay: 1s;">
                                <small>The visa shall be submitted</small>
                            </div>

                            <div class="col-md-5 forum-info animated-panel zoomIn" id = "max_process_days" style="animation-delay: 1s;">
                                <small>Maximum Days to process</small>
                            </div>

                            <div class="col-md-5 forum-info animated-panel zoomIn" id = "validity" style="animation-delay: 1s;">
                                <small>The validity is for</small>
                            </div>
                        </div>
                    </div>
                    
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Travelling From</label>
                    <div class="col-sm-10" id = "visa_city_div">
                        <?php 
                        $travel_from_master = array(''=>'Select Travelling From') + $country_master;
                        echo form_dropdown('visa_travel_from', $travel_from_master, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Acceptance Date</label>
                        <div class="col-sm-10">
                            <input id="acceptance_date" type="text" value="" style = "width: 95%;" name = "acceptance_date" class="datepicker form-control m-b " placeholder = 'Select Acceptance Date' />
                        </div>
                    </div>
                    

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-6">
                        <input id="visa_travel_date" type="text" value="" name = "visa_travel_date" class="datepicker form-control" placeholder = 'Select Travel Date' />
                    </div>
                    <div class="col-sm-4">
                        <div class="radio radio-success radio-inline">
                            <?php $data = array('name'=> 'visa_travel_date_type','id' => 'tentative_date','value'=> 'Tentative','class' => 'form-control');
                        echo form_radio($data); ?>
                                    <label for="inlineRadio1"> Tentative </label>
                                </div>

                                <div class="radio radio-success radio-inline">
                            <?php $data = array('name'=> 'visa_travel_date_type','id' => 'confirm_date','value'=> 'Confirm','class' => 'form-control');
                        echo form_radio($data); ?>
                                    <label for="inlineRadio1"> Confirm </label>
                                </div>
                        </div>
                    </div>       

                        <div class="form-group"><label class = "col-sm-2 control-label">Adult</label>
                                            <div class = "col-sm-4">
                                            <?php 
                                            echo form_dropdown('visa_adult', $count_adult, '','class ="form-control m-b", id = "visa_adult" ');
                                         ?>
                                        </div>

                                        <label class = "col-sm-2 control-label">Child</label>
                                        <div class = "col-sm-4">
                                    <?php echo form_dropdown('visa_child', $count, '','class ="form-control m-b", id = "visa_child" '); ?>
                                        </div>
                                        </div>

                    <?php $issue_opt = array('' => 'Select PP Issue State' ) + $pp_issue_state_master; ?>
                    <div class="table-responsive">
                                <table id="zone-to-geo-zone" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <td class="text-left" style = "width:44%">PP Issue State</td>
                                        <td class="text-left">PP Expiry Date</td>
                                        <td></td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="zone-to-geo-zone-row0 col-lg-">  
                                            <td class="text-left" >
                                                <?php 
                                            echo form_dropdown('passport[0][pp_state]', $issue_opt, '','class ="form-control pp_state", id = "pp_state0" ');
                                                ?>
                                            </td>  
                                            <td class="text-left" >
                                                <input id="pp_expiry0" style = "width:38%" type="text" value="" name = "passport[0][pp_expiry]" class="datepicker form-control pp_expiry" placeholder = 'PP Expiry Date' />
                                            </td>  
                                            <td class="text-left" style = "width:10%">
                                                <button type="button" onclick="$('#zone-to-geo-zone-row0').remove();" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td colspan="2"></td>
                                        <td class="text-left"><button type="button" onclick="addPassport();" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Add Passport Info"><i class="fa fa-plus-circle"></i></button></td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                </div>
                            
                    <div class="table-responsive" >                        
                        <div class="panel-heading hbuilt">
                            Co-related Services
                        </div>
                        <div class="panel-body">
                        <table cellpadding="1" cellspacing="1" class="table table-condensed">
                            <thead>
                            <tr>
                                <th><div class="radio radio-info radio-inline">
                                    <input type="radio" value="Btw Provided" name="provided_by" >
                                    <label for="inlineRadio1"> BTW Provided </label>
                                </div></th>
                                <th><div class="radio radio-info radio-inline">
                                    <input type="radio" value="Client Provided" name="provided_by" >
                                    <label for="inlineRadio1"> Client Provided </label>
                                </div></th>
                                <th><div class="radio radio-info radio-inline">
                                    <input type="radio" value="Process Dummy" name="provided_by" >
                                    <label for="inlineRadio1"> Process Dummy </label>
                                </div></th>
                            </tr>
                            </thead>
                            <tbody id = "co_related_services">
                            
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="table-responsive" style = "margin-top:10px;">                        
                        <div class="panel-heading hbuilt">
                            Documents Required
                        </div>
                         <div class="panel-body" style = "height: 150px;overflow: scroll;">
                            <div class="form-group">
                                            <div class="col-sm-6">
                                              <?php 
                                            $design = array('' => 'Select Visa Adult Designation') + $designation_master;
                                            echo form_dropdown('adult_designation', $design, '','class ="form-control m-b" ');
                                            ?>
                                        </div>

                                        <div class="col-sm-6">
                                            <?php 
                                            $design = array('' => 'Select Invitee Designation') + $designation_master;
                                            echo form_dropdown('invitee_designation', $design, '','class ="form-control m-b" ');
                                            ?>
                                            </div>
                                        </div>
                            <div class = "col-sm-6">
                            <?php 
                        $options = array('name'=> 'visa_docs','id'=> 'visa_docs','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                        <?php 
                        $options = array('name'=> 'visa_docs','id'=> 'visa_docs','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                            </div>
                            <div class = "col-sm-6">
                            <?php 
                        $options = array('name'=> 'visa_docs','id'=> 'visa_docs','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                        <?php 
                        $options = array('name'=> 'visa_docs','id'=> 'visa_docs','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                            </div>
                        </div>
                    </div>  

                    <div class="table-responsive" id = "visa_cost_table"  style= "display:none;margin-top:10px;border:1px solid;padding:10px;border-color:#ccc;margin-bottom:10px; ">
                        <table cellpadding="1" cellspacing="1" class="table table-condensed">
                            <thead>
                            <tr>
                                <th>RATES (AS PER TYPE)</th>
                                <th>WALKIN</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>VISA CHARGES</td>
                                <td>
                        <?php $data = array('name'=> 'visa_charge','id' => 'visa_charge','value'=> '','class' => 'form-control whiteborder');
                        echo form_input($data); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>VFS/CNK CHARGES</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>SERVICE CHARGES</td>
                                <td>
                        <?php 
                        $data = array('name'=> 'visa_service','id' => 'visa_service','value'=> '','class' => 'form-control whiteborder');
                        echo form_input($data); ?></td>
                            </tr>
                            <tr>
                                <td colspan = 2><i class="pe-7s-ribbon"></i>
                                    <a href = "">View other applicable charges</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>          

                    <div class="table-responsive animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Communication</label>
                                            <?php 
                        $options = array('name'=> 'visa_communication','id'=> 'visa_communication','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                                        </div>  

                        </div>

                    <!-- Visa Form -->

                    <!-- Air Ticket Form -->
                    <div id = "air_ticket" class = "product" style= "display:none;border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                    <div class="form-group"><label class="col-sm-2 control-label">Type</label>    
                    <div class="col-sm-10">    
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" value="Domestic" name="air_ticket_type" checked="">
                                    <label for="inlineRadio1"> Domestic </label>
                                </div>
                                
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" value="International" name="air_ticket_type" checked="">
                                    <label for="inlineRadio1"> International </label>
                                </div>
                    </div>
                    </div>

                     <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        echo form_dropdown('air_country', $country_master, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Travelling From</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array(''=>'Select Travelling From');
                        echo form_dropdown('air_travel_from', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Travelling To</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Travelling To');
                        echo form_dropdown('air_travel_to', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>  

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-10">
                        <input type="text" name = "air_travel_date" value="" class="datepicker form-control" placeholder = 'Select Travel Date'>
                        <div class="radio radio-success radio-inline">
                            <?php $data = array('name'=> 'air_travel_data_type','value'=> 'Tentative','class' => 'form-control');
                        echo form_radio($data); ?>
                                    <label for="inlineRadio1"> Tentative </label>
                                </div>

                                <div class="radio radio-success radio-inline">
                            <?php $data = array('name'=> 'air_travel_data_type','value'=> 'Confirm','class' => 'form-control');
                        echo form_radio($data); ?>
                                    <label for="inlineRadio1"> Confirm </label>
                                </div>
                    </div>
                    </div> 

                    <div class="table-responsive" style= "border:1px solid;padding:10px;border-color:#ccc;margin-bottom:10px;">
                        <table cellpadding="1" cellspacing="1" class="table table-condensed">
                            <thead>
                            <tr>
                                <th>RATES (AS PER TYPE)</th>
                                <th>WALKIN</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>AIRLINE CHARGES</td>
                                <td><?php $data = array('name'=> 'airline_charge','id'=> 'airline_charge','value'=> '','class' => 'form-control whiteborder');
                        echo form_input($data); ?></td>
                            </tr>
                            <tr>
                                <td>SERVICE CHARGES</td>
                                <td><?php $data = array('name'=> 'airline_service','id'=> 'airline_service','value'=> '','class' => 'form-control whiteborder');
                        echo form_input($data); ?></td>
                            </tr>
                            <tr>
                                <td colspan = 2><i class="pe-7s-ribbon"></i>
                                    <a href = "">View other applicable charges</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Suggested Airline</label>
                    <div class="col-sm-10" id = "air_ticket_airline">
                        <?php 
                        $options = array('' => 'Select Airline');
                        echo form_dropdown('suggested_airline', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Transit Visa</label>    
                    <div class="col-sm-10">    
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" value="Yes" name="transit_visa" checked="">
                                    <label for="inlineRadio1"> Yes </label>
                                </div>
                                
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" value="No" name="transit_visa" checked="">
                                    <label for="inlineRadio1"> No </label>
                                </div>
                    </div>
                    </div>

                    <div class = "row">
                        <div class="col-lg-12 animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Communication</label>
                                            <?php 
                        $options = array('name'=> 'air_communication','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                                        </div>                                      
                    </div>
                       
                    </div>

                    <!-- Air Ticket Form -->

                    <!-- Insurance Form -->
                    <div id = "insurance" class = "product" style= "display:none;border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                     <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Country','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('country', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select City','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('city', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-10">
                        <input type="text" value="02-16-2012" name = "travel_date" class="datepicker form-control" placeholder = 'Select Travel Date' />
                    </div>
                    </div> 
                      
                    <div class="form-group"><label class="col-sm-2 control-label">Age</label>
                    <div class="col-sm-10">
                        <?php 
                        echo form_dropdown('age', $age, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Insurance Type</label>    
                    <div class="col-sm-10">    
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                    <label for="inlineRadio1"> Premium </label>
                                </div>
                                
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                    <label for="inlineRadio1"> Later </label>
                                </div>
                    </div>
                    </div>

                    </div>

                    <!-- Insurance Form -->

                     <!-- OK To Board Form -->
                    <div id = "oktb" class = "product" style= "display:none;border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                     <div class="form-group"><label class="col-sm-2 control-label">Airline</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Airline','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('airline', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">DUBAI</div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-10">
                        <input type="text" value="" name = "travel_date" class="datepicker form-control" placeholder = 'Select Travel Date' />
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Type</label>    
                    <div class="col-sm-10">    
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                    <label for="inlineRadio1"> Urgent </label>
                                </div>
                                
                    <div class="radio radio-info radio-inline">
                                    <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                    <label for="inlineRadio1"> Normal </label>
                                </div>
                    </div>
                    </div>

                    </div>

                    <!-- OK To Board Form -->

                     <!-- Packages Form -->
                    <div id = "packages" class = "product" style= "display:none;border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                     <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Country','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('country', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                    <?php 
                        $options = array('' => 'Select City','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('city', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>

                     <div class="form-group"><label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Month','1'=> 'January','2'=> 'February','3'=> 'March','4' => 'April','5'=> 'May','6'=> 'June','7'=> 'July','8' => 'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
                        echo form_dropdown('country', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-10">
                        <input type="text" value="" name = "travel_date" class="datepicker form-control" placeholder = 'Select Travel Date' />
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Budget</label>
                    <div class="col-sm-10">
                    <?php $data = array('name'=> 'budget','id' => '','value'=> '','class' => 'form-control','placeholder' => 'Enter Budget');
                        echo form_input($data); ?>
                    </div>
                    </div>

                    </div>

                    <!-- Packages Form -->

                     <!-- Hotel Booking Form -->
                    <div id = "hotel" class = "product" style= "display:none;border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                     <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Country','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('country', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10">
                    <?php 
                        $options = array('' => 'Select City','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('city', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-10">
                        <input type="text" value="02-16-2012" name = "travel_date" class="datepicker form-control" placeholder = 'Select Travel Date' />
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Budget</label>
                    <div class="col-sm-10">
                    <?php $data = array('name'=> 'budget','id' => '','value'=> '','class' => 'form-control','placeholder' => 'Enter Budget');
                        echo form_input($data); ?>
                    </div>
                    </div>

                    </div>

                    <!-- Hotel Booking Form -->

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-default" type="submit">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>      
                </form>
            </div>
        </div>
        
        
    </div>
    
    
    <div class="col-lg-4 animated-panel zoomIn" style="animation-delay: 0.4s;">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    <a class="closebox"><i class="fa fa-times"></i></a>
                </div>
                CUSTOMER HISTORY
            </div>
            <div class="panel-body">
                <div class="table-responsive" >
                        <table cellpadding="1" cellspacing="1" class="table table-condensed">
                            <thead>
                            <tr>
                                <th class ="text-info font-bold">Last Login</th>
                                <td><?php echo date('d-m-Y H:i:s', $this->session->data['last_login']);?></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class = "text-info font-bold">A/c Balance</th>
                                <td>3000</td>
                            </tr>
                            <tr>
                                <th class = "text-info font-bold">Earnings</th>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <th class = "text-info font-bold">Date of Birth</th>
                                <td>25/07/1988</td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>

                    
            </div>
            
        </div>
    </div>
    
    <div class="col-lg-4 animated-panel zoomIn" style="animation-delay: 0.4s;">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    <a class="closebox"><i class="fa fa-times"></i></a>
                </div>
                TRAVEL HISTORY
            </div>
            <div class="panel-body">
                <div class="table-responsive" >
                        <table cellpadding="1" cellspacing="1" class="table table-condensed">
                            <thead>
                            <tr>
                                <th>INQUIRY</th>
                                <th>RATES</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>DUBAI</td>
                                <td>3000</td>
                            </tr>
                            <tr>
                                <td>HONG KONG</td>
                                <td>1500</td>
                            </tr>
                            <tr>
                                <td>SINGAPORE</td>
                                <td>2500</td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>        
            </div>
        </div>
    </div>
    
    <div class="hr-line-dashed"></div>  

    <div class="col-lg-4 animated-panel zoomIn" style="animation-delay: 0.4s;">
        <div class="hpanel hblue">
            <div class="panel-heading hbuilt">
                <div class="panel-tools">
                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    <a class="closebox"><i class="fa fa-times"></i></a>
                </div>
                FOR FRONT DESK OFFICER ONLY
            </div>
            <div class="panel-body">
               
                    <div class="animated-panel zoomIn"><label>Department</label>
                        <?php 
                        $options = array(''=>'Select Department','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('dept', $options, '','class ="form-control m-b" ');
                        ?>
                    </div> 

                    <div class="animated-panel zoomIn"><label>Status</label>
                        <?php 
                        $options = array(''=>'Select Status','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        echo form_dropdown('status', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>  
                    
                    <div class="hr-line-dashed"></div>

                    <div class="animated-panel zoomIn"><label>Invoice Details</label>
                        <span class = "pull-right"><strong>8000</strong></span>
                        <?php 
                        //$options = array(''=>'Select Department','small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
                        //echo form_dropdown('dept', $options, '','class ="form-control m-b" ');
                        ?>
                    </div> 

                    <div class="animated-panel zoomIn"><label>Insert Discount</label>
                        <input id="discount" type="text" value="" class="form-control" placeholder = "Insert Discount">
                    </div> 

                    <div class="animated-panel zoomIn"><label>Discount Reason</label>
                        <?php 
                        $options = array('name'=> 'disc_reason','id'=> 'disc_reason','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?>
                    </div> 
                      
                    
                                <button type="button" class="btn btn-block btn-outline btn-primary">GENERATE PROFORMA INVOICE</button>
                                <button type="button" class="btn btn-block btn-outline btn-primary2">ADD CHARGES</button>
                                <button type="button" class="btn btn-block btn-outline btn-warning">WALLET ADJUSTMENT</button>
                                <button type="button" class="btn btn-block btn-outline btn-info">DOWNLOAD FINAL INVOICE</button>

            </div>
        </div>
    </div>                  
</div>



<!-- Add User Pop-up -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="color-line"></div>
                            <div class="modal-header">
                                <h4 class="modal-title">Add User</h4>
                            </div>
                            <div class="modal-body">
                            <?php $this->load->view('add_user'); ?>
                            </div>
                        </div>
                    </div>
                </div>

<script>
/* To add Passport Row  */
function addPassport() {
    passport_row++;

    html  = '<tr id="zone-to-geo-zone-row' + passport_row + '">';
    html += '  <td class="text-left"><select name="passport[' + passport_row + '][pp_state]" id="pp_state' + passport_row + '" class="form-control pp_state">';
    <?php foreach($issue_opt as $k => $v){ ?>
      html += '<option value = "<?php echo $k; ?>"><?php echo $v; ?></option>';
      <?php }?>
    html += '</select></td>';
    html += '  <td class="text-left" ><input id="pp_expiry' + passport_row + '" style = "width:38%" type="text" value="" name="passport['+ passport_row +'][pp_expiry]" class="datepicker form-control pp_expiry" placeholder="PP Expiry Date"></td>';
    html += '  <td class="text-left" style = "width:10%"><button type="button" onclick="$(\'#zone-to-geo-zone-row' + passport_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';
    
    $('#zone-to-geo-zone tbody').append(html);

    $('.datepicker').datepicker({ format: 'dd-mm-yyyy' });
    $('.datepicker2').datepicker({ format: 'dd-mm-yyyy' });

}
</script>