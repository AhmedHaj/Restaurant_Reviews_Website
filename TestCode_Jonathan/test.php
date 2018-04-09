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

			case($CallingQuery == "b"):

			//create query statements that will be executed. 
			//Can use PHP variables, but note the {} that need to go around the PHP variables
			//Requirement: Display the full menu of a specific restaurant. That is, the user should select the name of the restaurant from a list, and all menu items, together with their prices, should be displayed on the screen. The menu should be displayed based on menu item categories.
			//restaurantid will be supplied by a list
			$query = "SELECT name, description, price, category 
					FROM menuitem 
					WHERE restaurantid = 'R8' 
					ORDER BY category DESC";

		
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
					$val_category = $row[3];
					$val_description = $row[1];
					$val_price = $row[2];

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_name</span>
				             	<br>
				             	<span>$val_price</span>
				             	<br>
				              	<span>$val_description</span>
				              	<br>
					            <h6>$val_category</h6>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			case($CallingQuery == "c"):

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: For each user‐specified category of restaurant, list the manager names together with the date that the locations have opened. The user should be able to select the category (e.g. Italian or Thai) from a list.
				//type will be supplied by a list, but for now it is hardcoded to Western
				$query = "SELECT name, managername, firstopendate, streetaddress 
						  FROM restaurant r INNER JOIN location l on r.restaurantid = l.restaurantid
						  WHERE type = 'Western'";

			
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
					$val_rest_name = $row[0];
					$val_mgr_name = $row[1];
					$val_open_date = $row[2];
					$val_address = $row[3];

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_rest_name</span>
				             	<br>
				              	<span>$val_mgr_name</span>
				              	<br>
					            <span>$val_open_date</span>
					            <br>
					            <span>$val_address</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			case($CallingQuery == "d"):

			//create query statements that will be executed. 
			//Can use PHP variables, but note the {} that need to go around the PHP variables
			//Requirement: Given a user‐specified restaurant, find the name of the most expensive menu item. List this information together with the name of manager, the opening hours, and the URL of the restaurant. The user should be able to select the restaurant name (e.g. El Camino) from a list.
			//restaurantid will be supplied by a list
			$query = "SELECT m.name,m.price, managername, houropen, hourclose, url
					  FROM restaurant r INNER JOIN location l on r.restaurantid = l.restaurantid INNER JOIN menuitem m on m.restaurantID = r.restaurantID
					  WHERE r.restaurantid = 'R8' AND m.price IN (SELECT MAX(price) FROM menuitem WHERE restaurantid = m.restaurantID)" ;

		
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
					$val_item_name = $row[0];
					$val_mgr_name = $row[2];
					$val_hour_open = $row[3];
					$val_hour_close= $row[4];
					$val_url = $row[5];
					$val_price = $row[1];

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_item_name $ $val_price</span>
				             	<br>
				             	<span>$val_mgr_name</span>
				             	<br>
				              	<span>Working hours: $val_hour_open - $val_hour_close</span>
				              	<br>
					            <span>$val_url</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			case($CallingQuery == "e"):

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: 'For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main or desert), list the average prices of menu items for each category.'
				//Query is simple enough.
				$query = "SELECT r.type, m.category, AVG(m.price)
						  FROM restaurant r INNER JOIN menuitem m ON r.restaurantid = m.restaurantid
						  GROUP BY r.type, m.category
						  ORDER BY r.type";

			
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
					$val_rest_type = $row[0];
					$val_item_cat = $row[1];
					$val_avg_price = $row[2];

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_rest_type</span>
				             	<br>
				              	<span>$val_item_cat</span>
				              	<br>
					            <span>$val_avg_price</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			case($CallingQuery == "k"):

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: 'Find the names, join‐date and reputations of the raters that give the highest overall rating, in terms of the Food and the Mood of restaurants. Display this information together with the names of the restaurant and the dates the ratings were done.'
				//Qyery works by checking if the rater's combined rating of mood and food is equivalent to the highest combined value of mood and food given to a restaurant
				$query = "SELECT r1.name, r1.joindate, r1.reputation, r3.name, r2.date
						FROM rater r1 INNER JOIN rating r2 ON r1.userid = r2.userid INNER JOIN restaurant r3 ON r2.restaurantid = r3.restaurantid
						GROUP BY r1.name, r1.joindate, r2.food, r2.mood, r1.reputation, r3.name, r3.restaurantid, r2.date
						HAVING SUM(r2.mood + r2.food) = (SELECT MAX(mood + food) FROM rating NATURAL JOIN restaurant WHERE r3.restaurantid = restaurantid) 
						ORDER BY r3.restaurantid";

			
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
					$val_join_date = $row[1];
					$val_rep = $row[2];
					$val_rest_name = $row[3];
					$val_rating_date = $row[4];

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_rater_name</span>
				             	<br>
				             	<span>Joined on: $val_join_date</span>
				             	<br>
				              	<span>Reputation: $val_rep</span>				              
					            <br>
					            <span>Rated: $val_rest_name on $val_rating_date</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			case($CallingQuery == "l"):

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: 'Find the names and reputations of the raters that give the highest overall rating, in terms of the Food or the Mood of restaurants. Display this information together with the names of the restaurant and the dates the ratings were done.'
				//Query works by checking to see if the rater's food or mood rating is equal to the highest food or mood rating given to the restaurant
				$query = "SELECT r1.name, r1.reputation, r3.name, r2.date
						FROM rater r1 INNER JOIN rating r2 ON r1.userid = r2.userid INNER JOIN restaurant r3 ON r2.restaurantid = r3.restaurantid
						WHERE r2.mood = (SELECT MAX(mood) FROM rating NATURAL JOIN restaurant WHERE r3.restaurantid = restaurantid) 
						OR r2.food = (SELECT MAX(food) FROM rating NATURAL JOIN restaurant WHERE r3.restaurantid = restaurantid)";

			
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
					$val_rest_name = $row[2];
					$val_rating_date = $row[3];

					
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
					            <span>Rated: $val_rest_name on $val_rating_date</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			case($CallingQuery == "m"):

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
						AND r3.restaurantid = 'R01'";

			
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


			case($CallingQuery == "n"):

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: 'Find the names and emails of all raters who gave ratings that are lower than that of a rater with a name called John, in terms of the combined rating of Price, Food, Mood and Staff. (Note that there may be more than one rater with this name).'
				//Query works by comparing the total rating with that of someone with the name of "Celina lee"  (or whatever is specified)
				$query = "SELECT r1.name, r1.email
						  FROM rater r1 NATURAL JOIN  rating r2
						GROUP BY r1.name, r1.email
							HAVING SUM(r2.price + r2.mood + r2.food + r2.staff) < (SELECT SUM(r4.price + r4.mood + r4.food + r4.staff) 
			 																		FROM rater r3 NATURAL JOIN rating r4
			 																		WHERE r3.name = 'Celina Lee')";

			
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
					$val_rater_email = $row[1];
					

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_rater_name</span>
				             	<br>
				              	<span>E-mail: $val_rater_email</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;


			case($CallingQuery == "o"):

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				//Requirement: "Find the names, types and emails of the raters that provide the most diverse ratings. Display this information together with the restaurants names and the ratings. For example, Jane Doe may have rated the Food at the Imperial Palace restaurant as a 1 on 1 January 2015, as a 5 on 15 January 2015, and a 3 on 4 February 2015. Clearly, she changes her mind quite often."
				//Query works by checking to see if the same user has a very different (combined score +-3) rating on the same restaurant
				$query = "SELECT r1.name, r1.type, r1.email, r3.name, r2.price, r2.food, r2.mood, r2.staff
							FROM rater r1 NATURAL JOIN rating r2 INNER JOIN restaurant r3 ON r2.restaurantid = r3.restaurantid
							GROUP BY r1.name, r1.type, r1.email, r3.name, r2.price, r2.food, r2.mood, r2.staff, r3.restaurantid, r1.userid
							HAVING SUM(r2.price  + r2.food + r2.mood + r2.staff + 3) <= (SELECT SUM(r4.price + r4.mood + r4.food + r4.staff)
			  												FROM rating r4 INNER JOIN restaurant r5 ON r4.restaurantid = r5.restaurantid
														     WHERE r3.restaurantid = r4.restaurantid
																	AND 
																	r4.userid = r1.userid)
	  								OR
	  
	  								SUM(r2.price + r2.food + r2.mood + r2.staff ) >= (SELECT SUM(r6.price + r6.mood + r6.food + r6.staff + 3)
			  													FROM rating r6 INNER JOIN restaurant r7 ON r6.restaurantid = r6.restaurantid
														     	WHERE r3.restaurantid = r7.restaurantid
																	AND 
																	r6.userid = r1.userid)";

			
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
					$val_rater_type = $row[1];
					$val_rater_email = $row[2];
					$val_res_name = $row[3];
					$val_price = $row[4];
					$val_food = $row[5];
					$val_mood = $row[6];
					$val_staff = $row[7];

					
					echo "<p>
						<li class='w3-bar' style = 'list-style-type:none'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

				          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_rater_name</span>
				             	<br>
				              	<span>Type: $val_rater_type</span>
				              	<br>
					            <span>E-mal: $val_rater_email</span>
					            <br>
					            <span>$val_res_name</span>
					            <br>
					            <span>Price: $val_price</span>
					            <br>
					            <span>Food: $val_food</span>
					            <br>
					            <span>Mood: $val_mood</span>
					            <br>
					            <span>Staff: $val_staff</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
					}
					break;

			default:
			
			break;
		}

		pg_close($databaseconnection);	
	?>	