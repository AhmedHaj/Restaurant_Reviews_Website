<!-- 
	This code supports the website  DeepCan.com
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
	Last Updated: 2018-04-06

  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.

	Development History:
		2018-04-06 - Webpage code initiated, templated from index.php


  Planned:
    -Provide platform for SQL queries related to top rated restaurants and food items

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
    <link href="w3-theme-green.css" rel="stylesheet">
  </head>


  <body>

    <!-- HEADER -->
    <!-- The contents at the header of the webpage -->
    <header class="w3-container w3-padding" id="mainHeader">
        <div class="w3-center">
          <h1>Deep Can</h1>
              <img src="images/test-logo.png" alt="Test logo for Image loading" style="width: 120px; height: 120px;">
          <h2>Top Rated</h2>
        </div>
    </header>


    <!-- NAVIGATION BAR -->
    <!-- The contents of the navigation bar under the Header -->
    <div class="w3-bar w3-card w3-theme-d3" style="height:100%">
      <a href="index.php" class="w3-bar-item w3-button w3-padding-16">Home</a>
      <a href="insert URL here" class="w3-bar-item w3-button w3-padding-16 w3-theme">Top Rated</a>
      <a href="raters.php" class="w3-bar-item w3-button w3-padding-16">Raters</a>
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

      
      <!-- CATEGORIES -->
      <!-- Selection of predetermined categories of top-rated: restaurants, food items, raters, etc. -->
      <br>
      <div class="w3-bar w3-card w3-theme-d1" style="height:100%">
        <a href="index.php" class="w3-bar-item w3-button w3-padding-16">Restaurants</a>
        <a href="insert URL here" class="w3-bar-item w3-button w3-padding-16">Food Items</a>
        <a href="raters.php" class="w3-bar-item w3-button w3-padding-16">Raters</a>
        <a href="restaurant.php" class="w3-bar-item w3-button w3-padding-16">Most Searched</a>
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

      <h2>This page could potentially query and display the top rated things by categories</h2> <!--TEMP COMMENT -->

    </div>

  
    <!-- DYNAMIC CONTENT -->
    <!-- The main contents below the Static Body Content which is generated dynamically, as a result of searchers and user input. Dynamic content should be generated using PHP and the results of SQL queries -->
    <div class="w3-row w3-container" id="main">   

      <!-- RESULTS LIST -->
      <!-- The results of searching the database will be displayed here -->
      <label class="w3-text-red"><b>Search results that match your query:</b></label>
      <?php 
        #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
        #In this way we can recylce the search handler.
        include 'handle_search.php';
      ?>

    </div>


    <!-- FOOTER -->
    <!-- The contents of the footer at the bottom of the webpage -->
    <footer class="w3-container w3-center w3-theme">
      <h5>Copyright &copy; DeepCan.com</h5>
      <p class="w3-opacity">Jonathan Calles (8906650) and Ahmed Haj Abdel Khaleq (8223727)</p>
    </footer>


  </body>


</html>