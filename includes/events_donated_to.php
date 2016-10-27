<?php
$events = $membership->get_donated_events($userid); //fetches an array of all events and stores as local variable
?>

<div class="row container">
  <ul class="collection">
    <?php
      foreach( $events as &$p ):
      $p = trim($p);
      if (substr($p, 0, 1) == 0) {
        $id = 0;
        $event_name = 'This event was deleted!';
        $event_photo = 'event_deleted.png';
        $p = substr($p, 1);
      } else {
        $id = substr($p, 0, 5);
        $eventarray = $membership->get_event_information($id);
        $event_name = $eventarray[0];
        $event_photo = $eventarray[11];
        $p = substr($p, 5);
      }
      
    ?>
    <a class="collection-item avatar" <?php if ($id != 0) { echo 'href="event.php?eventid='.$id.'"';}?>>
    <img class="circle responsive-img" alt="event icon" src="eventimg/<?php echo $event_photo; ?>">
    <span class="left title"><?php echo $event_name; ?></span>
    <span class="right">Donation amount: $<?php echo $p; ?></span>
    </a>
    <?php endforeach; ?>
  </ul>
</div>
