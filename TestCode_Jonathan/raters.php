<!-- 
  This code supports the website  DeepCan.com
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
  Last Updated: 2018-04-06

  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.

  Development History:
    2018-03-19 - Connected index.html to raters.html, Added icons for the raters results list
    2018-03-19 - Nav bar now highlights selected page. Added additional dummy icons for raters.
    2018-03-29 - Updated Nav Bar link, index.html -> index.php
    2018-04-06 - Change this file from .html -> .php, updated code to match look and feel

  Planned:
    -Should generate queries appropriate for raters

-->


<!doctype html>
<html>

  <!-- CONFIGURATIONS -->
  <head>

    <!-- A meta viewport gives the browser instructions on how to control the page's dimensions and scaling. i.e. when viewed on different types of devices -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  	<!-- This code points to a seperate CSS files which contains all the styling rules for the webpage aesthetics -->
    <link href="w3.css" rel="stylesheet">
    <link href="w3-theme-indigo.css" rel="stylesheet">
  </head>


  <body>

    <!-- HEADER -->
    <!-- The contents at the header of the webpage -->
    <header class="w3-container w3-padding" id="mainHeader">
        <div class="w3-center">
          <h1>Deep Can</h1>
              <img src="images/test-logo.png" alt="Test logo for Image loading" style="width: 120px; height: 120px;">
          <h2>Raters</h2>
        </div>
    </header>


    <!-- NAVBAR -->
    <!-- The contents of the navigation bar under the header -->
    <div class="w3-bar w3-card w3-theme-d3" style="height:100%">
      <a href="index.php" class="w3-bar-item w3-button w3-padding-16">Home</a>
      <a href="top_rated.php" class="w3-bar-item w3-button w3-padding-16">Top Rated</a>
      <a href="raters.php" class="w3-bar-item w3-button w3-padding-16 w3-theme-l1">Raters</a>
      <a href="restaurant.php" class="w3-bar-item w3-button w3-padding-16">Restaurant</a>
      <div class="w3-dropdown-hover">
        <button class="w3-button w3-padding-16">
            Dropdown
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="w3-dropdown-content w3-card-4 w3-bar-block">
            <a href="insert javascript or url here" class="w3-bar-item w3-button">Link 1</a>
            <a href="insert javascript or url here" class="w3-bar-item w3-button">Link 2</a>
            <a href="insert javascript or url here" class="w3-bar-item w3-button">Link 3</a>
        </div>
      </div>
    </div>
   
      

    <!-- STATIC BODY CONTENT-->
    <!-- The main contents below the Navigation Bar which is always displayed on the page -->
    <div class="w3-container">

      <!-- SEARCH BAR -->
      <!-- Here is the search form for user input, pressing the "search" button calls the php code within this same page (action="...$_SERVER["PHP_SELF"]);?>"). References in the PHP by the tag "searchText" -->
      <form class="w3-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <br>
        <label class="w3-text-blue"><b>Looking for someone?</b></label>
            <input class="w3-input w3-border w3-animate-input w3-hover-light-grey" name="searchText" type="text" style="width:30%" placeholder="connected to the PHP">
            <button class="w3-btn w3-theme">Search</button>
      </form>

      <h3> This page probably doesn't need search filters</h3>

    </div>


    <!-- DYNAMIC CONTENT -->
    <!-- The main contents below the Static Body Content which is generated dynamically, as a result of searchers and user input. Dynamic content should be generated using PHP and the results of SQL queries -->
    <div class="w3-row w3-container" id="main">   

      <!-- SAMPLE RESULTS LIST -->
      <!-- This a SAMPLE of the proposed format for the the results list, this would have to generated in the PHP code using the results of the SQL query -->
      <label class="w3-text-indigo"><b>Search results could look something like this:</b></label>
      <li class="w3-bar">
          <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
          <img src="images/rater-004.png" class="w3-bar-item w3 circle" style="width:85px">
          <div class="w3-bar-item">
              <span class="w3-large">William</span><br>
              <span>Too much free time on his hands</span>
          </div>
      </li>
      <li class="w3-bar">
          <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
          <img src="images/rater-003.png" class="w3-bar-item w3 circle" style="width:85px">
          <div class="w3-bar-item">
              <span class="w3-large">Mary</span><br>
              <span>Food Junkie</span>
          </div>
      </li>
      <li class="w3-bar">
          <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
          <img src="images/rater-002.png" class="w3-bar-item w3 circle" style="width:85px">
          <div class="w3-bar-item">
              <span class="w3-large">Bob</span><br>
              <span>Self-proclaimed food critic</span>
          </div>
      </li>
      <li class="w3-bar">
          <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
          <img src="images/rater-001.png" class="w3-bar-item w3 circle" style="width:85px">
          <div class="w3-bar-item">
              <span class="w3-large">William</span><br>
              <span>Too much free time on his hands</span>
          </div>
      </li>
      <li class="w3-bar">
          <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
          <img src="images/test-avatar.png" class="w3-bar-item w3 circle" style="width:85px">
          <div class="w3-bar-item">
              <span class="w3-large">Mary</span><br>
              <span>Food Junkie</span>
          </div>
      </li>
      <li class="w3-bar">
          <span onclick="this.parentElement.style.display='none'" class="w3-bar-item w3-button w3-xlarge w3-right">&times;</span>
          <img src="images/test-avatar.png" class="w3-bar-item w3 circle" style="width:85px">
          <div class="w3-bar-item">
              <span class="w3-large">Bob</span><br>
              <span>Self-proclaimed food critic</span>
          </div>
      </li>

    </div>


    <!-- FOOTER -->
    <!-- The contents of the footer at the bottom of the webpage -->
    <footer class="w3-container w3-center w3-theme">
      <h5>Copyright &copy; DeepCan.com</h5>
      <p class="w3-opacity">Jonathan Calles (8906650) and Ahmed Haj Abdel Khaleq (8223727)</p>
    </footer>


  </body>


</html>