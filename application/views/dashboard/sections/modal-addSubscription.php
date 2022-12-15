<!-- Import custom CSS -->
<link rel="stylesheet" type="text/css" href="/assets/foundation-6.5.1/css/modal-addSession.css">
<link rel="stylesheet" type="text/css" href="/assets/jquery-ui-1.13.2/jquery-ui.min.css">

<!-- Load custom JS -->
<script src="/assets/foundation-6.5.1/js/addSubscriptionModal.js"></script>
<script src="/assets/jquery-ui-1.13.2/jquery-ui.js"></script>

<div class="reveal" id="addSessionModal" data-reveal>
  <h1>Add Subscription</h1>
  <div id="students-labels-container">

  </div>
  <form id="myForm" onsubmit="submitForm(event);return false">

    <div id="form-fileds-container">

      <div id="for-container">
        <p id="for-title">
          For:
        </p>
        <div id="for-each-holder">
        </div>
      </div>
        
      <div id="date-container">
        <div id="from-container" class="date-child-container">
          <label for="from">From</label>
          <input type="text" id="from" name="from">
        </div>
        <div id="to-container" class="date-child-container">
          <label for="to">to</label>
          <input type="text" id="to" name="to">
        </div>
      </div>

      <div id="trials-container">
        <label for="trialsAmount">Trials</label>
        <input type="number" name="trails" list="trailsAmount">
          <datalist id="trailsAmount">
            <option value="5">
            <option value="10">
            <option value="15">
            <option value="20">
          </datalist>
      </div>

    <!-- End elements container -->
    </div>
    <button type="submit" class="button submit">Create Session</button>
  </form>
  
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<script>
  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
          minDate: 0
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        minDate: 0
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
  } );
  
</script>