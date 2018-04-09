<!-- 
	This code supports the website  DeepCan.com
	This php code is based on handle_search.php, as it stands, will retrieve ratings for the restaurant that is currently being viewed. 
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
	Last Updated: 2018-03-31
  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.
	Development History:
	    2018-03-31 - Linked to SQL
	    2018-04-08 - Integrated restaurant-related Queries


-->

		<?php #this php code receives the search term as input from the user, searches the database, and generates the results.
		//Create variables for connection information to connect to the database
		//Edit these variables according to your local server environment
		$port="XXXX";
		$database="XXXX";
		$username="XXXX";
		$password="XXXX";
		
		
		//open a connection to the Postgre database on the slocal server, using the connection information
		$databaseconnection = pg_connect("host=localhost port=$port dbname=$database user=$username password=$password");
	
		//Here is an if/else to prove that we can generate HTML code using PHP depending on variables such as user input


			//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
			//http://php.net/manual/en/function.pg-escape-string.php
			$escapedinput = pg_escape_string($dataset[0]);

			//Perform different SQL queries and html outputs depending on the context
			//Reference: http://php.net/manual/en/control-structures.switch.php
			switch (true) {

				case ($CallingTab == "Reviews"):


					//create query statements that will be executed. 
					//Can use PHP variables, but note the {} that need to go around the PHP variables
					$query = "SELECT * FROM rating M WHERE M.restaurantID = '{$escapedinput}'";

				
					//execute the query
					$results = pg_query($databaseconnection, $query);
						//RAW OUTPUT 1 - PRINT AS ARRAY
						//For testing, and understanding of what is actually retrieved:
						//convert the rows from the result into a 2D array, then print the array
						$arr = pg_fetch_all($results);

						//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
						if(empty($arr)){
							echo "<p><b> Error - No results matching your query </b></p>";
							echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
						}
					
				
						//dynamically generate an HTML formatted list by looping through results. 
						//leverages the dimensions of $results as variables, picks out specific data points. In this example the menu item names and descriptions.
						$num_rows = pg_numrows($results);
						$num_cols = pg_numfields($results);
						for ($i=0; $i<$num_rows; $i++){

							// fetches and encodes the row so that it can be passed onto the restaurant page
							$row = pg_fetch_row($results, $i);
							$val_name = $row[0];

							//second query to retrieve the name of the rater
							$escapedinput2 = pg_escape_string($val_name);
							$rater_query = "SELECT * FROM rater R WHERE R.userID = '{$escapedinput2}'";
							$rater_result = pg_query($databaseconnection, $rater_query);
							$rater = pg_fetch_array($rater_result, 0, PGSQL_NUM);
							$rater_name = $rater[2];

							//for loop to produce html code that represents the price rating as stars
							$price_rating = "";
							for($k=0; $k<$row[2]; $k++){

								$price_rating = $price_rating."\n<img src='images/star.png' style='width:15px'>";
							}


							$food_rating = "";
							for($k=0; $k<$row[3]; $k++){

								$food_rating = $food_rating."\n<img src='images/star.png' style='width:15px'>";
							}
							
							$mood_rating = "";
							for($k=0; $k<$row[4]; $k++){

								$mood_rating = $mood_rating."\n<img src='images/star.png' style='width:15px'>";
							}

							$staff_rating = "";
							for($k=0; $k<$row[5]; $k++){

								$staff_rating = $staff_rating."\n<img src='images/star.png' style='width:15px'>";
							}

							
							$val_description = $row[6];
							if($row[0] == "RA02"){

								
							
								echo "<p>
									<li class='w3-bar' style = 'list-style-type:none'>
										<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]). '?'. http_build_query($_GET) . "'> 
							          		<input type='text' style='display:none' name='submit_delete_rating_id' value=$row[0]> 
							          		<input type='text' style='display:none' name='submit_delete_rating_date' value=$row[1]>
							          		<button class='w3-bar-item w3-button w3-xlarge w3-right' name = 'submit_delete_rating' type = 'submit'>&times;</button>
							          	</form>

							          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
							          	<div class='w3-bar-item'>
							             	<span class='w3-large'>$rater_name</span>
							             	<br>
							             	<span>price: </span>
							              	$price_rating
							              	<br>
							              	<span>food: </span>
							              	$food_rating
							              	<br>
							              	<span>mood: </span>
							              	$mood_rating
							              	<br>
							              	<span>staff: </span>
							              	$staff_rating
							              	<br>
							              	<span>$val_description</span>
							              	<br>
								            <h6>$row[1]</h6>
					          		   	</div>
					          			</a>
					      			</li>
					      		</p>";
							} else {

								echo "<form><p>
									<li class='w3-bar' style = 'list-style-type:none'>
									
							          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
							          	<div class='w3-bar-item'>
							             	<span class='w3-large'>$rater_name</span>
							             	<br>
							             	<span>price: </span>
							              	$price_rating
							              	<br>
							              	<span>food: </span>
							              	$food_rating
							              	<br>
							              	<span>mood: </span>
							              	$mood_rating
							              	<br>
							              	<span>staff: </span>
							              	$staff_rating
							              	<br>
							              	<span>$val_description</span>
							              	<br>
								            <h6>$row[1]</h6>
					          		   	</div>
					          			</a>
					      			</li>
					      		</p>
					      		</form>";

							}
						}
							break;

				case($CallingTab == "Menu"):

					//create query statements that will be executed. 
					//Can use PHP variables, but note the {} that need to go around the PHP variables
					$query = "SELECT itemid, name, description, price, category, type
							  FROM menuitem 
							  WHERE restaurantid = '{$escapedinput}' 
							  ORDER BY category DESC" ;

				
					//execute the query
					$results = pg_query($databaseconnection, $query);
						//RAW OUTPUT 1 - PRINT AS ARRAY
						//For testing, and understanding of what is actually retrieved:
						//convert the rows from the result into a 2D array, then print the array
						$arr = pg_fetch_all($results);

						//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
						if(empty($arr)){
							echo "<p><b> Error - No results matching your query </b></p>";
							echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
						}
					
				
						//dynamically generate an HTML formatted list by looping through results. 
						//leverages the dimensions of $results as variables, picks out specific data points. In this example the menu item names and descriptions.
						$num_rows = pg_numrows($results);
						$num_cols = pg_numfields($results);
						for ($i=0; $i<$num_rows; $i++){
							
							//initializing the string inside the accordion to an empty string
							$ratinghtmlcode = "";

							// fetches and encodes the row so that it can be passed onto the restaurant page
							$row = pg_fetch_row($results, $i);
							$itemID = $row[0];
							$item_name = $row[1];
							$item_description = $row[2];
							$item_price = $row[3];
							$item_category = $row[4];
							$item_type = $row[5];


							//second query to retrieve the ratings for each menu item
							$escapedinput2 = pg_escape_string($itemID);
							$ratingItem_query = "SELECT R1.userid, R1.name, R2.date, R2.rating, R2.comment, R2.itemid
												FROM rater R1, ratingItem R2
												WHERE R1.userID = R2.userID AND R2.itemID = '{$escapedinput2}'";

							$ratingItem_result = pg_query($databaseconnection, $ratingItem_query);
							$num_rows2 = pg_numrows($ratingItem_result);
							for($j=0; $j<$num_rows2; $j++){
								$ratingRow = pg_fetch_row($ratingItem_result, $j);

								
								//for loop to produce html code that represents the rating as stars
								$star_rating = "";
								for($k=0; $k<$ratingRow[3]; $k++){

									$star_rating = $star_rating."\n<img src='images/star.png' style='width:15px'>";
								}
								if($ratingRow[0] == 'RA02'){

									$ratinghtmlcode = $ratinghtmlcode."<li class='w3-bar' >
										
							          	<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]). '?'. http_build_query($_GET) . "'> 
							          		<input type='text' style='display:none' name='submit_delete_item_rating_id' value=$ratingRow[0]> 
							          		<input type='text' style='display:none' name='submit_delete_item_rating_date' value=$ratingRow[2]>
							          		<input type='text' style='display:none' name='submit_delete_item_rating_item' value=$ratingRow[5]>
							          		<button class='w3-bar-item w3-button w3-xlarge w3-right' name = submit_delete_item_rating type = 'submit'>&times;</button>
							          	</form>

								          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
								          	<div class='w3-bar-item'>
								             	<span class='w3-large'>$ratingRow[1] $star_rating</span>
								             	<br>
								             	<span>$ratingRow[4]</span>
								              	<br>
								              	<h6>$ratingRow[2]</h6>
						          		   	</div>
						          			</a>
						      			</li>";

								} else {

									$ratinghtmlcode = $ratinghtmlcode."<li class='w3-bar' >
									
							          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
								          	<div class='w3-bar-item'>
								             	<span class='w3-large'>$ratingRow[1] $star_rating</span>
								             	<br>
								             	<span>$ratingRow[4]</span>
								              	<br>
								              	<h6>$ratingRow[2]</h6>
						          		   	</div>
						          			</a>
						      			</li>";

								}

									

							}

							//change the icon to match the menuItem category
							switch (true) {
								case ($item_category == "starter"):
									$menuItem_category_icon = "starter-icon-1.png";
									break;
									
								case ($item_category == "main"):
									$menuItem_category_icon = "main-icon-1.png";
									break;

								case ($item_category == "dessert"):
									$menuItem_category_icon = "dessert-icon-1.png";
									break;

								default:
									$menuItem_category_icon = "dessert-icon-1.png";
									break;
							}

							//change the icon to match the menuItem type
							switch (true) {
								case ($item_type == "beverage"):
									$menuItem_type_icon = "drink-icon-2.png";
									break;

								case ($item_type == "food"):
									$menuItem_type_icon = "food-icon-2.png";
									break;

								default:
									$menuItem_type_icon = "food-icon-2.png";
									break;
							}


							

							//outputs result of menuItem with ratings as a sub list
							echo "<p>
								<li  class='w3-bar' style = 'list-style-type:none' >
								
						          	<span onclick=$function
						          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>
						          	<img src='images/$menuItem_type_icon' class='w3-bar-item w3 circle' style='width:85px'>
						          	<img src='images/$menuItem_category_icon' class='w3-bar-item w3 circle' style='width:85px'>
						          	<div class='w3-bar-item'>
						             	<span class='w3-large'>$item_name $$item_price</span>
						              	<br>
						              	<span>$item_description</span>
						              	<br>$item_category</span> 
						              	<div id = 'ratings' class='w3-container w3-show'>
						              		<ul style = 'list-style-type:none'>
						              			$ratinghtmlcode 
						              		</ul>
						              	</div>	
						            </div
				          			</a>
				      			</li>
				      		</p>";
							}
							break;

				case($CallingTab == "Locations"):

					//create query statements that will be executed. 
					//Can use PHP variables, but note the {} that need to go around the PHP variables
					$query = " SELECT m.name,m.price, managername, phonenumber, streetaddress, houropen, hourclose
					  FROM restaurant r INNER JOIN location l on r.restaurantid = l.restaurantid INNER JOIN menuitem m on m.restaurantID = r.restaurantID
					  WHERE r.restaurantid ='{$escapedinput}' AND m.price IN (SELECT MAX(price) FROM menuitem WHERE restaurantid = m.restaurantID) ";

				
					//execute the query
					$results = pg_query($databaseconnection, $query);
						//RAW OUTPUT 1 - PRINT AS ARRAY
						//For testing, and understanding of what is actually retrieved:
						//convert the rows from the result into a 2D array, then print the array
						$arr = pg_fetch_all($results);

						//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
						if(empty($arr)){
							echo "<p><b> Error - No results matching your query </b></p>";
							echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
						}
					
				
						//dynamically generate an HTML formatted list by looping through results. 
						//leverages the dimensions of $results as variables, picks out specific data points. In this example the menu item names and descriptions.
						$num_rows = pg_numrows($results);
						$num_cols = pg_numfields($results);
						for ($i=0; $i<$num_rows; $i++){
							$row = pg_fetch_row($results, $i);
							$val_item_name= $row[0];
							$val_item_price= $row[1];
							$val_mgr_name = $row[2];
							$val_phone_num = $row[3];
							$val_address = $row[4];
							$val_open_hour = $row[5];
							$val_close_hour = $row[6];

							
							
							echo "<p>
								<li class='w3-bar' style = 'list-style-type:none'>
								
						          	<span onclick='this.parentElement.style.display='none
						          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

						          	<img src='images/location-icon-1.png' class='w3-bar-item w3 circle' style='width:85px'>
						          	<div class='w3-bar-item'>
						             	<span class='w3-large'>$val_address</span> 
						             	<br>
						             	<span>$val_open_hour - $val_close_hour</span>
						             	<br>
						             	<span>Most Expensive item: $val_item_name $$val_item_price</span>
						             	<br>
						             	<span>Manager: $val_mgr_name</span>
						             	<br>
						             	<span>Phone: $val_phone_num</span>						              							          
				          		   	</div>
				          			</a>
				      			</li>
				      		</p>";
							}
							break;

					break;


				case($CallingTab == "FavoriteRaters"):

					//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: 'Find the names and reputations of the raters that rated a specific restaurant (say Restaurant Z) the most frequently. Display this information together with their comments and the names and prices of the menu items they discuss. (Here Restaurant Z refers to a restaurant of your own choice, e.g. Ma Cuisine).'
				//Query works by checking to see if the user has rated more than one item on the menu, currently, the restaurantid has been hardcoded to R1 
				$query = "SELECT r1.name, r1.reputation, r2.comment, r3.name, m.name, m.price
						  FROM rater r1 INNER JOIN ratingitem r2 ON r1.userid = r2.userid INNER JOIN menuitem m ON r2.itemid = m.itemid INNER JOIN restaurant r3 on r3.restaurantid = m.restaurantid 
						  WHERE EXISTS(SELECT * 
			 			  			   FROM ratingitem NATURAL JOIN menuitem
			 						   WHERE r1.userid = userid
			 								AND
											r3.restaurantid = restaurantid
											AND m.itemid != itemid)
						AND r3.restaurantid = '{$dataset[0]}'";

			
						//execute the query
						$results = pg_query($databaseconnection, $query);
						//RAW OUTPUT 1 - PRINT AS ARRAY
						//For testing, and understanding of what is actually retrieved:
						//convert the rows from the result into a 2D array, then print the array
						$arr = pg_fetch_all($results);

						//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
						if(empty($arr)){
							echo "<p><b> Error - No results matching your query </b></p>";
							echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
						}
					
				
						//dynamically generate an HTML formatted list by looping through results. 
						//leverages the dimensions of $results as variables, picks out specific data points. In this example the menu item names and descriptions.
						$num_rows = pg_numrows($results);
						$num_cols = pg_numfields($results);
						for ($i=0; $i<$num_rows; $i++){

							// fetches and encodes the row so that it can be passed onto the restaurant page
							$row = pg_fetch_row($results, $i);
							$val_rater_name = $row[0];
							$val_rep = $row[1];
							$val_res_com = $row[2];
							$val_res_name = $row[3];
							$val_item_name = $row[4];
							$val_item_price = $row[5];

							
							echo "<p>
								<li class='w3-bar' style = 'list-style-type:none'>
								
						          	<span onclick='this.parentElement.style.display='none
						          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

						          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
						          	<div class='w3-bar-item'>
						             	<span class='w3-large'>$val_rater_name</span>
						             	<br>
						              	<span>Reputation: $val_rep</span>
						              	<br>
							            <span>Rated $val_item_name, $$val_item_price</span>
							            <br>
							            <span>$val_res_com</span>
							            <br>
							            <span>$val_res_name</span>
				          		   	</div>
				          			</a>
				      			</li>
				      		</p>";
							}
							break;

					break;

				//default case:
				default:

				break;
			}
			//close the database connection 
			pg_close($databaseconnection);
		
		?>