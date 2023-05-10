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

// Function to get a random game
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

// Input suggestions in admin panel

const searchInput = document.getElementById('search-input');
const suggestionsDiv = document.getElementById('suggestions');

searchInput.addEventListener('input', function() {
  const searchTerm = searchInput.value;
  
  // Send AJAX request to PHP script
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'get_suggestions.php?term=' + searchTerm, true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      const suggestions = JSON.parse(xhr.responseText);
      
      // Clear existing suggestions
      suggestionsDiv.innerHTML = '';
      
      // Create new list of suggestions
      const ul = document.createElement('ul');
      suggestions.forEach(function(suggestion) {
        const li = document.createElement('li');
        li.textContent = suggestion;
        ul.appendChild(li);
      });
      
      // Add list of suggestions to the suggestions div
      suggestionsDiv.appendChild(ul);
    } else {
      console.log('Error: ' + xhr.status);
    }
  };
  xhr.send();
});
