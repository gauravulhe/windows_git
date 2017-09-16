
		</div>
	</div>

	<script type="text/javascript" src="js/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>	
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
		$(".desc-label").hover(function(){
        	$(this).next(".desc-content").show();
		}, 
		function () {
		    $(this).next(".desc-content").hide();
		});

		// if($(window).width() < 991){
		// 	$(".desc-label").on("click", function(){
		// 		$(this).next(".desc-content").toggle();
		// 	});
		// }
	});

	jQuery(function () {
	    jQuery('.event').draggable({
	        revert: true
    });
    jQuery('.main-event').droppable({
	        accept: '.event',
	        drop: function (event, ui) {
	            ui.draggable.hide();
	            if (confirm('Are you sure you want to delete?')) {
	                ui.draggable.remove();
	            } else {
	                ui.draggable.show();
	            }
	        }
	    });
	});

    </script>


</body>
</html>