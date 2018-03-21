<!-- 
	This code supports the website  DeepCan.com

	Currently this php code, as it stands, will generate a new webpage for easy testing. 
	However this code could function directly within index.html
  
  Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
	Last Updated: 2018-03-20

  Advisory:
  This website is a testing ground. Experimental and non-functional features may result.

	Development History:
	    2018-03-15 - HTML search query form created, and linked to php code
	    2018-03-16 - Succesful proof of concept HTML->PHP->SQL->ServerDatabase->PHP->HTML
	    2018-03-20 - The W3 search is now connected to the PHP code.
	    2018-03-20 - Proof of concept: the PHP code generates different HTML based on user input.

  Planned:
    - Generate dynamic SQL queries based on user input
    - Have the PHP generate dynamic HTML content based on SQL query results

-->

<!doctype html>
<html>
	<head>
		<title>Search Query Feedback</title>
	</head>

	<body>
		<?php #this php code handles input data from the search form on index.html

		//Create variables for connection information to connect to the database
		//Edit these variables according to your local server environment
		$port="XXXX";
		$database="XXXX";
		$username="XXXX";
		$password="XXXX";
		
		//open a connection to the Postgre database on the slocal server, using the connection information
		$databaseconnection = pg_connect("host=localhost port=$port dbname=$database user=$username password=$password");


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
			echo "<p> You entered an String.</p>
					<p> Until I figure out what it means, here is some interesting data!</p>";

			//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
			//http://php.net/manual/en/function.pg-escape-string.php
			$escapedinput = pg_escape_string($input);

			//create query statements that will be executed. 
			//Can use PHP variables, but note the {} that need to go around the PHP variables
			$query = "SELECT * FROM menuitem M WHERE M.name LIKE '%{$escapedinput}%'";

			//execute the query
			$results = pg_query($databaseconnection, $query);

			//display the results on the screen, using a while loop to account for multiple rows/columns
			//This output has been formatted into tables using HTML for easy reading
			echo "<table>\n";
			while($row = pg_fetch_array($results)){
				echo "\t<tr>\n";
				foreach ($row as $col_value){
					echo "\t\t<td>$col_value</td>\n";
				}
				echo "\t</tr>\n";
			}
			echo "\t</tr>\n";
			
			//close the database connection 
			pg_close($databaseconnection);

		}

		
		?>


	</body>
	

</html>