<!-- 
	This code supports the website  DeepCan.com 
	This code could copied and used directly within other pages, but for efficiency and maintenance one instnaces of this code is being used by reference in multiple contexts. In this way it serves as universal search handler.
  
	Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
		Last Updated: 2018-04-06

  	Advisory:
  		This website is a testing ground. Experimental and non-functional features may result.
	
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
	    2018-04-06 - This code can detect where it was referenced from.

  	Planned:
    	- Have the PHP code execute the SQL search dynamically based on which page called it and the entered search terms
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
		echo "<p>The page which called this PHP code is:  $callingPage</p>";

		//Create a shorthand for the data in the search form, i.e. a variable we can use.
		$input = $_REQUEST["searchText"];

		//Manually escape apostrophes in the string
		$input = str_replace("'","''", $input);
		//Display the submitted information using the created variables inside an echo command
		echo "<p> Search query term was received</p>
				<p>You entered $input</p>";
		//Here is an if/else to prove that we can generate HTML code using PHP depending on variables such as user input
		if(is_numeric($input)){
			echo "<p> You entered an Int.</p>
					<p> I know how to count !</p>";
			//Note how the iterations of this loop is dependent on the user input
			for($x=0; $x<=$input; $x++){
			echo "The number is: $x <br>";
			}
		}
		else {
			echo "<p> You entered a String.</p>";
			//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
			//http://php.net/manual/en/function.pg-escape-string.php
			$escapedinput = pg_escape_string($input);
			//create query statements that will be executed. 
			//Can use PHP variables, but note the {} that need to go around the PHP variables
			$query = "SELECT * FROM restaurant M WHERE M.name LIKE '%{$escapedinput}%'";
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
				$encoded_row = json_encode($row);
				$dataset = urlencode($encoded_row);

				$val_name = $row[1];
				$val_description = $row[3];
				echo "<p>
					<li class='w3-bar'>
					
			          	<span onclick='this.parentElement.style.display='none
			          	class='w3-bar-item w3-button w3-xlarge w3-right'>&times;</span>
			          	<a href='restaurant.php?dataset=$dataset'>

			          	<img src='images/test-logo.png' class='w3-bar-item w3 circle' style='width:85px'>
			          	<div class='w3-bar-item'>
			             	<span class='w3-large'>$val_name</span>
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
		}
		
		?>