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
	/*$('#categorytbl,#usertbl,#uploadtbl,#searchtbl,#mistbl,#websitetbl').dataTable( {
				"dom": 'T<"clear">lfrtip'} );
				
	$(".chzn-select").chosen();

$('.date-range-picker').daterangepicker({
	format: 'YYYY/MM/DD',
});

//we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
var tag_input = $('#keywords');
if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) 
	tag_input.tag({placeholder:tag_input.attr('placeholder')});
else {
	//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
	tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
	//$('#form-field-tags').autosize({append: "\n"});
}

/***** colorbox setting ***/

/*(var colorbox_params = {
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="icon-arrow-left"></i>',
		next:'<i class="icon-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = 'auto';
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('a[data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");
	*/

});

