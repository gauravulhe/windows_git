// Click on radio show input hidden section.
$(document).on('click', '.radio label', function(event){
	var $this = $(this);
	$this.parents(".site-wrapper").find(".radio").removeClass("checked");
	$this.parent(".radio").addClass("checked");
	if ( $( ".association" ).is( ".checked" ) ) {
		$( "#associationinputsection" ).show();
	}
	else{
		$( "#associationinputsection" ).hide();
	}
	if ( $( ".owner" ).is( ".checked" ) ) {
		$( "#ownerinputsection" ).show();
	}
	else{
		$( "#ownerinputsection" ).hide();
	}
	if ( $( ".other" ).is( ".checked" ) ) {
		$( "#otherinputsection" ).show();
	}
	else{
		$( "#otherinputsection" ).hide();
	}
	if ( $( ".hourly" ).is( ".checked" ) ) {
		$( "#hourlysectionhide" ).show();
	}
	else{
		$( "#hourlysectionhide" ).hide();
	}	
	if ( $( ".hourlymaterial" ).is( ".checked" ) ) {
		$( "#hourlymaterialsectionhide" ).show();
	}
	else{
		$( "#hourlymaterialsectionhide" ).hide();
	}	
	if ( $( ".bigmaterialchannel" ).is( ".checked" ) ) {
		$( "#bigmaterialchannelsectionhide" ).show();
	}
	else{
		$( "#bigmaterialchannelsectionhide" ).hide();
	}
	if ( $( ".other" ).is( ".checked" ) ) {
		$( "#other" ).show();
	}
	else{
		$( "#other" ).hide();
	}	
	if ( $( ".plans-submitted" ).is( ".checked" ) ) {
		$( "#plans-submitted" ).show();
	}
	else{
		$( "#plans-submitted" ).hide();
	}
	if ( $( ".noticecompleted" ).is( ".checked" ) ) {
		$( "#noticecompleted" ).show();
	}
	else{
		$( "#noticecompleted" ).hide();
	}
	if ( $( ".cdr" ).is( ".checked" ) ) {
		$( "#cdr" ).show();
	}
	else{
		$( "#cdr" ).hide();
	}
	if ( $( ".comp-dep-retrn" ).is( ".checked" ) ) {
		$( "#comp-dep-retrn" ).show();
	}
	else{
		$( "#comp-dep-retrn" ).hide();
	}	
	if ( $( ".cdnr" ).is( ".checked" ) ) {
		$( "#completion-section" ).show();
	}	
	if ( $( ".comp-depnot-retrn" ).is( ".checked" ) ) {
		$( "#comp-depnot-retrn" ).show();
	}
	else{
		$( "#comp-depnot-retrn" ).hide();
	}
});

$(document).ready(function(){
	$('.event').on("dragstart", function (event) {
		var dt = event.originalEvent.dataTransfer;
		dt.setData('Text', $(this).attr('id'));
	});
    $('table td .main-event').on("dragenter dragover drop", function (event) {	
		event.preventDefault();

	   	if (event.type === 'drop') {
			var data = event.originalEvent.dataTransfer.getData('Text',$(this).attr('id'));
		  	de=$('#'+data).detach();
		  // 	var status = confirm("Do you want to change status");	
		  // 	if (status == true) {
		  // 		var project_id = $('#project_id').val();
				// var project_status = $('#project_status').val();
				// var string ="project_status=" + project_status + "&project_id=" + project_id;
				// $.ajax({  
				// 	type: "POST",  
				// 	url: "./change_status.php",
				// 	data: string,  
				// }); 
		  // 		de.appendTo($(this));
		  // 	}else{
		  // 		window.location.reload();
		  // 	}
	   	};
   	});

	
	$( function() {
	    $( "#approvaldate" ).datepicker({ minDate: 0});
	} );

    $( function() {
    	$( "#approvalexpiredate" ).datepicker({ minDate: 0});
    } );

    $( function() {
    	$( "#orderdate" ).datepicker({ minDate: 0});
    } );

    $( function() {
    	$( "#completiondatepicker" ).datepicker({ minDate: 0});
    } );

    $( function() {
    	$( "#startdatepicker" ).datepicker({ minDate: 0});
    } );

    $( function() {
    	$( "#billingdatepicker" ).datepicker({ minDate: 0});
    } );

	$(function() {
		$( ".datepicker" ).datepicker();
		$('.datepicker').click(function(){
		    $(this).focus();
		});
	});

	$('#startdatepicker').click(function(){
		//alert("abc");
		$('#assignsectionhide').show();
	});

	$('.glyphicon-remove').click(function(){
		$(this).parents('.empNameHide').hide();
	});
})

$(document).on('click', '#submit_employee', function(event){
	var emp_name = $('#emp_name1').val();
	var emp_rate = $('#emp_rate').val();
	var emp_email = $('#emp_email1').val();
	var rate_total = $('#rate_total').val();
	rate_total = parseInt(rate_total) + parseInt(emp_rate);
	var string ="emp_name=" + emp_name + "&emp_rate=" + emp_rate + "&emp_email=" + emp_email;

	$.ajax({  
		type: "GET",  
		url: "./employee_save.php",
		data: string,
		success: function(data){
			$('.emp_data').append(data);
			console.log(data);
        }  
	});

	$.ajax({  
		type: "GET",  
		url: "./employee_save2.php",
		data: string,
		success: function(data){
			$('#emp1_details').append(data);
			$('#emp2_details').append(data);
			console.log(data);
        }  
	}); 
	//alert('Employee details saved.'); 				
	$('#emp_name1').val("");
	$('#emp_rate').val("");
	$('#emp_email1').val("");
	$('#rate_total').val(rate_total);
})

$(document).ready(function () {
    $('#bill_emp1').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "GET",
            data: $(this).serialize(),
            success: function (data) {
                $("#totalHoursCosts").html(data);
                $("#save-assign-show").removeClass('sectionhide');
                $("#save-assign-hide").hide();
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
})


$(document).ready(function () {
    $('#bill_emp2').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "GET",
            data: $(this).serialize(),
            success: function (data) {
                $("#totalHoursCosts2").html(data);
                $("#save-assign-show").removeClass('sectionhide');
                $("#save-assign-hide").hide();
            },
            error: function (jXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    });
})


$(document).on('click', '#materials', function(event){
	var vendors = $('#vendors').val();
	var matdescription = $('#matdescription').val();
	var matcost = $('#matcost').val();
	var string ="vendors=" + vendors + "&matdescription=" + matdescription + "&matcost=" + matcost;

	$.ajax({  
		type: "GET",  
		url: "./materials.php",
		data: string,
		success: function(data){
			$('#materials-data').append(data);
			console.log(data);
        }  
	});

	$('#vendors').val("");
	$('#matdescription').val("");
	$('#matcost').val("");
})


$(document).on('click', '#change_order', function(event){
	var deschangeorder = $('#deschangeorder').val();
	var changeordercost = $('#changeordercost').val();
	var string ="deschangeorder=" + deschangeorder + "&changeordercost=" + changeordercost;

	$.ajax({  
		type: "GET",  
		url: "./change_order.php",
		data: string,
		success: function(data){
			$('#change_order_data').append(data);
			console.log(data);
        }  
	});

	$('#deschangeorder').val("");
	$('#changeordercost').val("");
})

$(document).on('click', '#submit_cont', function(event){
	var cont_name = $('#cont_name1').val();
	var cont_rate = $('#cont_rate').val();
	var cont_email = $('#cont_email1').val();
	var rate_total = $('#rate_total').val();
	rate_total = parseInt(rate_total) + parseInt(cont_rate);

	var string ="cont_name=" + cont_name + "&cont_rate=" + cont_rate + "&cont_email=" + cont_email;

	$.ajax({  
		type: "GET",  
		url: "./contractor_save.php",
		data: string,
		success: function(data){
			$('.cont_data').append(data);
        }  
	});

	$.ajax({  
		type: "GET",  
		url: "./contractor_save2.php",
		data: string,
		success: function(data){
			$('#cont1_details').append(data);
			$('#cont2_details').append(data);
        }  
	});
	//alert('Contractor details saved.'); 		
	$('#cont_name1').val("");
	$('#cont_rate').val("");
	$('#cont_email1').val("");
	$('#rate_total').val(rate_total);
})

$(document).on('click', '#add_bill_emp1', function(event){
		
		$("#emp1_details").append(
    		"<div class='col-md-12'><div class='col-sm-2'><div class='form-group'><label for='emp_name'>Employee Name</label><input id='emp_name2' type='text'  name='emp_name[]' class='form-control' /></div></div><div class='col-sm-2'><div class='form-group'><label for='empdatepicker'>Date</label><input id='' type='date'  name='emp_date[]' class='form-control' /></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1start'>Start</label><input id='hremp1start' type='text'  name='emp_start[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1end'>End</label><input id='hremp1end' type='text'  name='emp_end[]' class='form-control'/></div></div><div class='col-sm-2'><div class='form-group'><label for='hremp1notbilled'>Not Billed</label><input id='hremp1notbilled' type='text'  name='emp_not_billed[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Hours</label><input id='hremp1hours' type='text'  name='emp_hours[]' class='form-control' onblur='CalTotalHours(this)'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Rates $$</label><input id='hremp1hours' type='text'  name='emp_rate[]' class='form-control' onblur='CalTotalHoursCost(this)'/></div></div></div>");
})


// $(document).on('click', '#remove_bill_emp', function(event){
// 	$('#emp_details').remove();
// })

$(document).on('click', '#add_bill_emp2', function(event){
		
		$("#emp2_details").append(
    		"<div class='col-md-12'><div class='col-sm-2'><div class='form-group'><label for='emp_name'>Employee Name</label><input id='emp_name2' type='text'  name='emp_name[]' class='form-control' /></div></div><div class='col-sm-2'><div class='form-group'><label for='empdatepicker'>Date</label><input id='' type='date'  name='emp_date[]' class='form-control' /></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1start'>Start</label><input id='hremp1start' type='text'  name='emp_start[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1end'>End</label><input id='hremp1end' type='text'  name='emp_end[]' class='form-control'/></div></div><div class='col-sm-2'><div class='form-group'><label for='hremp1notbilled'>Not Billed</label><input id='hremp1notbilled' type='text'  name='emp_not_billed[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Hours</label><input id='hremp1hours' type='text'  name='emp_hours[]' class='form-control' onblur='CalTotalHours(this)'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Rates $$</label><input id='hremp1hours' type='text'  name='emp_rate[]' class='form-control' onblur='CalTotalHoursCost(this)'/></div></div></div>");
})

$(document).on('click', '#add_bill_cont1', function(event){
		
		$("#cont1_details").append(
    		"<div class='col-md-12'><div class='col-sm-2'><div class='form-group'><label for='cont_name'>Contractor Name</label><input id='cont_name2' type='text'  name='cont_name[]' class='form-control' /></div></div><div class='col-sm-2'><div class='form-group'><label for='empdatepicker'>Date</label><input id='' type='date'  name='cont_date[]' class='form-control' /></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1start'>Start</label><input id='hremp1start' type='text'  name='cont_start[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1end'>End</label><input id='hremp1end' type='text'  name='cont_end[]' class='form-control'/></div></div><div class='col-sm-2'><div class='form-group'><label for='hremp1notbilled'>Not Billed</label><input id='hremp1notbilled' type='text'  name='cont_not_billed[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Hours</label><input id='hremp1hours' type='text'  name='cont_hours[]' class='form-control' onblur='CalTotalHours(this)'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Rates $$</label><input id='hremp1hours' type='text'  name='emp_rate[]' class='form-control' onblur='CalTotalHoursCost(this)'/></div></div></div>");
})

$(document).on('click', '#add_bill_cont2', function(event){
		
		$("#cont2_details").append(
    		"<div class='col-md-12'><div class='col-sm-2'><div class='form-group'><label for='cont_name'>Contractor Name</label><input id='cont_name2' type='text'  name='cont_name[]' class='form-control' /></div></div><div class='col-sm-2'><div class='form-group'><label for='empdatepicker'>Date</label><input id='' type='date'  name='cont_date[]' class='form-control' /></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1start'>Start</label><input id='hremp1start' type='text'  name='cont_start[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1end'>End</label><input id='hremp1end' type='text'  name='cont_end[]' class='form-control'/></div></div><div class='col-sm-2'><div class='form-group'><label for='hremp1notbilled'>Not Billed</label><input id='hremp1notbilled' type='text'  name='cont_not_billed[]' class='form-control'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Hours</label><input id='hremp1hours' type='text'  name='cont_hours[]' class='form-control' onblur='CalTotalHours(this)'/></div></div><div class='col-sm-1'><div class='form-group'><label for='hremp1hours'>Rates $$</label><input id='hremp1hours' type='text'  name='emp_rate[]' class='form-control' onblur='CalTotalHoursCost(this)'/></div></div></div>");
})

$( ".emp_name2" ).on( "click", function() {
	alert('clicked');
  console.log( $( this ).text() );
})

$( "#save-assign-hide" ).on( "click", function() {
	alert('Have you fill the complete form. If not then Please fill all data first. Pleae note, click on Calculate Hours & Rates button before submit');
})



