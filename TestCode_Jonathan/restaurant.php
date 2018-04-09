<!-- 
  This code supports the website  DeepCan.com
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
  Last Updated: 2018-03-29
  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.
  Development History:
    2018-03-15 - Webpage code initiated.
    2018-03-20 - Webpage connected to main page.
    2018-03-30 - Retrieves array from previous page and incorporates information from the array into the page.
  Planned:
    - retreive reviews, ratings, and menu items based on the information received from previous page
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

    <!-- Header -->
    <header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
        <a href="index.php">
          <img src="images/test-logo.png" style="width:42px;height:42px;border:0;">
          Go Back <--
        </a>

      <!-- About Section -->
      <div class="w3-row w3-padding" id="about">
        <div class="w3-center">
         <img src="images/restaurant-icon-2.png" class="w3-round w3-image w3-opacity-min"  style="width:15%">

        </div>
        <div class="w3-row">
          <h1 class="w3-center"> <?php 
                                  echo $dataset[1];
                                  ?>
                                  </h1>
          <h5 class="w3-center"><?php
                                 echo "<a href='$dataset[3]'>$dataset[3]</a>";
                                 ?></h5><br>
        </div>
      </div>

    </header>

 


    <!-- Navbar -->
    <div class="w3-bar w3-padding w3-card w3-twothird">
      <div class="w3-container w3-theme-d3">
        <button class="w3-bar-item w3-button tablink w3-red w3-hover-red" onclick="openTab(event,'Reviews')">Reviews</button>
        <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'Menu')">Menu</button>
        <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'Locations')">Locations</button>
        <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'FavoriteRaters')">Favorite Raters</button>
      </div>


      <!-- Reviews Tab -->
      <div id="Reviews" class="w3-container w3-border tab">
       <?php 

          $CallingTab = "Reviews";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
        ?>
      </div>

      <!-- Menu Tab -->
      <div id="Menu" class="w3-container w3-border tab" style="display:none">
        <?php 

          $CallingTab = "Menu";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
          ?>

      </div>


      <!-- Locations Tab -->
      <div id="Locations" class="w3-container w3-border tab" style="display:none">
        <?php 

          $CallingTab = "Locations";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
          ?>
      </div>

      <!-- Favorite Raters Tab -->
      <div id="FavoriteRaters" class="w3-container w3-border tab" style="display:none">
        <?php 

          $CallingTab = "FavoriteRaters";

          #the php code in this page points to a seperate php file that peforms that actual search of the SQL database. 
          include 'restaurant_ratings.php';
          ?>
      </div>

    </div>

    <!-- Tab Selection -->
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

      <h1>Submit A Review</h1><br>
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
        <p><button class="w3-button w3-light-grey w3-section" type="submit" name= "submit_add_rating">SUBMIT REVIEW</button></p>
      </form>
  


        <!-- Submit An Item Review Section -->
        <br>
        <br>
        <img onclick="document.getElementById('add_item_rating').style.display='block'" class="w3-center w3-btn w3-circle" src="images/submit-icon-1.png" style="width:10%">
        Add a new Menu Item Review!

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
    


      <!-- Submit A Review Execution -->
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

      <!-- Submit An Item Review Execution -->
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

      <!-- Delete A Review Execution -->
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

      <!-- Delete A Menu Item Review Execution -->
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



    <!-- Footer -->
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
