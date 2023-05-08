$(document).ready(function() {

    $('#search-form').submit(function(event) {
      // Prevent the form from submitting normally
      event.preventDefault();
  
      // Get the form data
      var formData = $(this).serialize();
  
      // Send an AJAX request
      $.ajax({
        type: 'GET',
        url: './newsearch.php',
        data: formData,
        success: function(response) {
          $('#search-results').html(response);
        }
      });
    });
    
  });

function getRandomGame() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        var randomGame = JSON.parse(this.responseText);
        var table = document.getElementById("random-game-table");
        table.innerHTML = "<tr><td>" + randomGame.Title + "</td><td>" + randomGame.Release + "</td><td>" + randomGame.Developers + "</td><td>" + randomGame.Platform + "</td></tr>";
        }
    };

    xmlhttp.open("GET", "getrandomgame.php", true);
    xmlhttp.send();
}


