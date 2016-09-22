<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" enctype="multipart/form-data" type="file" method="post" action=""> 
  <div class="row">
    <div class="input-field col s12">
      <input id="event_name" name="event_name" type="text" class="validate"> 
      <label for="event_name">Event Name</label>
    </div>
  </div>
  
	<div class="row">
    <div class="input-field col s12">
      <textarea id="event_desc" name="event_desc" class="materialize-textarea"></textarea> 

      <label for="event_desc">Event Description</label>
    </div>
	</div>

  <div class="row">
    <div class="input-field col s12">
      <input id="event_location" name="location" type="text" class="validate">
      <label for="event_location">Address</label>
    </div>
  </div>  

  <div class="row">
    <div class="input-field col s12"> 
      <input id="amt_required" type="number" min="00000" max="99999" class="validate" name="amt_required"> 
      <label for="amt_required">Funding Required (AUD$) </label> 
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12">
      <input id="event_date" type="date" name="event_date" class="datepicker" class="validate">
      <label for="event_date">Event Date</label>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12"> 
      <input id="event_location" name="event_location" type="text" class="validate"> 
      <label for="event_location">Event Area (e.g. Brisbane, Melbourne, Chermside)</label> 
    </div> 
  </div>

  <div class="row"> 
    <div class="input-field col s12"> 
      <input id="postcode" type="text" class="validate" name="postcode"> 
      <label for="postcode">Postcode</label> 
    </div> 
  </div>

  <div class="file-field input-field">
    <div class="btn">
      <span>File</span>
      <input type="file">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text">
    </div>
  </div>

  <button class="btn-large waves-effect waves-light right tooltipped modal-trigger" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="submit" href="preview_event.php">Preview<i class="material-icons right">send</i>
  </button>



</form>