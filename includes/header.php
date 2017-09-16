<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Construction Projects</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript">
	$(function() 
	{
	    $( "#location" ).autocomplete({
	      source: 'auto_complete_location.php'
	    });
	});

	$(function() 
	{
	    $( "#ownername" ).autocomplete({
	      source: 'auto_complete_owner_name.php'
	    });
	});

	$(function() 
	{
	    $( "#phone" ).autocomplete({
	      source: 'auto_complete_owner_phone.php'
	    });
	});

	$(function() 
	{
	    $( "#cell" ).autocomplete({
	      source: 'auto_complete_owner_cell.php'
	    });
	});

	$(function() 
	{
	    $( "#contractor" ).autocomplete({
	      source: 'auto_complete_property_contractor_name.php'
	    });
	});

	$(function() 
	{
	    $( "#contractorphone" ).autocomplete({
	      source: 'auto_complete_owner_phone.php'
	    });
	});

	$(function() 
	{
	    $( "#contractorcell" ).autocomplete({
	      source: 'auto_complete_owner_cell.php'
	    });
	});

	$(function() 
	{
	    $( "#emp_name1" ).autocomplete({
	      source: 'auto_complete_emp_name.php'
	    });
	});

	$(function() 
	{
	    $( "#cont_name1" ).autocomplete({
	      source: 'auto_complete_mp_cont_name.php'
	    });
	});

	$(function() 
	{
	    $( "#emp_name2" ).autocomplete({
	      source: 'auto_complete_emp_name.php'
	    });
	});

	$(function() 
	{
	    $( "#cont_name2" ).autocomplete({
	      source: 'auto_complete_mp_cont_name.php'
	    });
	});

	$(function() 
	{
	    $( "#emp_name3" ).autocomplete({
	      source: 'auto_complete_emp_name.php'
	    });
	});

	$(function() 
	{
	    $( "#cont_name3" ).autocomplete({
	      source: 'auto_complete_mp_cont_name.php'
	    });
	});

	function getEmailIdEmp() {
		var emp_name1 = document.getElementById("emp_name1");
	  	var xmlhttp;
	  	if (emp_name1.value == "") {
	    	document.getElementById("emp_email1").innerHTML = "";
	    	return;
	  	}  
	  	xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	data = JSON.parse(this.responseText);
		    	document.getElementById("emp_email1").value = data.emp_email;
		    	document.getElementById("emp_rate").value = data.emp_rate;
		    }
	  	};
	  	xmlhttp.open("GET", "get_email_id_emp.php?q="+emp_name1.value, true);
	  	xmlhttp.send();
	}


	function getEmailIdCont() {
		var cont_name1 = document.getElementById("cont_name1");
	  	var xmlhttp;
	  	if (cont_name1.value == "") {
	    	document.getElementById("cont_email1").innerHTML = "";
	    	return;
	  	}  
	  	xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      	data = JSON.parse(this.responseText);
		    	document.getElementById("cont_email1").value = data.cont_email;
		    	document.getElementById("cont_rate").value = data.cont_rate;
		    }
	  	};
	  	xmlhttp.open("GET", "get_email_id_cont.php?q="+cont_name1.value, true);
	  	xmlhttp.send();
	}



	function CalTotalHours(data){
		
		var Hours = parseInt(data.value);
		var TotalHours1 = document.getElementById("total_hours1");
		var TotalHours2 = document.getElementById("total_hours2");

		TotalHours1.value=parseInt(TotalHours1.value) + Hours;
		TotalHours2.value=parseInt(TotalHours2.value) + Hours;
	}

	function CalTotalHoursCost(data){
		
		var Cost = parseInt(data.value);
		var TotalCost1 = document.getElementById("total_hours_cost1");
		var TotalCost2 = document.getElementById("total_hours_cost2");

		var TotalHours1 = document.getElementById("total_hours1");
		var TotalHours2 = document.getElementById("total_hours2");

		var TotalHoursCostTotal1 = document.getElementById("total_hours_cost_total1");
		var TotalHoursCostTotal2 = document.getElementById("total_hours_cost_total2");

		TotalCost1.value=parseInt(TotalCost1.value) + Cost;
		TotalCost2.value=parseInt(TotalCost2.value) + Cost;

		TotalHoursCostTotal1.value=parseInt(TotalCost1.value) * parseInt(TotalHours1.value);
		TotalHoursCostTotal2.value=parseInt(TotalCost2.value) * parseInt(TotalHours2.value);
	}

	function ShowTotalHours1(){
		var TotalHours1 = document.getElementById('total_hours1');
		alert("Total Hours :  " + TotalHours1.value);
		document.getElementById('total_hours1').value = parseInt(TotalHours1.value);
	}

	function ResetTotalHours1(){
		var TotalHours1 = document.getElementById('total_hours1').value = 0;
		var EmpHour = document.getElementById('hremp1hours').value = 0;
		var ContHour = document.getElementById('conthours').value = 0;
		alert("Total Hours Reset Done.");	
	}

	function ShowTotalHoursCost1(){
		var TotalHours1 = document.getElementById('total_hours1').value;
		var TotalRates1 = document.getElementById('rate_total').value;
		var TotalHoursCost1 = TotalHours1 * TotalRates1;
		document.getElementById('total_hours_cost_total1').value = parseInt(TotalHoursCost1);
		alert("Total Hours Cost :  " + parseInt(TotalHoursCost1));
	}

	function ShowTotalHours2(){
		var TotalHours2 = document.getElementById('total_hours2');
		alert("Total Hours :  " + TotalHours2.value);
		document.getElementById('total_hours2').value = parseInt(TotalHours2.value);
	}

	function ShowTotalHoursCost2(){
		var TotalHours2 = document.getElementById('total_hours2').value;
		var TotalRates2 = document.getElementById('rate_total').value;
		var TotalHoursCost2 = TotalHours2 * TotalRates2;
		document.getElementById('total_hours_cost_total2').value = parseInt(TotalHoursCost2);
		alert("Total Hours Cost :  " + parseInt(TotalHoursCost2));
	}

	function changeNumberFormat(data){
		var number = data.value;		
		data.value = parseFloat(Math.round(number * 100) / 100).toFixed(2);
	}

	function GetAssociationOwner(data){
		var user_address_id = data.value;
		//document.getElementById('changeordercost').value = parseFloat(Math.round(number * 100) / 100).toFixed(2);
		var xmlhttp;
	  	if (user_address_id.value == "") {
	    	document.getElementById("association_name").value = "";
	    	return;
	  	}  
	  	xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		      	data = JSON.parse(this.responseText);
		      	if (data.title != '' || data.title != null) {
			    	document.getElementById("association_name").value = data.title;
			    	document.getElementById("owner_name").value = data.full_name;
		    	}else{
			    	document.getElementById("association_name").value = 'Not Applicable';
			    	document.getElementById("owner_name").value = 'Not Applicable';
		    	}
		    }
	  	};
	  	xmlhttp.open("GET", "get_association_owner_details.php?q="+user_address_id, true);
	  	xmlhttp.send();
	}


	////////////////  property owner ////////////////////

	function getOwnerDetails() {
		var owner_name = document.getElementById("ownername");
	  	var xmlhttp;
	  	if (owner_name.value == "") {
	    	document.getElementById("owner_phone").innerHTML = "";
	    	document.getElementById("owner_cell").innerHTML = "";
	    	return;
	  	}  
	  	xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	data = JSON.parse(this.responseText);
		    	document.getElementById("owner_phone").value = data.owner_phone;
		    	document.getElementById("owner_cell").value = data.owner_cell;
		    }
	  	};
	  	xmlhttp.open("GET", "get_owner_details.php?q="+owner_name.value, true);
	  	xmlhttp.send();
	}

	function getPropertyContractorDetails() {
		var owner_name = document.getElementById("contractor");
	  	var xmlhttp;
	  	if (owner_name.value == "") {
	    	document.getElementById("contractor_phone").innerHTML = "";
	    	document.getElementById("contractor_cell").innerHTML = "";
	    	return;
	  	}  
	  	xmlhttp = new XMLHttpRequest();
	  	xmlhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	data = JSON.parse(this.responseText);
		    	document.getElementById("contractor_phone").value = data.contractor_phone;
		    	document.getElementById("contractor_cell").value = data.contractor_cell;
		    }
	  	};
	  	xmlhttp.open("GET", "get_prop_contractor_details.php?q="+owner_name.value, true);
	  	xmlhttp.send();
	}

	$(document).ready(function() {
	  $(".remove").click(function() {
	    $(this).closest(".row").remove();
	  });
	});

	$(document).ready(function() {
	  $("#print-button").click(function() {
	  	$('#print-button').hide();
	  	window.print();
	  });
	});

</script>	
</head>
<body>
	<div class="site-wrapper">
		<div class="container">