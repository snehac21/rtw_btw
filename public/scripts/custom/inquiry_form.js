
var passport_row = 0;

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
                url: base_url + "index.php/cases/getCustomer?value="+$("#customer").val(),
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
                  url:base_url + "index.php/cases/getCustomerVal",
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
                  url:base_url + "index.php/cases/countrywiseVal",
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
                                    $("#div1").html(data.visa);
                                }
                                if(data.city != 'undefined')
                                {
                                    $("#visa_city_div").html(data.city);
                                }
                                if(data.oktb_required != 'undefined')
                                {
                                    if(data.oktb_required == 'Yes') 
                                        $("#co_related_services_oktb").prop('checked',true);
                                    else
                                        $("#co_related_services_oktb").prop('checked',false);
                                }
                            }          
                  }
              });
}

function visaVal(visa_id){
    $.ajax({
                  url:base_url + "index.php/cases/visaInfoByVisaId",
                  dataType :'json',
                  data : 'visa_id='+visa_id,
                  type: 'POST',
                  async: false,
                  success:function(data) {
                     if(data == 0){
                        alert("Details not found!!");
                        }else{

                            visaCoRelatedServices(visa_id);

                            $("#visa_cost_table").css("display","block");
                            $("#div2").css("display","block");

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

                                if(data.urgent_days != 'undefined')
                                {
                                    $("#visa_urgent_days").val(data.urgent_days);
                                }else $("#visa_urgent_days").val('');

                                if(data.processing_type != 'undefined')
                                {
                                    $("#visa_submitted").css('display','block');
                                    $("#visa_submitted").html('<small>The visa shall be submitted <strong>'+ data.processing_type +'</strong></small>');
                                }else{
                                    $("#visa_submitted").css('display','none');
                                }

                                if(data.processing_days != 'undefined')
                                {
                                    $("#max_process_days").css('display','block');
                                    $("#max_process_days").html('<small>Maximum Days to process <strong>' + data.processing_days + '</strong> days</small>');
                                }else{
                                    $("#max_process_days").css('display','none');
                                }

                                if(data.visa_validity_days != 'undefined')
                                {
                                    $("#validity").css('display','block');
                                    $("#validity").html('<small>The validity is for <strong>'+ data.visa_validity_days +'</strong> days</small>');
                                }else{
                                    $("#validity").css('display','none');
                                }

                            }          
                  }
              });
}

function visaCoRelatedServices(visa_id){
    
     $.ajax({
                  url:base_url + "index.php/cases/visaCoRelatedServices",
                  dataType :'html',
                  data : 'visa_id='+visa_id,
                  type: 'POST',
                  async: false,
                  success:function(data) {
                     $("#co_related_services").html(data);
                     }
              });
}

