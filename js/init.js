
(function($){
  $(function(){

    $('.button-collapse').sideNav();
    $('.scrollspy').scrollSpy();
    $('.parallax').parallax();
    $('.modal-trigger').leanModal();
    $('.collapsible').collapsible({
        accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
    $('.datepicker').pickadate({
       selectMonths: true, // Creates a dropdown to control month
       selectYears: 200 // Creates a dropdown of 15 years to control year
    });
    $('#event_desc').val('');
    $('#event_desc').trigger('autoresize');

  }); // end of document ready
})(jQuery); // end of jQuery name spac

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
