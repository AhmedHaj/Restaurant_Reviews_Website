<!-- 
	This code supports the website  DeepCan.com
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
	Last Updated: 2018-03-29

  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.

	Development History:
		2018-03-15 - Webpage code initiated
    2018-03-15 - HTML search query form created, and linked to php code
    2018-03-16 - Succesful proof of concept HTML->PHP->SQL->ServerDatabase->PHP->HTML
    2018-03-18 - HTML reworked to use the W3 CSS, Credit: www.w3schools.com
    2018-03-18 - Navigation bar added, styled search bar added planned to replace static search form
    2018-03-19 - Connected index.html to raters.html, Added star ratings to restaurants results list
    2018-03-19 - Changed the left panel to W3 sidebar that can be toggled. Nav bar now highlights selected page.
    2018-03-20 - Removed sidebar altogether in favour of accordion with filter options.
    2018-03-20 - The W3 search is now connected to the PHP code.
    2018-03-29 - Changed file extension .html -> .php. 
    2018-03-29 - Main body now contains dynamic content generated by PHP file that retrieves the search results.

  Planned:
    -Filters Accordian
        -Have selected search filters applied to PHP SQL search query
    -individual restraurant page(s)
    -make the search results generated clickable to open distinct pages
    -reviews and ratings page

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
    <link href="w3-theme-red.css" rel="stylesheet">
  </head>


  <body>

    <!-- HEADER -->
    <!-- The contents at the header of the webpage -->
    <header class="w3-container w3-padding" id="mainHeader">
        <div class="w3-center">
          <h1>Deep Can</h1>
              <img src="images/test-logo.png" alt="Test logo for Image loading" style="width: 120px; height: 120px;">
          <h2>Restaurant Reviews</h2>
        </div>
    </header>



    <!-- NAVIGATION BAR -->
    <!-- The contents of the navigation bar under the Header -->
    <div class="w3-bar w3-card w3-theme-d3" style="height:100%">
      <a href="index.html" class="w3-bar-item w3-button w3-padding-16 w3-theme-d1">Home</a>
      <a href="insert URL here" class="w3-bar-item w3-button w3-padding-16">Top Rated</a>
      <a href="raters.html" class="w3-bar-item w3-button w3-padding-16">Raters</a>
      <a href="restaurant.html" class="w3-bar-item w3-button w3-padding-16">Restaurant</a>
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
        <label class="w3-text-red"><b>Looking for something?</b></label>
            <input class="w3-input w3-border w3-animate-input w3-hover-light-grey" name="searchText" type="text" style="width:30%" placeholder="connected to the PHP">
            <button class="w3-btn w3-theme">Search</button>
      </form>

      <!-- SEARCH FILTERS -->
      <!-- An accordion which displays optional filters that can be applied to the search. -->
      <br>
      <button onclick="myFunction('filters')" class="w3-btn w3-block w3-theme w3-left-align">Filters Options</button>
      <div id="filters" class="w3-container w3-hide">
        <input class="w3-check" type="checkbox" checked="checked">
        <label>Option 1</label>
        <input class="w3-check" type="checkbox" checked="checked">
        <label>Option 2</label>
        <input class="w3-check" type="checkbox" checked="checked">
        <label>Option 3</label>
      </div>
      <br>

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
        include 'handle_search_2.php';
      ?>

    </div>


    <!-- FOOTER -->
    <!-- The contents of the footer at the bottom of the webpage -->
    <footer class="w3-container w3-center w3-theme">
      <h5>Copyright &copy; DeepCan.com</h5>
      <p class="w3-opacity">Jonathan Calles (8906650) and Ahmed Haj Abdel Khaleq (8223727)</p>
    </footer>


    <!-- SEARCH FILTERS ACCORDIAN -->
    <!-- This javascript supports the toggling of showing/hiding the accordion with the filter opens. By changing the text in the HTML to include or remove "w3-show" it hides or shows the accordion contents. -->
    <script>
    function myFunction(id){
        var x = document.getElementById(id);
        if(x.className.indexOf("w3-show") == -1){
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
    </script>


  </body>


</html>