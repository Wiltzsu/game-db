<?php
require "connect.php";
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="We provide gamers information on upcoming game release dates for PC, PlayStation (5 & 4), Xbox (Series X & One), and Nintendo Switch">
    <meta name="keywords" content="upcoming games, PC games, Playstation 5, Playstation 4, Xbox Series X, Xbox One, Nintendo Switch">
    <title>gamersOut - Your comprehensive source for game release dates</title>
    <link rel="icon" type="image/x-icon" href="img/gamersout2.png">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">    
    <link rel="stylesheet" href="./css/style.css">
    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?render=6LczX54lAAAAAFbt65LDoTrH7ZBHqmJS60Z1mn9W"></script>
    <script src="./javascript/javascript.js"></script>
    <script src="./javascript/bootstrap.bundle.js"></script>
    <script src="./javascript/bootstrap.min.js"></script>

    <script>
      function onSubmit(token) {
        // Do something with the token, such as submitting the form data to your server
        document.getElementById("myForm").submit();
      }
      grecaptcha.ready(function() {
        grecaptcha.execute('6LczX54lAAAAAFbt65LDoTrH7ZBHqmJS60Z1mn9W', {action: 'submit'}).then(function(token) {
          // Add the token to your form data and submit the form
          document.getElementById("myForm").addEventListener("submit", function(event) {
            event.preventDefault();
            document.getElementById("token").value = token;
            this.submit();
          });
        });
      });
    </script>

    <script>
      var _paq = window._paq = window._paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//www.gamersout.com/home/wwyawxwb/public_html/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>

    <script>
      var _paq = window._paq = window._paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//www.gamersout.com/home/wwyawxwb/public_html/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>

  </head>

<body>
  <div class="container-fluid tableborders">
      <div class="row">
          <div class="col-sm-12 purplecontainer text-center">
          <img src="img/gamersout3 (2).png" class="img-fluid" alt="Responsive image">
          </div>
      </div>
  </div>