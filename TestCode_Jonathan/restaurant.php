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
  ?>

<body>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
  <a href="index.php">
  <img src="images/test-logo.png" alt="HTML tutorial" style="width:42px;height:42px;border:0;">
</a>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px">

  <!-- About Section -->
  <div class="w3-row w3-padding-64" id="about">
    <div class="w3-col m6 w3-padding-large w3-hide-small">
     <img src="images/test-logo.png" class="w3-round w3-image w3-opacity-min" alt="Table Setting" width="600" height="750">
    </div>
    <div class="w3-col m6 w3-padding-large">
      <h1 class="w3-center"> <?php 
                              echo $dataset[1] 
                              ?>
                              </h1><br>
      <h5 class="w3-center">{Opening Date}</h5>
      <p class="w3-large">The Catering was founded in blabla by Mr. Smith in lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute iruredolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.We only use <span class="w3-tag w3-light-grey">seasonal</span> ingredients.</p>
      <p class="w3-large w3-text-grey w3-hide-medium">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod temporincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
  </div>
  

  <!-- Navbar -->
  <div class="w3-bar w3-padding w3-card">
   <div class="w3-container w3-theme-d3">
    <button class="w3-bar-item w3-button tablink w3-red w3-hover-red" onclick="openTab(event,'Reviews')">Reviews</button>
    <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'Menu')">Menu</button>
    <button class="w3-bar-item w3-button tablink w3-hover-red" onclick="openTab(event,'Contact')">Contact</button>
  </div>


  <!-- Reviews Tab -->
  <div id="Reviews" class="w3-container w3-border city">
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

  <!-- Menu Tab -->
  <div id="Menu" class="w3-container w3-border city" style="display:none">
    <h1 class="w3-center">Our Menu</h1><br>
      <h4>Bread Basket</h4>
      <p class="w3-text-grey">Assortment of fresh baked fruit breads and muffins 5.50</p><br>
    
      <h4>Honey Almond Granola with Fruits</h4>
      <p class="w3-text-grey">Natural cereal of honey toasted oats, raisins, almonds and dates 7.00</p><br>
    
      <h4>Belgian Waffle</h4>
      <p class="w3-text-grey">Vanilla flavored batter with malted flour 7.50</p><br>
    
      <h4>Scrambled eggs</h4>
      <p class="w3-text-grey">Scrambled eggs, roasted red pepper and garlic, with green onions 7.50</p><br>
    
      <h4>Blueberry Pancakes</h4>
      <p class="w3-text-grey">With syrup, butter and lots of berries 8.50</p>
  </div>


  <!-- Contact Tab -->
  <div id="Contact" class="w3-container w3-border city" style="display:none">
    <p>We offer full-service catering for any event, large or small. We understand your needs and we will cater the food to satisfy the biggerst criteria of them all, both look and taste. Do not hesitate to contact us.</p>
    <p class="w3-text-blue-grey w3-large"><b>Catering Service, 42nd Living St, 43043 New York, NY</b></p>
    <p>You can also contact us by phone 00553123-2323 or email catering@catering.com, or you can send us a message here:</p>
  </div>
</div>

<!-- Tab Selection -->
<script>
function openTab(evt, tabName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
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
  
  

  <!-- Contact Section -->
  <div class="w3-container w3-padding-64" id="contact">
    <h1>Contact</h1><br>
    <p>We offer full-service catering for any event, large or small. We understand your needs and we will cater the food to satisfy the biggerst criteria of them all, both look and taste. Do not hesitate to contact us.</p>
    <p class="w3-text-blue-grey w3-large"><b>Catering Service, 42nd Living St, 43043 New York, NY</b></p>
    <p>You can also contact us by phone 00553123-2323 or email catering@catering.com, or you can send us a message here:</p>
    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-padding-16" type="number" placeholder="How many people" required name="People"></p>
      <p><input class="w3-input w3-padding-16" type="datetime-local" placeholder="Date and time" required name="date" value="2017-11-16T20:00"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Message \ Special requirements" required name="Message"></p>
      <p><button class="w3-button w3-light-grey w3-section" type="submit">SEND MESSAGE</button></p>
    </form>
  </div>
  
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-center w3-theme">
  <h5>Copyright &copy; DeepCan.com</h5>
  <p class="w3-opacity">Jonathan Calles (8906650) and Ahmed Haj Abdel Khaleq (8223727)</p>
</footer>

</body>
</html>
