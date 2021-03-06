<?php
  $events = array();
  $events = $membership->get_events_going_to($userid);
?>

<div class="row container">
  <ul class="collection">
    <?php
      foreach( $events as &$p ):
      $p = trim($p);
      $id = substr($p, 0, 5);
      $eventarray = $membership->get_event_information($id);
      $event_name = $eventarray[0];
      $event_date = $eventarray[9];
      $event_photo = $eventarray[11];
      $p = substr($p, 5);
    ?>
    <a class="collection-item avatar" href="event.php?eventid=<?php echo $id; ?>">
    <img class="circle responsive-img" alt="event icon" src="eventimg/<?php echo $event_photo; ?>">
    <span class="left title"><?php echo $event_name; ?></span>
    <span class="right">Date of event: <?php echo $event_date; ?></span>
    </a>
    <?php endforeach; ?>
  </ul>
</div>
