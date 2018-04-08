<!-- 
	This code supports the website  DeepCan.com
	This php code is based on handle_search.php, as it stands, will retrieve ratings for the restaurant that is currently being viewed. 
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
	Last Updated: 2018-03-31
  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.
	Development History:
	    2018-03-31 - linked to SQL


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
							//currently food, mood. and staff are broken due to errors in converting to sql
							$mood_rating = "";
							for($k=0; $k<$row[4]; $k++){

								$mood_rating = $mood_rating."\n<img src='images/star.png' style='width:15px'>";
							}

							$staff_rating = "";
							for($k=0; $k<$row[5]; $k++){

								$staff_rating = $staff_rating."\n<img src='images/star.png' style='width:15px'>";
							}

							
							$val_description = $row[6];
							echo "<p>
								<li class='w3-bar' style = 'list-style-type:none'>
								
						          	<span onclick='this.parentElement.style.display='none
						          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

						          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
						          	<div class='w3-bar-item'>
						             	<span class='w3-large'>$rater_name</span>
						             	<br>
						             	<span>price: </span>
						              	$price_rating
						              	<br>
						              	<span>food: </span>
						              	$row[3]
						              	<br>
						              	<span>mood: </span>
						              	$row[4]
						              	<br>
						              	<span>staff: </span>
						              	$row[5]
						              	<br>
						              	<span>$val_description</span>
						              	<br>
							            <h6>$row[1]</h6>
				          		   	</div>
				          			</a>
				      			</li>
				      		</p>";
							}
							break;

				case($CallingTab == "Menu"):

					//create query statements that will be executed. 
					//Can use PHP variables, but note the {} that need to go around the PHP variables
					$query = "SELECT * FROM menuItem M WHERE M.restaurantID = '{$escapedinput}'";

				
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
							$item_description = $row[4];


							//second query to retrieve the ratings for each menu item
							$escapedinput2 = pg_escape_string($itemID);
							$ratingItem_query = "SELECT R1.name, R2.date, R2.rating, R2.comment
												FROM rater R1, ratingItem R2
												WHERE R1.userID = R2.userID AND R2.itemID = '{$escapedinput2}'";

							$ratingItem_result = pg_query($databaseconnection, $ratingItem_query);
							$num_rows2 = pg_numrows($ratingItem_result);
							for($j=0; $j<$num_rows2; $j++){
								$ratingRow = pg_fetch_row($ratingItem_result, $j);

								
								//for loop to produce html code that represents the rating as stars
								$star_rating = "";
								for($k=0; $k<$ratingRow[2]; $k++){

									$star_rating = $star_rating."\n<img src='images/star.png' style='width:15px'>";
								}

								$ratinghtmlcode = $ratinghtmlcode."<li class='w3-bar' >
									
							          	<span onclick='this.parentElement.style.display='none
							          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

							          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
							          	<div class='w3-bar-item'>
							             	<span class='w3-large'>$ratingRow[0] $star_rating</span>
							             	<br>
							             	<span>$ratingRow[3]</span>
							              	<br>
							              	<h6>$ratingRow[1]</h6>
					          		   	</div>
					          			</a>
					      			</li>";

							}

							$function = "myFunction('ratings')";

							
							echo "<p>
								<li  class='w3-bar' style = 'list-style-type:none' >
								
						          	<span onclick=$function
						          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

						          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
						          	<div class='w3-bar-item'>
						             	<span class='w3-large'>$item_name</span>
						              	<img src='images/star.png' style='width:15px'>
						              	<img src='images/star.png' style='width:15px'>
						              	<img src='images/star.png' style='width:15px'>
						              	<img src='images/star.png' style='width:15px'>
						              	<br>
						              	<span>$item_description</span> 
						              	<div id = 'ratings' class='w3-container w3-show'>
						              		<ul style = 'list-style-type:none'>
						              			$ratinghtmlcode 
						              		</ul>
						              	</div>	
				          			</a>
				      			</li>
				      		</p>";
							}
							break;

				case($CallingTab == "Locations"):

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
							//currently food, mood. and staff are broken due to errors in converting to sql
							$mood_rating = "";
							for($k=0; $k<$row[4]; $k++){

								$mood_rating = $mood_rating."\n<img src='images/star.png' style='width:15px'>";
							}

							$staff_rating = "";
							for($k=0; $k<$row[5]; $k++){

								$staff_rating = $staff_rating."\n<img src='images/star.png' style='width:15px'>";
							}

							
							$val_description = $row[6];
							echo "<p>
								<li class='w3-bar' style = 'list-style-type:none'>
								
						          	<span onclick='this.parentElement.style.display='none
						          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

						          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
						          	<div class='w3-bar-item'>
						             	<span class='w3-large'>$rater_name</span>
						             	<br>
						             	<span>price: </span>
						              	$price_rating
						              	<br>
						              	<span>food: </span>
						              	$row[3]
						              	<br>
						              	<span>mood: </span>
						              	$row[4]
						              	<br>
						              	<span>staff: </span>
						              	$row[5]
						              	<br>
						              	<span>$val_description</span>
						              	<br>
							            <h6>$row[1]</h6>
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