
<!-- Import specific CSS -->
<link rel="stylesheet" type="text/css" href="/assets/foundation-6.5.1/css/signup.css">

 	<div id="signup-container">
		<div class="card" id="card-center">
			<div class="card-divider">
				<h3> <?php echo $title;?> </h3>
			</div>
			<div class="card-section">
				<div id="errors" class="errors text-center"></div>
				<div id="success" class="success text-center"></div>
		
				<form id="form-signup" onsubmit="submitForm(event);return false">
					<div id="form-fileds-container">
						<label for="first_name" id="first-name-text">Fist Name:</label>
						<input required id="first_name" type="text" name="first_name" placeholder="Fist Name" autofocus/>
						<label for="last_name" id="last-name-text">Last Name:</label>
						<input required id="last_name" type="text" name="last_name" placeholder="Last Name" autofocus/>
						<label for="email" id="email-text">Email:</label>
						<input required id="email" type="email" name="email" placeholder="Email" autofocus/>
						<label for="password" id="password-text">Password:</label>
						<div class="password-wrapper">
							<input required id="password" type="password" name="password" placeholder="Password" autofocus>
							<span class="fa-solid fa-eye-slash" id="togglePassword"></span>
						</div>

						<div id="char-length-pass" class="password-text-data">At least 8 characters long</div> 
						<div id="allowed-chars-pass" class="password-text-data">Allowed characters: 0-9a-zA-Z!$.@</div>
						
					</div>
					<!-- Agree to Terms and Conditions -->
					<div id="terms-container">
						<input type="checkbox" id="terms" name="terms">
						<label for="terms" id="terms-text">I Agree to the Terms and Conditions</label>
					</div>
					<!-- End Agree to Terms and Conditions -->
					<div id="submit-container">
						<button type="submit" class="button submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
 	</div> 


<script src="<?php echo base_url(); ?>assets/foundation-6.5.1/js/app-signUp_new.js"></script>