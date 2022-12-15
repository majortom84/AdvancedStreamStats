<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

	<link rel="stylesheet" type="text/css" href="/assets/foundation-6.5.1/css/footer.css">
	<div id="footer"></div>

		<!-- load foundation Jquery and Javascript -->
		<script src="/assets/foundation-6.5.1/js/vendor/foundation.min.js"></script>
		<script src="/assets/foundation-6.5.1/js/vendor/what-input.js"></script>
		<script src="/assets/foundation-6.5.1/js/app.js"></script>
		
		<!-- End load foundation Jquery and Javascript -->
		
		
		<!-- Mobile Menu -->
		<script>
		$('#toggle').click(function() {
			$(this).toggleClass('active');
			$('#overlay-id-mobile-menu').toggleClass('open').show();
		});
	
		$('#overlay-id-mobile-menu li').on('click', function(){
			$('#overlay-id-mobile-menu').hide();
			$('#overlay-id-mobile-menu').toggleClass('open');
			$('#toggle').removeClass("active");
		});
		
		
		</script>
		<!-- End Mobile Menu -->
		</body>
	
	

<!-- End HTML -->
</html> 