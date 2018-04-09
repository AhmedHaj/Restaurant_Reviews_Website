<!-- 
	This code supports the website  DeepCan.com 

	This code handles the queries from index.php, and top_rated.php, this includes requirements F, G, H, I, and J.
  
	Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
		Last Updated: 2018-04-09

  	Advisory:
  		This website's development is ongoing. Experimental and non-functional features may result.
	
	Development History:
	    2018-03-15 - HTML search query form created, and linked to php code
	    2018-03-16 - Succesful proof of concept HTML->PHP->SQL->ServerDatabase->PHP->HTML
	    2018-03-20 - The W3 search is now connected to the PHP code.
	    2018-03-20 - Proof of concept: the PHP code generates different HTML based on user input.
	    2018-03-21 - Proof of concept: PHP generates different SQL queries based on user input.
	    2018-03-29 - Proof of concept: PHP can now target specific items from the SQL query results.
	    2018-03-29 - Proof of concept: PHP dynamically generates HTML list from user input and SQL query results.
	    2018-03-29 - Displays an error if no results were found matching the string input.
	    2018-03-29 - Non-dynamic HTML code removed, as this PHP code will be referenced within other pages.
	    2018-03-30 - Encodes row from SQL table to allow passing arrays to other pages.
	    2018-04-06 - This code can detect where it was referenced from via PHP variables.
	    2018-04-06 - Added switch case, performs different SQL queries and generates HTML code based on the context.
	    2018-04-09 - Changed several HTML out-puts to fit context, formating, bar graphs, text, etc.

  	Planned:
    	- Consider if similar HTML generation should be done outside the switch-case using variables.
    	- Consider if any of this code should be split into seperate files, or vice-versa.
    	- Clean up redundant and unneeded code.
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
		
		//Code and Variables from the referencing page are incorporated with this code by inclusion and can be referenced directly
		
		/*
		echo "<p>The page which called this PHP code is:  $callingPage</p>";
		echo "<p>The tab which called this PHP code is:  $callingTab</p>";
		echo "<p>The button which called this PHP code is:  $callingButton</p>";
		echo "<p>The filter which called this PHP code is:  $callingFilter</p>";
		echo "<p>The category which called this PHP code is:  $callingCategory</p>";
		echo "<p>The category2 which called this PHP code is:  $callingCategory2</p>";

		echo "<p>previous:  $callingTabPrevious</p>";
		echo "<p>current: $callingTab</p>";
		*/
		

				//Keep the same tab open
				/*
				if ($callingTabPrevious == "top_category" and $callingTab == "top_category"){
					//echo "<script> openTab(event,'top_in_category'); </script>";
					echo "something happened";
				}
				*/

		//Create a shorthand for the data in the search form, i.e. a variable we can use.
		$input = $_REQUEST["searchText"];
		//Manually escape apostrophes in the string
		$input = str_replace("'","''", $input);
		//Display the submitted information using the created variables inside an echo command

		/*
		echo "<p> Search query term was received</p>
				<p>You entered $input</p>";
		*/

		//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
		//http://php.net/manual/en/function.pg-escape-string.php
		$escapedinput = pg_escape_string($input);

		//Perform different SQL queries and html outputs depending on the context
		//Reference: http://php.net/manual/en/control-structures.switch.php
		switch (true) {

			case ($callingPage == "index" and $callingButton== ""):
				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables

				//sort the results per user input
				if($callingCategory2 != ""){
						//filter the results by category per user input
						if($callingCategory != ""){
							$query = "SELECT * FROM restaurant M WHERE M.name LIKE '%{$escapedinput}%' AND M.type='{$callingCategory}' ORDER BY M.{$callingCategory2}";
						//no filter indicated
						} else{
							$query = "SELECT * FROM restaurant M WHERE M.name LIKE '%{$escapedinput}%' ORDER BY M.{$callingCategory2}";
						}
				//no sort indicated
				} else{
						//filter the results by category per user input
						if($callingCategory != ""){
							$query = "SELECT * FROM restaurant M WHERE M.name LIKE '%{$escapedinput}%' AND M.type='{$callingCategory}'";
						//no filter indicated
						} else{
							$query = "SELECT * FROM restaurant M WHERE M.name LIKE '%{$escapedinput}%'";
						}
				}

				//execute the query
				$results = pg_query($databaseconnection, $query);

				//dynamically generate an HTML formatted list by looping through results. 
				//leverages the dimensions of $results as variables, picks out specific data points. In this example the menu item names and descriptions.
				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				for ($i=0; $i<$num_rows; $i++){

					// fetches and encodes the row so that it can be passed onto the restaurant page
					$row = pg_fetch_row($results, $i);
					$encoded_row = json_encode($row);
					$dataset = urlencode($encoded_row);

					$val_restaurantid = $row[0];
					$val_name = $row[1];
					$val_type = $row[2];
					$val_url = $row[3];

					echo "<p>
						<li class='w3-bar'>
				          	<span onclick='this.parentElement.style.display='none'
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>
				          	<a href='restaurant.php?dataset=$dataset'>
				          	<img src='images/test-logo.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_name</span>
				              	<br>
				              	<span>$val_type</span>
				              	<br>
				              	<span>$val_url</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
				}
				break;


			//QUERY E
			case ($callingPage == "indexRight" and $callingButton == ""):
				//Requirement E: 'For each type of restaurant (e.g. Indian or Irish) and the category of menu item (appetiser, main or desert), list the average prices of menu items for each category.'

				//create query statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				
				//find the of count restaurant types with each menuItem type
				$query = "SELECT COUNT(DISTINCT r.type), m.category
						  FROM restaurant r INNER JOIN menuitem m ON r.restaurantid = m.restaurantid
						  GROUP BY m.category
						  ORDER BY m.category";

				//find average price of each menuItem type by restaurant type
				$query2 = "SELECT r.type, m.category, AVG(m.price)
						  FROM restaurant r INNER JOIN menuitem m ON r.restaurantid = m.restaurantid
						  GROUP BY r.type, m.category
						  ORDER BY m.category, AVG(m.price)";

				//find the highest average per menuItem type
				$query3 = "SELECT AVG(m.price)
						  FROM restaurant r INNER JOIN menuitem m ON r.restaurantid = m.restaurantid
						  GROUP BY r.type, m.category
						  ORDER BY AVG(m.price) DESC";

		
			
				//execute the query
				$results = pg_query($databaseconnection, $query);
				$results2 = pg_query($databaseconnection, $query2);
				$results3 = pg_query($databaseconnection, $query3);
				$row3 = pg_fetch_row($results3, 0);
				$val_max_price = $row3[0];
			
				//RAW OUTPUT 1 - PRINT AS ARRAY
				//For testing, and understanding of what is actually retrieved:
				//convert the rows from the result into a 2D array, then print the array
				$arr = pg_fetch_all($results2);

				//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
				if(empty($arr)){
					echo "<p><b> Error - No results matching your query </b></p>";
					echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
				}
		
				//dynamically generate an HTML formatted list by looping through results. 
				//leverages the dimensions of $results as variables, picks out specific data points. In this example the menu item names and descriptions.
				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				$current_row_in_results2 = 0;

				//first loop, one iteration per menuItem type
				for ($i=0; $i<$num_rows; $i++){

					$row = pg_fetch_row($results, $i);
					$val_menuitem_category_count = $row[0];
					$val_menuitem_category_type = $row[1];

									$num_rows2 = pg_numrows($results2);
									$num_cols2 = pg_numfields($results2);
									
									echo "<br>The average <b>$val_menuitem_category_type</b> price by restaurant category";

									//Second loop, generates the bar graph for each restaurant type
									for ($j=$current_row; $j<$val_menuitem_category_count+$current_row; $j++){
									
											$row2 = pg_fetch_row($results2, $j);
											$encoded_row2 = json_encode($row2);
											$dataset2 = urlencode($encoded_row2);

											$val_restaurant_type2 = $row2[0];
											$val_menuitem_category_type2 = $row2[1];
											$val_menuitem_category_avg2 = $row2[2];
											
											//round the averages to two decimal places to display as dollar value
											$val_round_menuitem_category_avg2 = round($val_menuitem_category_avg2, 2);
											//calculate average as a percentage of the highest average, to define the bar graph lengths
											$val_percent_menuitem_category_avg2 = round(($val_menuitem_category_avg2/$val_max_price)*100);

											echo "<div class='w3-theme-l4'>
										                <div class='w3-round-large w3-center w3-theme' style='height:24px; width:$val_percent_menuitem_category_avg2%'>$val_restaurant_type2 $$val_round_menuitem_category_avg2</div>
										          </div>";
								      }

								      //increase postion in outer loop, so next iteration of inner loop doesn't start at 0
								      $current_row += $val_menuitem_category_count;
					}

				echo "<br>";
				break;


			//QUERY G
			case ($callingPage == "top_rated" and $callingButton == "test_button_g"):
				echo "<p><b>G: Display the details of the restaurants that have not been rated in January 2015. That is, you should display the name of the restaurant together with the phone number and the type of food.</b></p>";

				//No variables needed for this query
				//TO DO: This returns all locations, group by restuarant?
				$query = "SELECT RE.name, RE.restaurantID, L.locationID, L.phonenumber, RE.type
							FROM restaurant RE
							LEFT JOIN location L ON RE.restaurantID = L.restaurantID
							WHERE RE.restaurantID NOT IN (SELECT RA.restaurantID
															FROM rating RA 
															WHERE CAST(RA.date AS DATE) >= '2015-01-01' 
															AND CAST(RA.date AS DATE) <= '2015-01-31')";

				//execute the query											
				$results = pg_query($databaseconnection, $query);

				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				for ($i=0; $i<$num_rows; $i++){

					// fetches and encodes the row so that it can be passed onto the restaurant page
					$row = pg_fetch_row($results, $i);
					$encoded_row = json_encode($row);
					$dataset = urlencode($encoded_row);

					$val_restaurant_name = $row[0];
					$val_restaurant_id = $row[1];
					$val_location_id = $row[2];
					$val_location_phone = $row[3];
					$val_restaurant_type = $row[4];
					echo "<p>
						<li class='w3-bar'>
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>
				          	<a href='restaurant.php?dataset=$dataset'>
				          	<img src='images/test-logo.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_restaurant_name</span>
				              	<br>
				              	<span>Location: $val_location_id   Phone: $val_location_phone   Type: $val_restaurant_type</span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
				}
				break;

			//QUERY H
			case ($callingPage == "top_rated" and $callingButton == "test_button_h"):
				echo "<p><b>H: Find the names and opening dates of the restaurants that obtained Staff rating that is lower than any rating given by rater X. Order your results by the dates of the ratings. (Here, X refers to any rater of your choice.)</b></p>"; 

				//Variables needed
				$raterH = 'RA10'; //Rater 10 has the lowest rating of 2

				$query = "SELECT RE.name, RE.restaurantID, L.locationID,L.firstopendate, RA.date, RA.staff
							FROM location L
							LEFT JOIN restaurant RE ON L.restaurantID = RE.restaurantID
							LEFT JOIN rating RA ON RE.restaurantID = RA.restaurantID
							WHERE RA.staff < (SELECT MIN(RA.staff)
												FROM rating RA
												WHERE RA.userID = '{$raterH}')
							ORDER BY RA.date";

				//execute the query	
				$results = pg_query($databaseconnection, $query);
				
				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				for ($i=0; $i<$num_rows; $i++){

					$row = pg_fetch_row($results, $i);
					$encoded_row = json_encode($row);
					$dataset = urlencode($encoded_row);

					$val_restaurant_name = $row[0];
					$val_restaurant_id = $row[1];
					$val_location_id = $row[2];
					$val_location_opendate = $row[3];
					$val_rating_date = $row[4];
					$val_rating_staff = $row[5];

					echo "<p>
						<li class='w3-bar'>
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>
				          	<a href='restaurant.php?dataset=$dataset'>
				          	<img src='images/test-logo.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_restaurant_name Location: $val_location_id</span>
				              	<img src='images/star.png' style='width:15px'>
				              	<img src='images/star.png' style='width:15px'>
				              	<img src='images/star.png' style='width:15px'>
				              	<img src='images/star.png' style='width:15px'>
				              	<br>
				              	<span>Received a Staff rating of $val_rating_staff on $val_rating_date </span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
				}
				break;

			//QUERY I
			case ($callingPage == "top_rated" and $callingButton == "test_button_i"):
				echo "<p><b>I: List the details of the Type Y restaurants that obtained the highest Food rating. Display the restaurant name together with the name(s) of the rater(s) who gave these ratings. (Here, Type Y refers to any restaurant type of your choice, e.g. Indian or Burger.) </b></p>";

				//Variables needed
				$highestRatingI = '5'; //Assuming the highest rating = 5, potentially could be something else.
				$categoryTypeI = 'Japanese';  

				$query = "SELECT RE.name, RE.restaurantID, RE.type, R.name, RA.food
							FROM rating RA
							LEFT JOIN restaurant RE ON RA.restaurantID = RE.restaurantID
							LEFT JOIN rater R ON RA.userID = R.userID
							WHERE RA.food = '{$highestRatingI}' AND RE.type= '{$categoryTypeI}'";

				$results = pg_query($databaseconnection, $query);
				
				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				for ($i=0; $i<$num_rows; $i++){

					$row = pg_fetch_row($results, $i);
					$encoded_row = json_encode($row);
					$dataset = urlencode($encoded_row);

					$val_restaurant_name = $row[0];
					$val_restaurant_id = $row[1];
					$val_restaurant_type = $row[2];
					$val_rater_name = $row[3];
					$val_rating_food = $row[4];

					echo "<p>
						<li class='w3-bar'>
						
				          	<span onclick='this.parentElement.style.display='none
				          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>
				          	<a href='restaurant.php?dataset=$dataset'>
				          	<img src='images/test-logo.png' class='w3-bar-item w3 circle' style='width:85px'>
				          	<div class='w3-bar-item'>
				             	<span class='w3-large'>$val_restaurant_type restaurant $val_restaurant_name</span>
				              	<img src='images/star.png' style='width:15px'>
				              	<img src='images/star.png' style='width:15px'>
				              	<img src='images/star.png' style='width:15px'>
				              	<img src='images/star.png' style='width:15px'>
				              	<br>
				              	<span>Received the highest rating of $val_rating_food by $val_rater_name </span>
		          		   	</div>
		          			</a>
		      			</li>
		      		</p>";
				}
		

				break; 


			//QUERY F
			case ($callingPage == "top_rated" and $callingTab == "most_reviewed"):
				//QUERY F
				echo "<p><b>F: Find the total number of rating for each restaurant, for each rater. That is, the data should be grouped by the restaurant, the specific raters and the numeric ratings they have received.</b></p>"; 

				//No variables needed for this query
				//First query finds the number of ratings for each restaurant
				$query = "SELECT RE.name, Re.restaurantID, COUNT(RE.name)
							FROM restaurant RE 
							LEFT JOIN rating RA ON RE.restaurantID = RA.restaurantID
							LEFT JOIN rater R ON RA.userID = R.userID
							GROUP BY RE.name, Re.restaurantID
							ORDER BY COUNT(RE.name) DESC";

				//No variables needed for this query
				//Second query finds all the ratings related info for each restaurant
				//Probably makes the first query redundant
				$query2 = "SELECT RE.name, Re.restaurantID, COUNT(RE.name), R.name, RA.price, RA.food, RA.mood, RA.staff
							FROM restaurant RE 
							LEFT JOIN rating RA ON RE.restaurantID = RA.restaurantID
							LEFT JOIN rater R ON RA.userID = R.userID
							GROUP BY RE.name, Re.restaurantID, R.name, RA.price, RA.food, RA.mood, RA.staff
							ORDER BY COUNT(RE.name) DESC";

				$results = pg_query($databaseconnection, $query);
				$results2 = pg_query($databaseconnection, $query2);

				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				$current_row_in_results2 = 0;
				//First loop generates summaries, i.e. restaurant X received X many reviews
				for ($i=0; $i<$num_rows; $i++){

					// fetches and encodes the row so that it can be passed onto the restaurant page
					$row = pg_fetch_row($results, $i);
					$encoded_row = json_encode($row);
					$dataset = urlencode($encoded_row);

					$val_restaurant_name = $row[0];
					$val_restaurant_id = $row[1];
					$val_rating_count = $row[2];
					echo "<p>
							<button onclick='myFunction('filters')' class='w3-btn w3-block w3-theme w3-left-align'>$val_restaurant_name received $val_rating_count ratings in total. Click to Expand. </button>
						      <div id='filters$val_restaurant_id' class='w3-container '>";
						        	$num_rows2 = pg_numrows($results2);
									$num_cols2 = pg_numfields($results2);
									
									//Second loop provides details of the pertinent reviews, to appear under the summary
									for ($j=$current_row; $j<$val_rating_count+$current_row; $j++){
									
										$row2 = pg_fetch_row($results2, $j);
										$encoded_row2 = json_encode($row2);
										$dataset2 = urlencode($encoded_row2);

										$val_restaurant_name2 = $row2[0];
										$val_restaurant_id2 = $row2[1];
										$val_rating_count2 = $row2[2];
										$val_rater_name2 = $row2[3];
										$val_rating_price2 = $row2[4];
										$val_rating_food2 = $row2[5];
										$val_rating_mood2 = $row2[6];
										$val_rating_staff2 = $row2[7];

										echo sprintf("<br> %s scored this restaurant Price: %s  Food: %s  Mood: %s", $val_rater_name2, $val_rating_price2, $val_rating_food2, $val_rating_mood2,$val_rating_staff2);
								      }

								      //increase postion in outer loop, so next iteration of inner loop doesn't start at 0
								      $current_row += $val_rating_count;
						echo "</div>
		      			</p><br>";
				}
				break;

			//QUERY J
			case ($callingPage == "top_rated" and $callingTab == "top_in_category"):
			
				//variables to be used in query, and in html output, according to user selection
				switch (true) {
					case ($callingCategory == "best_in_price"):
						$category_to_avg = 'price';
						$progress_bar_colour = 'w3-green';
						break;
					case ($callingCategory == "best_in_food"):
						$category_to_avg = 'food';
						$progress_bar_colour = 'w3-yellow';
						break;
					case ($callingCategory == "best_in_mood"):
						$category_to_avg = 'mood';
						$progress_bar_colour = 'w3-blue';
						break;
					case ($callingCategory == "best_in_staff"):
						$category_to_avg = 'staff';
						$progress_bar_colour = 'w3-red';
						break;
					default:
						$category_to_avg = 'price';
						$progress_bar_colour = 'w3-green';
						break;
				}

				//The easiest way to address this requirement is to pull the same information on all retaurant types and compare them
				$query = "SELECT RE.type, AVG({$category_to_avg})
							FROM rating RA
							LEFT JOIN restaurant RE ON RA.restaurantID = RE.restaurantID
							GROUP BY RE.type
							ORDER BY AVG({$category_to_avg}) DESC";

				//execute query
				$results = pg_query($databaseconnection, $query);

				$row = pg_fetch_row($results, $i);
				$val_best_avg_type = $row[0];

				echo "<h2>$val_best_avg_type restaurants have the best average rating for $category_to_avg</h2>
						5 = best
						<br>1 = worst
					  <br>";
				
				$num_rows = pg_numrows($results);
				$num_cols = pg_numfields($results);
				for ($i=0; $i<$num_rows; $i++){

					$row = pg_fetch_row($results, $i);
					$encoded_row = json_encode($row);
					$dataset = urlencode($encoded_row);

					$val_restaurant_type = $row[0];
					$val_average_rating_price = $row[1];
					$val_average_rating_food = $row[2];
					$val_average_rating_mood = $row[3];
					$val_average_rating_staff = $row[4];

					//round the averages to two decimal places for sensible display
					$val_round_rating_price = round($val_average_rating_price, 2);
					$val_round_rating_food = round($val_average_rating_food, 2);
					$val_round_rating_mood = round($val_average_rating_mood, 2);
					$val_round_rating_staff = round($val_average_rating_staff, 2);

					//calculate average as a percentage out of 5, to define the bar graph lengths
					$val_percent_rating_price = round(($val_average_rating_price/5)*100);
					$val_percent_rating_food = round(($val_average_rating_food/5)*100);
					$val_percent_rating_mood = round(($val_average_rating_mood/5)*100);
					$val_percent_rating_staff = round(($val_average_rating_staff/5)*100);

					//set the background bar using a faded colour
					//overlay with percentage bar in a bright colour, with adjusted length
					echo "<br>
							<div class='w3-theme-l4'>
				                <div class='w3-round-large w3-center $progress_bar_colour' style='height:24px; width:$val_percent_rating_price%'>$val_restaurant_type $val_round_rating_price</div>
				          </div>";
				}

				echo "<br>";

				break;


			//perform default if non of the cases match
			default:
				# If you are reading this - Thank you for appreciating our work and reading through so many lines of code :)
				break;
		}



		//convert the rows from the result into a 2D array
		//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
		$arr = pg_fetch_all($results);
		if(empty($arr)){
			echo "<p><b> Error - No results matching your query </b></p>";
			echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
		}
			
			
		//close the database connection 
		pg_close($databaseconnection);
		
		?>