<!-- 
	This code supports the website  DeepCan.com
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
	   Last Updated: 2018-04-09

  Advisory:
      This website's development is ongoing. Experimental and non-functional features may result.

	Development History:
		2018-04-06 - Webpage code initiated, templated from index.php
    2018-04-08 - Adjusted layout, added inner tabs, added buttons to add ratings/reviews.
    2018-04-08 - Added log in/out button, toggles a pop-up with further profile options.
    2018-04-09 - Inner tabs display different content relate to diferrent rankings.


  Planned:
    - Incorporate requirement queries in a meaningful way to the UI.

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

        <!-- LOG IN/OUT POP-UP -->
        <!-- A pop up interface with options to log out/in, and change profile settings -->

              <!-- The button which toggles the pop-up -->
              <button onclick="document.getElementById('profile_login').style.display='block'" class="w3-button w3-display-topright w3-padding" style="width:150px" >
                    LOG OUT/IN
                    <img src="images/rater-001.png" style="width:35px">
              </button>

              <!-- The contents of the log out/in pop-up -->
              <div id="profile_login" class="w3-modal">
                <div class="w3-modal-content w3-card-4">

                    <!-- Header for the log out/in pop-up -->
                    <header class="w3-container w3-theme-d1">
                        <!-- Button to close the pop -->
                        <span onclick="document.getElementById('profile_login').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <h2>Your Profile</h2>
                    </header>

                    <!-- Main contents of the log out/in pop-up -->
                    <div class="w3-container">
                      <br>
                      <img src="images/rater-001.png" style="width:80px">
                      <p> You are currently logged in as: <b>William</b></p>

                      <!-- Button to log out -->
                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                        <button class="w3-button w3-hover-shadow w3-round w3-theme" name="log_out" value="log_out">Log Out</button>
                      </form>
                      <br>
                    </div>


                </div>
              </div>


        <!-- Website name and logo as a main centre piece -->
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
      <a href="top_rated.php" class="w3-bar-item w3-button w3-padding-16 w3-theme">Top Rated</a>
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
   
    


    <!-- STATIC BODY CONTENT LEFT-->
    <!-- The main contents below the Navigation Bar which is always displayed on the page -->
    <div class="w3-container w3-twothird">


      <!-- INNER NAVIGATION TAB -->
      <div class="w3-bar w3-padding w3-card">
        <div class="w3-container w3-theme-d3">
          <button class="w3-bar-item w3-button tablink w3-theme" onclick="openTab(event,'top_in_category')">Top in Category (J)</button>
          <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'best_overall')">Best Overall</button>
          <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'most_reviewed')">Most Reviewed (F)</button>
        </div>


        <!-- CONTROL OF INNER NAVIGATION TAB -->
        <script>
        function openTab(evt, tabName) {
          var i, x, tablinks;
          x = document.getElementsByClassName("tab");
          for (i = 0; i < x.length; i++) {
              x[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablink");
          for (i = 0; i < x.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" w3-theme", "");
          }
          document.getElementById(tabName).style.display = "block";
          evt.currentTarget.className += " w3-theme";
        }
        </script>


        <!-- TOP IN CATEGORY TAB -->
        <div id="top_in_category" class="w3-container w3-border tab">

            <form class="w3-container" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <select class="w3-select" name="category">
                    <option value="" disabled selected>Choose a category</option>
                    <option value="best_in_price">Best in Price</option>
                    <option value="best_in_food">Best in Food</option>
                    <option value="best_in_mood">Best in Mood</option>
                    <option value="best_in_staff">Best in Staff</option>
                </select>
                <button class="w3-button w3-hover-shadow w3-round w3-theme">Find Out!</button>
            </form>

            <?php 
              #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
              #In this way we can recylce the search handler.
              $callingPage = "top_rated";
              $callingTab = "top_in_category";
              $callingButton = "x";

              #Set the variables when an input is 
              if($_SERVER['REQUEST_METHOD'] == "GET"){
                $callingCategory = "";
                $callingCategory = test_input($_GET[category]);
              }

              #Cleans up the value before using as variable
              function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }

              include 'handle_search.php';
              
            ?>
        </div>



        <!-- BEST OVERALL TAB -->
        <div id="best_overall" class="w3-container w3-border tab" style="display:none">
          some text
         <?php 
              #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
              $callingPage = "top_rated";
              $callingTab = "best_overall";
              $callingButton = "x";

              #In this way we can recylce the search handler.
              include 'handle_search.php';
          ?>
        </div>


        <!-- MOST REVIEWED TAB -->
        <div id="most_reviewed" class="w3-container w3-border tab" style="display:none">
          <?php 
              #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
              #In this way we can recylce the search handler.
              $callingPage = "top_rated";
              $callingTab = "most_reviewed";
              $callingButton = "x";
              include 'handle_search.php';
          ?>
        </div>

      </div>




      <h2>The following queries comply with the requirements under <u>Ratings of Restuarants</u></h2> <!--TEMP COMMENT -->
      <!-- TEMP BUTTONS -->
      <!-- Proof of concept, button presses change PHP variables to be used in the search handler switch case -->
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
          <button class="w3-button w3-hover-shadow w3-round w3-theme" name=test_button_g>G</button>
          <button class="w3-button w3-hover-shadow w3-round w3-theme" name=test_button_h>H</button>
          <button class="w3-button w3-hover-shadow w3-round w3-theme" name=test_button_i>I</button>
      </form>



      <!-- DYNAMIC CONTENT -->
      <!-- The main contents below the Static Body Content which is generated dynamically, as a result of searchers and user input. Dynamic content should be generated using PHP and the results of SQL queries -->

          <!-- RESULTS LIST -->
          <!-- The results of searching the database will be displayed here -->
          <label class="w3-text-red"><b>Search results that match your query:</b></label>

          <?php 
            #the php code in this page points to a seperate php file that contains the code that perfoms the search of the SQL database. 

            #As the code of the seperate file is 'included' with this page any code/variables declared here will be combined with the code of the seperate php file. Variables to do not need to be passed explicitely.
            $callingPage = "top_rated";

            #Change the variable depending on what button was lasted pressed
            if($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET[test_button_g])){
              $callingButton = "test_button_g";
            }
            if($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET[test_button_h])){
              $callingButton = "test_button_h";
            }
            if($_SERVER['REQUEST_METHOD'] == "GET" and isset($_GET[test_button_i])){
              $callingButton = "test_button_i";
            }

            #In this way we can recylce the search handler.
            include 'handle_search.php';
          ?>

    </div>


    <!-- STATIC BODY CONTENT RIGHT-->
    <!-- The main contents below the Navigation Bar which is always displayed on the page -->
    <div class="w3-container w3-third">

        <br>
        <img class="w3-center" src="images/star.png" style="width:15%">
        <img class="w3-center" src="images/star.png" style="width:15%">
        <img class="w3-center" src="images/star.png" style="width:15%">
        <img class="w3-center" src="images/star.png" style="width:15%">
        <img class="w3-center" src="images/star.png" style="width:15%">

        <br>
        <br>
        <button class="w3-button w3-xlarge w3-circle w3-theme">+</button>
        ADD a rating
        <br>
        <br>
        <button class="w3-button w3-xlarge w3-circle w3-theme">+</button>
        ADD a rating
        <br>
        <br>
        <img class="w3-center w3-btn w3-circle" src="images/review-icon-1.png" style="width:25%">
        ADD a rating
        <br>
        <br>
        <img class="w3-center w3-btn w3-circle" src="images/review-icon-2.png" style="width:25%">
        WRITE a review

        <!-- TEST BUTTONS -->
        <!-- Proof of concept, button presses change PHP variables to be used in the search handler switch case -->
        <br>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
            <button class="w3-button w3-hover-shadow w3-round w3-theme" name="test_button_1" value="test_button_1">Button_1</button>
            <button class="w3-button w3-hover-shadow w3-round w3-theme" name="test_button_2" value="test_button_2">Button_2</button>
        </form>
        <br>
    </div>



    <!-- FOOTER -->
    <!-- The contents of the footer at the bottom of the webpage -->
    <div class="w3-row w3-container">  
      <footer class="w3-container w3-center w3-theme">
        <h5>Copyright &copy; DeepCan.com</h5>
        <p class="w3-opacity">Jonathan Calles (8906650) and Ahmed Haj Abdel Khaleq (8223727)</p>
      </footer>
    </div>


  </body>


</html>