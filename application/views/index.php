
<!-- Import specific CSS -->
<link rel="stylesheet" type="text/css" href="/assets/foundation-6.5.1/css/login.css">

<div id="login-container">

		<div id="logo-login-container" class="text-center">
			<img src="https://via.placeholder.com/150" alt="DataBinder Login Logo">
		</div>

		<div id="errors" class="errors text-center"></div>
		
		<form id="form-login" onsubmit="submitForm(event);return false">
			<div id="form-fileds-container">
				<label for="email">Email:</label>
				<input required id="email" type="email" name="email" placeholder="Email" autofocus/>
				<label for="password">Password:</label>
				<input required id="password" type="password" name="password" placeholder="Password" autofocus/>
			</div>
			<div id="login-button-container">
				<button type="submit" class="button submit" id="login-btn">Login</button>
			</div>
		</form>
		
		<div id="signup" class="text-center">
			<a id="signup-forgot-text" href="Index/signup">Sign Up</a>
		</div>
		
</div> <!-- End login container div -->


<script src="/assets/foundation-6.5.1/js/app-login.js"></script>