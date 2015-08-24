$().ready(function() {
$("#addUserForm").validate({
    //errorPlacement: function(error, element) {},
            rules: {
                user_name: {
                    required: true,
                    minlength: 2
                },
                new_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#confirm_password"
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                   
                },
                user_email: {
                    required: true,
                    email: true
                },
                user_contact: {
                    required: true,
                    digits:true,
                    maxlength:12
                },
                bus_name:{
                    required:true
                },
                user_country:{
                  required:true
                },
                 user_state:{
                  required:true
                },
                user_city:{
                  required:true
                },
                user_type:{
                  required:true
                }

            },
            messages:{
              user_name: {
                    required: 'Please enter username',
                    minlength: 'Username should have minimum two characters'
                },
                new_password: {
                    required: 'Please enter password',
                    minlength: 'Password should have minimum five characters',
                    equalTo: 'Password not same as confirm password'
                },
                confirm_password: {
                    required: 'Please enter confirm password',
                },
                user_email: {
                    required: 'Please enter email',
                    email: 'Please enter valid email'
                },
                user_contact: {
                    required: 'Please enter contact number',
                    digits:'Please enter valid contact number',
                    maxlength: 'Please enter valid contact number'
                },
                bus_name:{
                    required:'Please enter business name'
                },
                user_country:{
                  required:'Please select country'
                },
                 user_state:{
                  required:'Please select state'
                },
                user_city:{
                  required:'Please select city'
                },
                user_type:{
                  required:'Please select user type'
                }
            }
        });

$("#addUserForm1").validate({
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
               var frmdata = $('#addUserForm1').serialize();

               $("span#err_uname").html("");
               $("span#err_email").html("");

                $.ajax({
                  url:base_url + "index.php/cases/saveUser",
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

function statewiseCity(state_id){
    $.ajax({
                  url: base_url + "index.php/cases/statewiseCity",
                  dataType :'json',
                  data : 'state_id='+state_id,
                  type: 'POST',
                  async: false,
                  success:function(data) {
                     if(data == 0){
                        alert("Details not found!!");
                        }else{
                                if(data.city != 'undefined')
                                {
                                    $("#cityDropdown").html(data.city);
                                }
                            }          
                  }
              });
}

function countrywiseState(country_id){
    $.ajax({
                  url: base_url + "index.php/cases/countrywiseState",
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
                                    $("#stateDropdown").html(data.state);
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