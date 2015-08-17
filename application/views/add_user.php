<!--
    Created on - 2015-08-02
    Purpose - HTML Form to add Agent/Corporate/Walkin
    Author :- Sunita Mistry
    Filename : add_user.php
 -->   


<style>
.modal-header{
    padding:10px!important;
}

</style>
            
            <div class="panel-body">
                <form action = "" id = "addUserForm" name = "addUserForm" method="post" class="form-horizontal">

                <div class = "row" style = "margin-bottom:10px">
                
                <div class="form-group"><label class="col-sm-2 control-label">Select User Type</label>
                    <div class="col-sm-10">
                        <?php 
                        $options = array('' => 'Select User Type','4'=> 'Agent','5'=> 'Corporate','6'=> 'Walkin');
                        echo form_dropdown('user_type', $options, '','class ="form-control m-b" ');
                        ?>
                    </div>
                </div> 

                <div class="col-lg-6">
                    <label class="col-sm-4 control-label">Username</label>
                                    <div class="col-sm-8">
                                             <?php $data = array('name'=> 'user_name','id' => 'user_name','value'=> '','class' => 'form-control','placeholder' => 'Name');
                        echo form_input($data); ?>
                        <span class="help-block m-b-none" id = "err_uname" style = "color:red;"></span>
                                        </div>
                                    </div>

                <div class="col-lg-6">
                                            <label class="col-sm-4 control-label">Contact no.</label>
                                            <div class="col-sm-8">
                                            <?php $data = array('name'=> 'user_contact','id' => 'user_contact','value'=> '','class' => 'form-control','placeholder' => 'Contact No.');
                        echo form_input($data); ?>
                                        </div>
                                    </div>
                                </div>

                <div class = "row" style = "margin-bottom:10px">
                
                <div class="col-lg-6">
                    <label class="col-sm-4 control-label">New Password</label>
                                    <div class="col-sm-8">
                                             <?php $data = array('name'=> 'new_password','id' => 'new_password','value'=> '','class' => 'form-control','placeholder' => 'New Password');
                        echo form_input($data); ?>
                                        </div>
                                    </div>

                <div class="col-lg-6">
                                            <label class="col-sm-4 control-label">Confirm Password</label>
                                            <div class="col-sm-8">
                                            <?php $data = array('name'=> 'confirm_password','id' => 'confirm_password','value'=> '','class' => 'form-control','placeholder' => 'Confirm Password');
                        echo form_input($data); ?>
                                        </div>
                                    </div>
                                </div>                    

                <div class = "row" style = "margin-bottom:10px">                                    
                <div class="col-lg-6">
                                            <label class="col-sm-4 control-label">Email</label>
                                            <div class="col-sm-8">
                                            <?php $data = array('name'=> 'user_email','id' => 'user_email','value'=> '','class' => 'form-control','placeholder' => 'Email');
                        echo form_input($data); ?>
                        <span class="help-block m-b-none" id = "err_email" style = "color:red;"></span>
                                        </div>
                                    </div>

                <div class="col-lg-6">
                                            <label class="col-sm-4 control-label">Business Name</label>
                                            <div class="col-sm-8">
                                            <?php $data = array('name'=> 'bus_name','id' => 'bus_name','value'=> '','class' => 'form-control','placeholder' => 'Business Name');
                        echo form_input($data); ?>
                                        </div>
                                    </div>
                                    </div>



                 <!-- Optional Fields -->

                 <div class="collapse out" id="collapseExample" aria-expanded="true">
                    <div id = "optional" class = "" >

                    <div class = "row">
                    <div class="col-lg-6">
                                            <label class="col-sm-4 control-label">Date of Birth</label>
                                            <div class="col-sm-8">
                                            <?php $data = array('name'=> 'user_dob','id' => 'user_dob','value'=> '','class' => 'form-control datepicker','placeholder' => 'Date of Birth');
                                             echo form_input($data); ?>
                                         </div>
                                        </div>

                    <div class="col-lg-6">
                                            <label class="col-sm-4 control-label">Alt. Contact no.</label>
                                            <div class="col-sm-8">
                                            <?php $data = array('name'=> 'alt_contact','id' => '','value'=> '','class' => 'form-control','placeholder' => 'Alt. Contact no.');
                        echo form_input($data); ?>
                                        </div>
                                    </div>

                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">Area</label>
                    <div class="col-sm-10">
                        <?php $data = array('name'=> 'user_area','id' => 'user_area','value'=> '','class' => 'form-control','placeholder' => 'Enter Area');
                        echo form_input($data); ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                        <?php 
                        echo form_dropdown('user_country', $country_master, '','class ="form-control m-b" onchange = "countrywiseState(this.value)"');
                        ?>
                    </div>
                    </div> 

                    <div class="form-group"><label class="col-sm-2 control-label">State</label>
                    <div class="col-sm-10" id = "stateDropdown">
                        <?php 
                        $state = array('' => 'Select State');
                        echo form_dropdown('user_state', $state, '','class ="form-control m-b" onchange = "statewiseCity(this.value)"');
                        ?>
                    </div>
                    </div>

                    <div class="form-group"><label class="col-sm-2 control-label">City</label>
                    <div class="col-sm-10" id = "cityDropdown">
                        <?php 
                        $city = array('' => 'Select City');
                        echo form_dropdown('user_city', $city, '','class ="form-control m-b" ');
                        ?>
                    </div>
                    </div>
                       
                    </div>
                </div>

                    <div class="text-center m-b-md">
                        <button class="btn btn-default btn-sm btn-circle" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample" onclick = "expandOptFields()">
                            <input type = "hidden" name = "btnVal" id = "btnVal" value = "up" />
                            <i class="fa fa-chevron-down"></i>
                        </button>
                    </div>  
                    <!-- Optional Fields -->

					<div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>	
                </form>
            </div>

<script>
$().ready(function() {
$("#addUserForm").validate({
    errorPlacement: function(error, element) {},
            rules: {
                user_name: {
                    required: true,
                    minlength: 2
                },
                new_password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#new_password"
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_contact: {
                    required: true,
                    digits:true
                },
                bus_name:{
                    required:true
                }
            },
            submitHandler: function() {
               // alert("submitted!");
               var frmdata = $('#addUserForm').serialize();

               $("span#err_uname").html("");
               $("span#err_email").html("");

                $.ajax({
                  url:"<?php echo base_url(); ?>index.php/cases/saveUser",
                  data : frmdata,
                  dataType :'json',
                  type: 'POST',
                  async: false,
                  success:function(data) {
                    //var json_x =JSON.parse(data)
                    if(data == 1){
                        $('#myModal').modal('hide');
                    }else{
                        if(typeof data.err_email != 'undefined')
                        {
                            $("span#err_email").html("<strong>"+data.err_email+"</strong>");
                        }
                        if(typeof data.err_uname != 'undefined')
                        {
                            $("span#err_uname").html("<strong>"+data.err_uname+"</strong>");
                        }
                    }
                  }
               });
            }
        });
})

function expandOptFields(){
    var btnVal = $('#btnVal').val();
    if(btnVal == "up"){
        $("i").removeClass("fa-chevron-down"); 
        $("i").addClass("fa-chevron-"+btnVal);
        $("#btnVal").val("down");
    }else{
        $("i").removeClass("fa-chevron-up"); 
        $("i").addClass("fa-chevron-"+btnVal);
        $("#btnVal").val("up");
    }
}

function countrywiseState(country_id){
    $.ajax({
                  url:"<?php echo base_url(); ?>index.php/cases/countrywiseState",
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


</script>