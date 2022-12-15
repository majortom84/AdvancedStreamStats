/**
 * This JS file is for signing up for new services
 */

// globals
var checkedValue;
var is_valid = 0;
var passAllow = /^[0-9a-zA-Z\!\$\.\@]+$/;
var emaiAllow = /^[0-9a-zA-Z\.\@\-]+$/;
var seconds = 7; // seconds for redirect
var foo; // variable for clearInterval() function


// get form data, validate if good send to backend
function submitForm(event){
	event.preventDefault();
    console.log("submit");

    var myForm = document.getElementById('form-signup');

	var fd = new FormData(myForm);

	// Get all values
    var first_name = fd.get('first_name');
	var last_name = fd.get('last_name');
	var email = fd.get('email');
	var password = fd.get('password');
	var checkedValue = $("#terms").is(':checked'); // get the value

    console.log(first_name+" - "+last_name+" - "+email+" - "+password);

    // Transform
	var userData = {
        "first_name":first_name,
        "last_name":last_name,
        "email":email,
        "password":password,
		"terms": checkedValue
    };

    console.log( userData );

	if( validate(userData) ){
		console.log( "VALID: "+is_valid );
		console.log( "send data to backend" );
		document.getElementById('errors').innerHTML = '';
		sendData(userData);
	}
	else{
		console.log( "not valid" );
		return false;
	}

}// end submit 




// validate data 
function validate(user){
	is_valid = 0;
	document.getElementById('errors').innerHTML = '';
	var ret = true;

	if(!user['email'].match(emaiAllow)){
		
		if(document.getElementById('errors').innerHTML !== '') 
			document.getElementById('errors').innerHTML += '<br>';
			
		document.getElementById('errors').innerHTML += 'Email not valid';
		document.getElementById("email-text").className = "text-red";
		is_valid++;
		console.log("emal allow "+is_valid);
		//return false; // if not vaild
	}// end if for char type
	else {is_valid-1;}
	
	if(user['email'].length > 150){
		
		if(document.getElementById('errors').innerHTML !== '') 
			document.getElementById('errors').innerHTML += '<br>';
			
		document.getElementById('errors').innerHTML += 'Email max length is 256 characters';
		document.getElementById("email-text").className = "text-red";
		is_valid++;
		console.log("emal length > 150 "+is_valid);
		//return false; // if not vaild
	}// end if for char type
	else {is_valid-1;}
	
	if(!user['password'].match(passAllow)){
		
		if(document.getElementById('errors').innerHTML !== '') 
			document.getElementById('errors').innerHTML += '<br>';
			
		document.getElementById('errors').innerHTML += 'Password not valid';
		document.getElementById("password-text").className = "text-red";
		is_valid++;
		console.log("pass allow " + is_valid);
		//return false; // if not vaild
	}// end if for char type
	else {is_valid-1;}
	
	// password max length
	if(user['password'].length > 150){
		
		if(document.getElementById('errors').innerHTML !== '') 
			document.getElementById('errors').innerHTML += '<br>';
			
		document.getElementById('errors').innerHTML += 'Password max length is 150 characters';
		document.getElementById("password-text").className = "text-red";
		is_valid++;
		console.log("pass > 150 " + is_valid);
		//return false; // if not vaild
	}// end if for char type
	else {is_valid-1;}

    // password min length
    if(user['password'].length < 8){
		
		if(document.getElementById('errors').innerHTML !== '') 
			document.getElementById('errors').innerHTML += '<br>';
			
		document.getElementById('errors').innerHTML += 'Password min length is 8 characters';
		document.getElementById("password-text").className = "text-red";
		is_valid++;
		console.log("pass < 8 " + is_valid);
		//return false; // if not vaild
	}// end if for char type
	else {is_valid-1;}

	// get terms and conditions checkbox value
	// if not checked do not proceed 
	if(!user['terms']){

		console.log(user['terms']); // testing

		if(document.getElementById('errors').innerHTML !== '') 
			document.getElementById('errors').innerHTML += '<br>';

		document.getElementById('errors').innerHTML += 'You must accept the terms and conditions to register for an account.';
		document.getElementById("terms-text").className = "text-red";
		is_valid++;
		console.log("check box "+is_valid);
	}else {is_valid-1;}
	
	if(is_valid >= 1){
		console.log(is_valid);
		return false;
	}
	else{return true;}//console.log("Valid True " + is_valid);

}// end Validate


// ----------------------- password visibilty ------------------------
// toggle between a visible password and non visible password
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
	console.log(type);
    password.setAttribute('type', type);
    // toggle the eye / eye slash icon
    togglePassword.classList.toggle('fa-eye');
});
// ----------------------- End password visibilty ------------------------


// -------------------- on key press for password over 8 chars ------------
// add a class to the class list in the UI if 
// the char count is equal to or over 8
// if the cahrs are acceptable 
// set text to green
$("#password").keyup(function(e){

    var count = $(this).val().length;

	// if char count is acceptable 
	//console.log(count);
	if(count >= 8){
		document.getElementById("char-length-pass").classList.remove("text-black");
		document.getElementById("char-length-pass").classList.remove("text-red");
		document.getElementById("char-length-pass").classList.add("text-green");
	}else if(count > 1){
		document.getElementById("char-length-pass").classList.remove("text-green");
		document.getElementById("char-length-pass").classList.remove("text-black");
		document.getElementById("char-length-pass").classList.add("text-red");
	}else{
		document.getElementById("char-length-pass").classList.remove("text-green");
		document.getElementById("char-length-pass").classList.remove("text-red");
		document.getElementById("char-length-pass").classList.add("text-black");
	}

	// if pass char allow is acceptable
	// check if count is 0 and delete was pressed, we do not need to check this case
	if(count == 0 && e.keyCode == 8){
		document.getElementById("allowed-chars-pass").classList.remove("text-green");
		document.getElementById("allowed-chars-pass").classList.remove("text-red");
		document.getElementById("allowed-chars-pass").classList.add("text-black");
	}else{
		if($(this).val().match(passAllow)){
			document.getElementById("allowed-chars-pass").classList.remove("text-black");
			document.getElementById("allowed-chars-pass").classList.remove("text-red");
			document.getElementById("allowed-chars-pass").classList.add("text-green");
		}else if(!$(this).val().match(passAllow)){
			document.getElementById("allowed-chars-pass").classList.remove("text-green");
			document.getElementById("allowed-chars-pass").classList.remove("text-black");
			document.getElementById("allowed-chars-pass").classList.add("text-red");
		}else if (count = 0){
			document.getElementById("allowed-chars-pass").classList.remove("text-green");
			document.getElementById("allowed-chars-pass").classList.remove("text-red");
			document.getElementById("allowed-chars-pass").classList.add("text-black");
		}
	}
});
// -------------------- End on key press for password over 8 chars ------------




// send to backend
function sendData(data) {
		
	document.getElementById('errors').innerHTML = '';
	
	// variables
	var response;
	var http = new XMLHttpRequest();
	var url = 'signUp';

	http.open('POST', url, true);
	
	//Send the proper header information along with the request
	http.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
	
	//Call a function when the state changes.
	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) {
			console.log(JSON.parse(http.response));
			console.log(JSON.parse(http.response)['status']);
			var status = JSON.parse(http.response)['status'];
			console.log(status);
			if(status == 'Success'){
				//window.location.replace("students/dataBindersList");

				document.getElementById('success').innerHTML = 'Success! You have created an account. You will be redirected to the login screen in <span id="seconds">7</span>';

				// redirect after X sec
				countdownTimer();
			}else{
				document.getElementById('errors').innerHTML += '<br>';
				document.getElementById('errors').innerHTML += status;
			}
		}// end if
		else if(http.status >= 500){
			document.getElementById('errors').innerHTML += '<br>';
			document.getElementById('errors').innerHTML += 'Sever error, Please contact Thomas at tcward84@gmail.com';
		}
	}// end Call a function when the state changes.
	http.send(JSON.stringify(data)); // send to backend
}// ens send data



// ----------------- redirect after X seconds -------------------------
// Countdown timer for redirecting to another URL after several seconds
function redirect() {
    document.location.href = '/';
}

function updateSecs() {
    document.getElementById("seconds").innerHTML = seconds;
    seconds--;
    if (seconds == -1) {
        clearInterval(foo);
        redirect();
    }
}

function countdownTimer() {
    foo = setInterval(function () {
        updateSecs()
    }, 1000);
}
// ----------------- End redirect after X seconds -------------------------