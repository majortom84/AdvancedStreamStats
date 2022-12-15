/**
 * This file is for the Modal on the data bonders page.
 * For adding students to the backend.
 */

// set a count for student data to allow for grouping on arrays
var studentCount = 1;
var returnObject = [];

// open modal
// test timestamp
function addStudent(){
  console.log('add student clicked');
  $('#addStudentModal').foundation('open');

  // timestamp
  console.log(Math.floor(Date.now() / 1000));

  // time stamp to date and time human readable
  var unix_timestamp = Math.floor(Date.now() / 1000);
  // multiplied by 1000 so that the argument is in milliseconds, not seconds.
  var date = new Date(unix_timestamp * 1000);
  // Hours part from the timestamp
  var hours = (date.getHours() % 12  || 12 ); // added "% 12  || 12" to convert to 12hr otherwise it will be 24hr
  // Minutes part from the timestamp
  var minutes = "0" + date.getMinutes();
  // Seconds part from the timestamp
  var seconds = "0" + date.getSeconds();

  // Will display time in 10:30:23 format
  var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);

  console.log(formattedTime);
}// end add student


// submit form function
function submitForm(event){
  var data = [];
  event.preventDefault();
  console.log("submit");
  
  // get data from from
  var myForm = document.getElementById('myForm');
  var fd = new FormData(myForm);
  // try to use ids loop with count
  // set array of objects
  for (let i = 0; i < studentCount; i++) {
    console.log(fd.get('first_name.'+i)); 
    var temp = {
      'first_name': fd.get('first_name.'+i),
      'last_name': fd.get('last_name.'+i),
      'middle_name': fd.get('middle_name.'+i)
    };
    // check for dupliacte object in array before adding to array
    // only add if not exists
    if(!returnObject.some(temp => returnObject[i] === temp)){
      returnObject.push( temp );
    }
  }
  // disyplay data 
  console.log(returnObject);
  
  // send data to backend
  sendData(returnObject);
}// end form submit



  // function to remove on click 
  // for remove button in new inputs below
  $(document).on('click', '.remove', function(){
          console.log("Remove");
          $(this).closest('.add-input').remove();
          studentCount--
  });// end function to remove on click

  // This adds the new inputs for each new student to add
  // remove button at bottom
  function addAnotherStudent(){
    console.log("add to form");
    // insertAdjacentHTML is better than adding to innerHTML, It keeps uer input 
    // innerHTML removes the uer input from previous elements
    document.getElementById('form-fileds-container').insertAdjacentHTML( "beforeend", '<div class="add-input">' +
                                                                            '<input required id="first_name.'+studentCount+'" type="text" name="first_name.'+studentCount+'" placeholder="First Name" autofocus/>' +
                                                                            '<input required id="last_name.'+studentCount+'" type="text" name="last_name.'+studentCount+'" placeholder="Last Name" autofocus/>' +
                                                                            '<input id="middle_name.'+studentCount+'" type="text" name="middle_name.'+studentCount+'" placeholder="Middle Name/Initial" autofocus/>' +
                                                                            '<button class="button remove" type="button">Remove</button>' +
                                                                            '</div>');
    studentCount++; // add to count for students
  }


  // send data to backend
  function sendData(data) {
		
		//document.getElementById('errors').innerHTML = '';
		
		// send data to and from backend
		var response;
			
		var http = new XMLHttpRequest();
		
		var url = '/Students/addStudent';
		http.open('POST', url, true);
		
		//Send the proper header information along with the request
		http.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
		
		//Call a function when the state changes.
		http.onreadystatechange = function() {
		    if(http.readyState == 4 && http.status == 200) {
				console.log(JSON.parse(http.response));
				console.log(JSON.parse(http.response)['status']);
				
        if(JSON.parse(http.response)['status'] == 'Success'){
					location.reload();
					//document.getElementById('email-login').value = '';
					//document.getElementById('password-login').value = '';
					//document.getElementById('welcome').innerHTML = "Welcome " + JSON.parse(http.response)['firstName'] + "!";

					
				}
				else{
					/* if(document.getElementById('errors').innerHTML !== '') 
						document.getElementById('errors').innerHTML += '<br>';
					document.getElementById('errors').innerHTML += JSON.parse(http.response); */
				}
			}// end if
			else if(http.status >= 500){
				/* if(document.getElementById('errors').innerHTML !== '') 
					document.getElementById('errors').innerHTML += '<br>';
				document.getElementById('errors').innerHTML += 'Sever Connection error, Please contact Thomas at tcward84@gmail.com'; */
		    } 
		}// end Call a function when the state changes.
		http.send(JSON.stringify(data)); // send to backend
	}// end sendData