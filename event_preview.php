  <?php 
    if (isset($_POST['submit'])) {
      $_SESSION['event_name'] = $_POST['event_name'];
      $_SESSION['event_desc'] = $_POST['event_desc'];
    }
  ?>
  
  <!-- Modal Structure -->
  <div id="preview_modal" class="modal modal-fixed-footer">
    <div class="card">
      <span class="card-title">Event Preview</span>
      <div class="card-image waves-effect waves-block waves-light">
        <img src=""> 
      </div>
      <div class="card-content">
        <p><?php echo $event_name ?></p>
        <p><?php echo $event_desc ?></p>
      </div>
    </div>

    <div class="modal-footer">
      <a href="home.php" class=" modal-action modal-close waves-effect waves-green btn-flat">Submit</a>
    </div>
  </div>