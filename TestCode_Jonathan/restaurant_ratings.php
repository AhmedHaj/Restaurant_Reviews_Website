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

			//create query statements that will be executed. 
			//Can use PHP variables, but note the {} that need to go around the PHP variables
			$query = "SELECT * FROM rating M WHERE M.restaurantID = '{$escapedinput}'";

			
			//execute the query
			$results = pg_query($databaseconnection, $query);
				//RAW OUTPUT 1 - PRINT AS ARRAY
				//For testing, and understanding of what is actually retrieved:
				//convert the rows from the result into a 2D array, then print the array
				$arr = pg_fetch_all($results);
				/*
				print_r($arr);
				*/
				//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
				if(empty($arr)){
					echo "<p><b> Error - No results matching your query </b></p>";
					echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
				}
				//RAW OUTPUT 2 - DISPLAY AS TABLE
				//display the results on the screen using HTML to format, using a while loop to account for multiple rows/columns
				/*
				echo "<table>\n";
				while($row = pg_fetch_array($results)){
					echo "\t<tr>\n";
					foreach ($row as $col_value){
						echo "\t\t<td>$col_value</td>\n";
					}
					echo "\t</tr>\n";
				}
				echo "\t</tr>\n";
				*/
				//RAW OUTPUT 3 - DISPLAY SPECIFIC ELEMENT
				//retrieve specific element from the results: ($results, row, column) 
				/*
				$val = pg_fetch_result($results, 0, 1);
				echo "<p> $val </p>";
				$val = pg_fetch_result($results, 1, 1);
				echo "<p> $val </p>";
				*/
			
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



				$val_description = $row[6];
				echo "<p>
					<li class='w3-bar'>
					
			          	<span onclick='this.parentElement.style.display='none
			          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>

			          	<img src='images/rater-004.png' class='w3-bar-item w3 circle' style='width:85px'>
			          	<div class='w3-bar-item'>
			             	<span class='w3-large'>$rater_name</span>
			              	<img src='images/star.png' style='width:15px'>
			              	<img src='images/star.png' style='width:15px'>
			              	<img src='images/star.png' style='width:15px'>
			              	<img src='images/star.png' style='width:15px'>
			              	<br>
			              	<span>$val_description</span>
	          		   	</div>
	          			</a>
	      			</li>
	      		</p>";
			}
			//close the database connection 
			pg_close($databaseconnection);
		
		?>