<!-- 
  This code supports the website  DeepCan.com
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
    Last Updated: 2018-04-09

  Advisory:
      This website's development is ongoing. Experimental and non-functional features may result.

  Development History:
    2018-03-15 - Webpage code initiated.
    2018-03-20 - Webpage connected to main page.
    2018-03-30 - Retrieves array from previous page and incorporates information from the array into the page.
    2018-04-09 - Adjusted layout, added icons, displays queries

  Planned:
    - Create submission buttons to add ratings, locations, reviews etc.
-->



<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="w3.css" rel="stylesheet">
    <link href="w3-theme-red.css" rel="stylesheet">


<!-- Fetching Data from the previous page -->
  <?php 
  $dataset = $_GET['dataset'];
  $encoded_row = urldecode($_GET['dataset']);
  $dataset = json_decode($encoded_row);
  $encoded_dataset = json_encode($dataset);
  $encoded_dataset2 = urlencode($encoded_dataset);


  //setting date
  $date = date('Y-m-d');
  ?>

  <body>

    <!-- HHEADER -->
    <header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
        <a href="index.php">
          <img src="images/test-logo.png" style="width:42px;height:42px;border:0;">
          Go Back <--
        </a>

      <!-- ABOUT SECTION -->
      <div class="w3-row w3-padding" id="about">
        <div class="w3-center">
         <img src="images/restaurant-icon-2.png" class="w3-round w3-image w3-opacity-min"  style="width:15%">

        </div>
        <div class="w3-row">
          <h1 class="w3-center"> <?php 
                                  echo $dataset[1];
                                  ?> (A)
                                  </h1>
          <h5 class="w3-center"><?php
                                 echo "<a href='$dataset[3]'>$dataset[3]</a>";
                                 ?></h5><br>
        </div>
      </div>

    </header>

 


    <!-- NAVIGATION BAR -->
    <div class="w3-bar w3-padding w3-card w3-twothird">
      <div class="w3-container w3-theme-d3">
        <button class="w3-bar-item w3-button tablink w3-red w3-hover-red" onclick="openTab(event,'Reviews')">Reviews</button>
        <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'Menu')">Menu(B)</button>
        <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'Locations')">Locations(D)</button>
        <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'FavoriteRaters')">Favorite Raters(M)</button>
      </div>


      <!-- REVIEWS TAB -->
      <div id="Reviews" class="w3-container w3-border tab">
       <?php 

          $CallingTab = "Reviews";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
        ?>
      </div>

      <!-- MENU TAB -->
      <div id="Menu" class="w3-container w3-border tab" style="display:none">
        <?php 

          $CallingTab = "Menu";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
          ?>

          <br>
          <br>
          <img onclick="document.getElementById('add_menu_item').style.display='block'" class="w3-btn w3-circle" src="images/submit-icon-1.png" style="width:85px">
          Add a new MenuItem

          <!-- ADD NEW MENU ITEM POP-UP-->
          <!-- The contents of the 'add new menue item' pop-up -->
          <div id="add_menu_item" class="w3-modal">
            <div class="w3-modal-content w3-card-4">

                <!-- Header for the pop-up -->
                <header class="w3-container w3-theme-d1">
                    <!-- Button to close the pop -->
                    <span onclick="document.getElementById('add_menu_item').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <h2>
                      <img src="images/submit-icon-1.png" alt="Icon for submissions" style="width: 55px; height: 55px;">
                      Add Menu Item
                    </h2>
                </header>

                <!-- Main contents for the pop-up -->
                <!-- Form for user to enter new data with required fields -->
                <div class="w3-container">
                  <form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                    <div class="w3-section">
                      <label><b>Item Name</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_name" type="text" placeholder="Some Edible Food" required>
                      <label><b>Type</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_type" type="text" placeholder="food / feverage" required>
                      <label><b>Category</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_url" type="text" placeholder="starter / main / Ddessert" required>
                      <label><b>Price</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_url" type="text" placeholder="Some descriptive information" required>
                    </div>

                    <!-- Button to submit new data -->
                    <button class="w3-button w3-hover-shadow w3-round w3-theme" type="submit" name="submit_add_menu_item" value="submit_add_menu_item">Submit Menu Item</button>

                  </form>
                  <br>

                </div>
            </div>
          </div>

      </div>


      <!-- LOCATIONS TAB -->
      <div id="Locations" class="w3-container w3-border tab" style="display:none">
          <?php 

            $CallingTab = "Locations";

            #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
            include 'restaurant_ratings.php';
          ?>

          <br>
          <br>
          <img onclick="document.getElementById('add_location').style.display='block'" class="w3-btn w3-circle" src="images/submit-icon-1.png" style="width:85px">
          Add a new Location


          <!-- ADD NEW LOCATION POP-UP-->
          <!-- The contents of the 'add new location' pop-up -->
          <!-- To be display after a new restaurant has been entered -->
          <div id="add_location" class="w3-modal">
            <div class="w3-modal-content w3-card-4">

                <!-- Header for the pop-up -->
                <header class="w3-container w3-theme-d1">
                    <!-- Button to close the pop -->
                    <span onclick="document.getElementById('add_location').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <h2>
                      <img src="images/submit-icon-1.png" alt="Icon for submissions" style="width: 55px; height: 55px;">
                      Add Location
                    </h2>
                </header>

                <!-- Main contents for the pop-up -->
                <!-- Form for user to enter new data with required fields -->
                <div class="w3-container">
                  <form class="w3-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                    <div class="w3-section">
                      <p>Restaurants aren't virtual... yet</p>
                      <p>Please add a location for this restaurant</p>

                      <p>Somehow we expect you to know a lot about this place</p>

                      <label><b>First Open Date</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_name" type="text" placeholder="YYYY-MM-DD" required>
                      <label><b>Manager Name</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_type" type="text" placeholder="First Last" required>
                      <label><b>Phone Number</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_url" type="text" placeholder="555-555-5555" required>
                      <label><b>Street Address</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_url" type="text" placeholder="1234 Something Stree, Ottawa, ON, A1B 2C3" required>
                      <label><b>Opening Hour</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_url" type="text" placeholder="09:00" required>
                      <label><b>Closing Hour</b></label>
                      <input class="w3-input w3-border w3-margin-bottom" name="submit_add_restaurant_url" type="text" placeholder="21:00" required>
                    </div>

                    <!-- Button to submit new data -->
                    <button class="w3-button w3-hover-shadow w3-round w3-theme" type="submit" name="submit_add_location" value="submit_add_location">Submit Location</button>

                  </form>
                  <br>

                </div>
            </div>
          </div>


      </div>

      <!-- FAVOURITE RATERS TAB -->
      <div id="FavoriteRaters" class="w3-container w3-border tab" style="display:none">
        <?php 

          $CallingTab = "FavoriteRaters";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
          ?>
      </div>

    </div>

    <!-- TAB SELECTION SCRIPT -->
    <script>
    function openTab(evt, tabName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("tab");
      for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < x.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
      }
      document.getElementById(tabName).style.display = "block";
      evt.currentTarget.className += " w3-red";
    }
    </script>
  
  

    <!-- SUBMIT A REVIEW SECTION (RIGHT HAND SIDE OF PAGE) -->
    <div class="w3-container w3-third" id="AddReview">

      <h2><img src="images/review-icon-1.png" style="width:25%"> Review this Restaurant</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). '?'.http_build_query($_GET);?>" method="post">
        <p><input class="w3-input w3-padding-16" type="number" placeholder="1-5 rating for the price" min = '1' max = '5' required name="submit_add_rating_price"></p>
        <p><input class="w3-input w3-padding-16" type="number" placeholder="1-5 rating for the food" min = '1' max = '5' required name="submit_add_rating_food"></p>
        <p><input class="w3-input w3-padding-16" type="number" placeholder="1-5 rating for the mood" min = '1' max = '5' required name="submit_add_rating_mood"></p>
        <p><input class="w3-input w3-padding-16" type="number" placeholder="1-5 rating for the staff" min = '1' max = '5' required name="submit_add_rating_staff"></p>
        <input  type="text"  style="display:none" value=<?php 
                                          echo $dataset[0]
                                          ?>  name= "submit_add_rating_res_id">
        <p><input class="w3-input w3-padding-16" type="text" placeholder="Comment" required name="submit_add_rating_comment"></p>

        <!-- Button to submit Review -->
        <p><button class="w3-button w3-theme w3-section" type="submit" name= "submit_add_rating">SUBMIT REVIEW</button></p>
      </form>
  


        <!-- ADD BUTTONS-->
        <br>
        <br>
        <img onclick="document.getElementById('add_item_rating').style.display='block'" class="w3-btn w3-circle" src="images/submit-icon-1.png" style="width:25%">
        Add a Menu Item!

              <!-- ADD NEW RESTAURANT POP-UP-->
              <!-- The contents of the 'add new restaurant' pop-up -->
              <div id="add_item_rating" class="w3-modal">
                <div class="w3-modal-content w3-card-4">

                    <!-- Header for the 'add restaurant' pop-up -->
                    <header class="w3-container w3-theme-d1">
                        <!-- Button to close the pop -->
                        <span onclick="document.getElementById('add_item_rating').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        <h2>
                          <img src="images/submit-icon-1.png" alt="Icon for submissions" style="width: 55px; height: 55px;">
                          Add Item Review
                        </h2>
                    </header>

                    <!-- Main contents for the 'add restaurant' pop-up -->
                    <!-- Form for user to enter new restaurant data with required fields -->
                    <div class="w3-container">
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). '?'.http_build_query($_GET);?>" method="post">

                        <div class="w3-section">
                          <label><b>Rating</b></label>
                          <input class="w3-input w3-border w3-margin-bottom" name="submit_add_rating_item_rating" type="number" min = '1' max = '5' placeholder="enter 1-5 rating "  required>
                          <label><b>Comment</b></label>
                          <input class="w3-input w3-border w3-margin-bottom" name="submit_add_rating_item_comment" type="text" placeholder="enter comment"  required>
                          <label><b>Item Name</b></label>
                          <input class="w3-input w3-border w3-margin-bottom" name="submit_add_rating_item_name" type="text" placeholder="enter item name"  required>
                          
                        </div>

                        <!-- Button to submit new restaurant data -->
                        <button class="w3-button w3-hover-shadow w3-round w3-theme" type="submit" name="submit_add_item_rating" value="submit_add_item_rating">Submit Rating</button>

                      </form>
                      <br>

                    </div>
                </div>
              </div>
    


      <!-- SUBMIT A REVIEW EXECUTION -->
      <?php 
        #the php code in this page points to a seperate php file that contains the code that perfoms the search of the SQL database. 

        #As the code of the seperate file is 'included' with this page any code/variables declared here will be combined with the code of the seperate php file. Variables to do not need to be passed explicitely.
        $callingPage = "restaurant";


        #Change the variable depending on what button was lasted pressed
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST[submit_add_rating])){
          $callingButton = "submit_add_rating";
        }



        #In this way we can recylce the search handler.
        include 'handle_insertion.php';

      ?>

      <!-- SUBMIT AN ITEM Review EXECUTION -->
      <?php 
        #the php code in this page points to a seperate php file that contains the code that perfoms the search of the SQL database. 

        #As the code of the seperate file is 'included' with this page any code/variables declared here will be combined with the code of the seperate php file. Variables to do not need to be passed explicitely.
        $callingPage = "restaurant";


        #Change the variable depending on what button was lasted pressed
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST[submit_add_item_rating])){
          $callingButton = "submit_add_item_rating";
        }



        #In this way we can recylce the search handler.
        include 'handle_insertion.php';

      ?>

      <!-- DELETE A REVIEW EXECUTION -->
      <?php 
        #the php code in this page points to a seperate php file that contains the code that perfoms the search of the SQL database. 

        #As the code of the seperate file is 'included' with this page any code/variables declared here will be combined with the code of the seperate php file. Variables to do not need to be passed explicitely.
        $callingPage = "restaurant";


        #Change the variable depending on what button was lasted pressed
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST[submit_delete_rating])){
          $callingButton = "submit_delete_rating";

        }



        #In this way we can recylce the search handler.
        include 'handle_insertion.php';

      ?>

      <!-- DELETE A MENU ITEM REVIEW EXECUTION -->
      <?php 
        #the php code in this page points to a seperate php file that contains the code that perfoms the search of the SQL database. 

        #As the code of the seperate file is 'included' with this page any code/variables declared here will be combined with the code of the seperate php file. Variables to do not need to be passed explicitely.
        $callingPage = "restaurant";


        #Change the variable depending on what button was lasted pressed
        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST[submit_delete_item_rating])){
          $callingButton = "submit_delete_item_rating";



        }



        #In this way we can recylce the search handler.
        include 'handle_insertion.php';

      ?>

    <!--End of Submit a Review Section -->
    </div>



    <!-- FOOTER -->
    <div class="w3-row w3-container"> 
      <footer class="w3-container w3-center w3-theme">
        <h5>Copyright &copy; DeepCan.com</h5>
        <p class="w3-opacity">Jonathan Calles (8906650) and Ahmed Haj Abdel Khaleq (8223727)</p>
      </footer>
    </div>

    <!-- SEARCH FILTERS ACCORDION -->
    <!-- This javascript supports the toggling of showing/hiding the accordion with the filter opens. By changing the text in the HTML to include or remove "w3-show" it hides or shows the accordion contents. -->
    <!-- 
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
    -->

  </body>
</html>
