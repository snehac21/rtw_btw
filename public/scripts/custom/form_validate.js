$(document).ready(function() {
	$("#loginfrm").validate({
		errorPlacement: function(error, element) {},
		rules: {
					username: "required",
					password: "required",
				}
	});
	
	$("#changepwdfrm").validate({
		errorPlacement: function(error, element) {},
		rules: {
				current_pass: {
					required: true,
				},
				pass: {
					required: true,
					minlength: 5
				},
				cpass: {
					required: true,
					minlength: 5,
					equalTo: "#pass"
				},
				}
	});
	
	$("#edituserfrm").validate({
		errorPlacement: function(error, element) {},
		rules: {
				username: {
					required: true,
					email:true,
					minlength: 2
				},
				pass: {
					minlength: 5
				},
				cpass: {
					minlength: 5,
					equalTo: "#pass"
				},
				}
	});
	
	$("#addcatfrm").validate({
		errorPlacement: function(error, element) {},
		rules: {
					product: "required",
					desc: "required",
				}
	});

	$("#addwebfrm").validate({
		errorPlacement: function(error, element) {},
		rules: {
					website: "required",
					website_url: "required",
					desc: "required",
				}
	});
	
	
	$("#newuploadfrm").validate({
		errorPlacement: function(error, element) {},
		rules: {
				uimg: {
					required: true,
				},
				size_pixel: {
					required:true,
				},
				size_inch: {
					required:true,
				},
				vector: {
					required:true,
				},
				product: {
					required:true,
				},
				website: {
					required:true,
				},
				validity_number: {
					required:true,
					number:true
				},
				validity_type: {
					required:true,
				},
				keywords: {
					required:true,
					minlength:3
				},
				
				
				}
	});


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
                acceptance_date: {
                    required:true,
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
                provided_by:{
                    required:true,
                }
            },
            submitHandler: function() {
               // alert("submitted!");
               var frmdata = $('#inquiryForm').serialize();
                $.ajax({
                  url:base_url + "index.php/cases/saveCases",
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

$.validator.addClassRules("pp_state", {
     required: true,
});

$.validator.addClassRules("pp_expiry", {
     required: true,
});


/*$("#addUserForm").validate({
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
        });*/


});

