<?php
  $events = array();
  //TODO: write get_events_going_to();
  $events = $membership->get_events_going_to($userid); //fetches an array of all events and stores as local variable
?>

<div class="row container">
  <ul class="collection">
    <?php
      foreach( $events as &$p ):
      $p = trim($p);
      $id = substr($p, 0, 5);
      $eventarray = $membership->get_event_information($id);
      $event_photo = $eventarray[11];
      $p = substr($p, 5);
    ?>
    <a class="collection-item avatar" href="event.php?eventid=<?php echo $id; ?>">
    <img class="circle responsive-img" alt="event icon" src="eventimg/<?php echo $event_photo; ?>.jpg">
    <span class="title"><?php echo $p; ?></span>
    </a>
    <?php endforeach; ?>
  </ul>
</div>
