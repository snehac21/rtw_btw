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

$age = array(''=>'Select Age');
for($i = 0; $i <= 100 ; $i++){
    $age[$i] = $i;
}
?>

<style>
input.error, select.error{
    border: 1px solid red!important;
}

.dropdown-menu{
    position: initial;
}
.datepicker{
    position: absolute;
}

.whiteborder{
    border-color: #fff !important;
}
</style>

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
                                                <label id = "cust_type"></label>
                                            <?php 
                        //$options = array('' => 'Select User Type','4'=> 'Agent','5'=> 'Corporate','6'=> 'Walkin');
                        //echo form_dropdown('cust_type', $options, '','class ="form-control m-b whiteborder " id ="cust_type"');
                        ?>
                                         </div>  
                                        </div>
                                    </div>

                 <div class="hr-line-dashed"></div>

                 <h4>WHAT IS YOUR INQUIRY FOR ? </h4>
                    <div class="form-group"><label class="col-sm-2 control-label">Product</label>
                    <div class="col-sm-10">

                        <?php 
                       //$options = array(''=>'Select Product','1'=> 'Visa','2'=> 'Air Ticket','3'=> 'Insurance','4' => 'OK To Board','5'=>'Packages','6'=>'Hotel Bookings');
                        echo form_dropdown('product', $product_type_master, '','class ="form-control m-b" onchange = "showProductDetails(this.value)"');
                        ?>
                    </div>
                    </div>      

                    <!-- Visa Form -->
                    <div id = "visa" class = "product" style= "display:none;border:1px solid;padding:20px;border-color:#ccc;margin-bottom:10px;">

                     <div class="form-group"><label class="col-sm-2 control-label">Product Type</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select Product Type','Tourist'=> 'Tourist','Business'=> 'Business','Work'=> 'Work','StudentBusiness' => 'StudentBusiness',);
                        echo form_dropdown('visa_product_type', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div> 

                     <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        echo form_dropdown('visa_country', $country_master, '','class ="form-control m-b" onchange = "countrywiseVal(this.value);"');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Visa Type</label>
                    <div class="col-sm-10" id = "visa_type_div">
                        <?php 
                        $options = array('' => 'Select Visa Type');
                        echo form_dropdown('visa_type', $options, '','class ="form-control m-b" onchange = "visaVal(this.value);"');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Travelling From</label>
                    <div class="col-sm-10" id = "visa_city_div">
                        <?php 
                        $options = array(''=>'Travelling From');
                        echo form_dropdown('visa_travel_from', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>  

                    <div class="form-group"><label class="col-sm-2 control-label">Travel Date</label>
                    <div class="col-sm-10">
                        <input id="datapicker2" type="text" value="" name = "visa_travel_date" class="form-control" placeholder = 'Select Travel Date' />

                        <div class="radio radio-success radio-inline">
                            <?php $data = array('name'=> 'visa_travel_data_type','id' => 'travel_data_type','value'=> 'Tentative','class' => 'form-control');
                        echo form_radio($data); ?>
                                    <label for="inlineRadio1"> Tentative </label>
                                </div>

                                <div class="radio radio-success radio-inline">
                            <?php $data = array('name'=> 'visa_travel_data_type','id' => 'travel_data_type','value'=> 'Confirm','class' => 'form-control');
                        echo form_radio($data); ?>
                                    <label for="inlineRadio1"> Confirm </label>
                                </div>

                        <div class="checkbox checkbox-success checkbox-inline">
                            <?php $data = array('name'=> 'visa_urgent','id' => 'visa_urgent','value'=> 'Yes','class' => 'form-control','placeholder' => 'Type','checked' => true);
                        echo form_checkbox($data); ?>
                                    <!--<input type="checkbox" id="inlineRadio1" value="option1" name="radioInline" checked="">-->
                                    <label for="inlineRadio1"> URGENT </label>
                                </div>

                        <div class="checkbox checkbox-success checkbox-inline">
                            <?php $data = array('name'=> 'visa_oktb','id' => 'visa_oktb','value'=> 'Yes','class' => 'form-control','placeholder' => 'Type','checked' => true);
                        echo form_checkbox($data); ?>                                    
                        <label for="inlineRadio1"> OKTB </label>
                                </div>
                        
                    </div>
                    </div> 


                    <div class="table-responsive" id = "visa_cost_table" style= "display:none;border:1px solid;padding:10px;border-color:#ccc;margin-bottom:10px;">
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
                        <?php $data = array('name'=> 'visa_service','id' => 'visa_service','value'=> '','class' => 'form-control whiteborder');
                        echo form_input($data); ?></td>
                            </tr>
                            <tr>
                                <td colspan = 2><i class="pe-7s-ribbon"></i>
                                    <a href = "">View other applicable charges</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class = "row">
                        <div class="col-lg-6 animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Adult(s)</label>
                                            <?php  
                        echo form_dropdown('visa_adult', $count, '','class ="form-control m-b", id = "visa_adult" ');
                        ?>      
                                    </div>
                        <div class="col-lg-6 animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Child</label>
                                            <?php 
                        echo form_dropdown('visa_child', $count, '','class ="form-control m-b", id = "visa_child" ');
                        ?> 
                                        </div>

                        <div class="col-lg-12 animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Discount</label>
                                            <?php 
                        $options = array('name'=> 'visa_disc','id'=> 'visa_disc','class'=> 'form-control m-b');
                        echo form_input($options);
                        ?> 
                                        </div>

                                    <div class="col-lg-12 animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Documents Required</label>
                                            <?php 
                        $options = array('name'=> 'visa_docs','id'=> 'visa_docs','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                                        </div>

                        <div class="col-lg-12 animated-panel zoomIn" style="animation-delay: 0.3s; -webkit-animation-delay: 0.3s;">
                                            <label>Communication</label>
                                            <?php 
                        $options = array('name'=> 'visa_communication','id'=> 'visa_communication','class'=> 'form-control m-b','rows' => 3,'cols' => 3);
                        echo form_textarea($options);
                        ?> 
                                        </div>                                      
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
                        //$options = array('' => 'Select Country', 'small'=> 'Small Shirt','med'=> 'Medium Shirt','large'=> 'Large Shirt','xlarge' => 'Extra Large Shirt',);
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
                        <input id="datapicker2" type="text" name = "air_travel_date" value="" class="form-control" placeholder = 'Select Travel Date'>
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
                        <input id="datapicker2" type="text" value="02-16-2012" name = "travel_date" class="form-control" placeholder = 'Select Travel Date' />
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
                        <input id="datapicker2" type="text" value="02-16-2012" name = "travel_date" class="form-control" placeholder = 'Select Travel Date' />
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
                        <input id="datapicker2" type="text" value="02-16-2012" name = "travel_date" class="form-control" placeholder = 'Select Travel Date' />
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
                        <input id="datapicker2" type="text" value="02-16-2012" name = "travel_date" class="form-control" placeholder = 'Select Travel Date' />
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
                                <td>25/07/2015</td>
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
                <div class="animated-panel zoomIn"><label>Tentative Document Pick up Date</label>
                        <input id="tentative" type="text" value="02-16-2012" class="form-control">
                    </div>  
                    
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

$(document).ready(function(){
    $("#inquiryForm").validate({
    errorPlacement: function(error, element) {},
            rules: {
                customer: {
                    required: true,
                    minlength: 2
                },
                product: {
                    required: true,
                },
                visa_product_type: {
                    required: true,
                },
                visa_country: {
                    required: true,
                },
                visa_type: {
                    required: true,
                },
                visa_travel_from:{
                    required:true
                },
                visa_travel_date: {
                    required: true,
                },
                visa_travel_data_type: {
                    required: true,
                },
                visa_adult:{
                    required:true
                },


                air_ticket_type: {
                    required: true,
                },
                air_country: {
                    required: true,
                },
                air_travel_from: {
                    required: true,
                },
                air_travel_to: {
                    required: true,
                },
                air_travel_date:{
                    required:true
                },
                air_travel_data_type: {
                    required: true,
                },
                suggested_airline: {
                    required: true,
                },
                transit_visa:{
                    required:true
                },
            },
            submitHandler: function() {
               // alert("submitted!");
               var frmdata = $('#inquiryForm').serialize();
                $.ajax({
                  url:"<?php echo base_url(); ?>index.php/cases/saveCases",
                  data : frmdata,
                  dataType :'json',
                  type: 'POST',
                  async: false,
                  success:function(data) {
                    location.reload();
                  }
               });
            }
        });

});

function setType(type_val){
    $('select option[value="'+ type_val +'"]').attr("selected",true);
}

function showProductDetails(val){
    $('.product').css('display','none');
    if(val == 1){
    $('#visa').css('display','block'); 
    }else if(val == 2)
    $('#air_ticket').css('display','block');
    else if(val == 3)
    $('#insurance').css('display','block'); 
    else if(val == 4)
    $('#oktb').css('display','block');
    else if(val == 5)
    $('#packages').css('display','block'); 
    else if(val == 6)
    $('#hotel').css('display','block');
}


$(function() {
  
    $('input[name=\'customer\']').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/cases/getCustomer?value="+$("#customer").val(),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            
                            value: item['user_id'],
                            label: item['name'],
                        }
                    }));
                }
            });
        },
        'select': function(item) {
        $('input[name=\'customer\']').val(item['label']);
        $('input[name=\'customer_id\']').val(item['value']);
        getCustomerVal(item['value']);
        }
    });

  });

function getCustomerVal(cust_id){
     $.ajax({
                  url:"<?php echo base_url(); ?>index.php/cases/getCustomerVal",
                  dataType :'json',
                  data : 'cust_id='+cust_id,
                  type: 'POST',
                  async: false,
                  success:function(data) {
                     if(data == 0){
                        alert("Customer details not found!!");
                        }else{

                            $.map(data, function(item) {
                        
                            if(item['uname'] != 'undefined')
                            {
                                $("#cust_name").val(item['uname']);
                            }
                            if(item['code'] != 'undefined')
                            {
                                $("#cust_code").val(item['code']);
                            }
                            if(item['email'] != 'undefined')
                            {
                                $("#cust_email").val(item['email']);
                            }
                            if(item['contact'] != 'undefined')
                            {
                                $("#cust_mobile").val(item['contact']);
                            }
                            if(item['utype'] != 'undefined')
                            {
                               // $('select#cust_type option[value="'+ item['utype'] +'"]').attr("selected",true);
                               $('#cust_type').html(item['utype']);
                            }
                            });
                        }          
                  }
              });
}

function countrywiseVal(country_id){
    $.ajax({
                  url:"<?php echo base_url(); ?>index.php/cases/countrywiseVal",
                  dataType :'json',
                  data : 'country_id='+country_id,
                  type: 'POST',
                  async: false,
                  success:function(data) {
                     if(data == 0){
                        alert("Details not found!!");
                        }else{
                                if(data.visa != 'undefined')
                                {
                                    $("#visa_type_div").html(data.visa);
                                }
                                if(data.city != 'undefined')
                                {
                                    $("#visa_city_div").html(data.city);
                                }
                                if(data.oktb_required != 'undefined')
                                {
                                    if(data.oktb_required == 'Yes') 
                                        $("#visa_oktb").prop('checked',true);
                                    else
                                        $("#visa_oktb").prop('checked',false);
                                }
                            }          
                  }
              });
}

function visaVal(visa_id){
    $.ajax({
                  url:"<?php echo base_url(); ?>index.php/cases/visaInfoByVisaId",
                  dataType :'json',
                  data : 'visa_id='+visa_id,
                  type: 'POST',
                  async: false,
                  success:function(data) {
                     if(data == 0){
                        alert("Details not found!!");
                        }else{
                            $("#visa_cost_table").css("display","block");
                                if(data.visa_cost != 'undefined')
                                {
                                    $("#visa_charge").val(data.visa_cost);
                                }
                                if(data.service_charge != 'undefined')
                                {
                                    $("#visa_service").val(data.service_charge);
                                }
                                if(data.document_required != 'undefined')
                                {
                                    $("#visa_docs").html(data.document_required);
                                }else $("#visa_docs").html('');
                                
                            }          
                  }
              });
}
</script>