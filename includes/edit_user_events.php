<?php 
$events = $membership->get_event_list_user_id($userid); //fetches an array of all events and stores as local variable
?>

<h3 class="center">Events I've Created</h3>
<div class="row center">
    <ul id="listOfEvents">
		<?php
			foreach( $events as &$p ):
				$p = trim($p);
				$id = substr($p, 0, 5);
				$eventarray = $membership->get_event_information($id);
				$event_photo = $eventarray[11];
				$p = substr($p, 5);
		?>
	    <card class="col s12 m6 l3">
		    <div class="card medium hoverable">
				<a href="event.php?eventid=<?php echo $id; ?>">
		      		<div class="card-image waves-effect waves-block waves-light">
		        		<img src="eventimg/<?php echo $event_photo; ?>.jpg">
		      		</div>
				</a>
		      	<div class="card-stacked">
			        <div class="card-content">
			          <li><p><?php echo $p; ?></p></li>
			        </div>
			        <div class="card-action">
			          <a href="event.php?eventid=<?php echo $id; ?>">Read more</a>
			        </div>
		    	</div>
		    </div>
	  	</card>
	<?php endforeach; ?>
	</ul>
</div>