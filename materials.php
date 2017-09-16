<script type="text/javascript">
	$(document).ready(function() {
	  $(".remove").click(function() {
	    $(this).closest(".row").remove();
	  });
	});
</script>
<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
	require_once('config/config.php');

	if (isset($_GET)) {
		$_SESSION['mat_vendors'] = isset($_GET['vendors'])?$_GET['vendors']:'';
		$_SESSION['mat_desc'] = isset($_GET['matdescription'])?$_GET['matdescription']:'';
		$_SESSION['mat_cost'] = isset($_GET['matcost'])?$_GET['matcost']:'';

		if ($_SESSION['mat_vendors'] != '') {

		echo '<div class="row">	
				<div class="col-sm-3">
					<div class="form-group">
						<label for="vendors">Vendors</label>
						<input id="vendors" type="text"  name="mat_vendors[]" class="form-control" value="'.$_SESSION['mat_vendors'].'"/>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="matdescription">Description</label>
						<input id="matdescription" type="text" name="mat_desc[]" class="form-control" value="'.$_SESSION['mat_desc'].'"/>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label for="matcost">Cost</label>
						<input id="matcost" type="text" name="mat_cost[]" class="form-control" value="'.$_SESSION['mat_cost'].'"/>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label for="matcost">Action</label>
						<p><span class="remove"><i class="glyphicon glyphicon-remove" style="color:red;padding:10px;"></i></span></p>
					</div>
				</div>
			</div>';
		}
	}

?>