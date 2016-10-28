//from home.php
<div class="row center">
		<input class="col l6 s12 offset-s0  offset-l3"  type="text" id="searchBar" onkeyup="searchList()" placeholder="Search for Event name, Location, Detials...">
  </div>
  <div class="row center">
    <ul id="listOfEvents">
		<?php
			foreach( $events as &$p ):
			$p = trim($p);
			$id = substr($p, 0, 5);
			$p = substr($p, 5);
		?>
    <card class="col s12 m6 l3">
    <div class="card medium hoverable">
      <div class="card-image waves-effect waves-block waves-light">
        <img href="event.php?eventid=<?php echo $id; ?>" src="http://www.publicdomainpictures.net/pictures/130000/nahled/yellow-orange-background.jpg">
      </div>
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
//init.js
function searchList() {
    // Declare variables

    var input, filter, ul, li, p, i, card;
    input = document.getElementById('searchBar');
    filter = input.value.toUpperCase();
    ul = document.getElementById("listOfEvents");
    li = ul.getElementsByTagName('li');
    card = ul.getElementsByTagName('card');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        p = li[i].getElementsByTagName("p")[0];
        if (p.innerHTML.toUpperCase().indexOf(filter) > -1) {
            card[i].style.display = "";
        } else {
            card[i].style.display = "none";
        }
    }
}

