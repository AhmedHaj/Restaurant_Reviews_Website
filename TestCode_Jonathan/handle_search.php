<!-- Currently this php code, as it stands, will generate a new webpage for easy testing. 
	However this code could function directly within index.html -->

<!doctype html>
<html>
	<head>
		<title>Search Query Feedback</title>
	</head>

	<body>
		<?php #this php code handles input data from the search form on index.html

		//Create variables for connection information to connect to the database
		$username="simulat5_jon";
		$password="2132Yousri";
		$database="simulat5_deepcan_test";

		//open a connection to the Postgre database on the same server, using the connection information
		$databaseconnection = pg_connect("localhost", $database, $username, $password);

		//create query statements that will be executed
		$query = "SELECT * FROM Sailors S, Reserves R, Boats B";

		//execute the query
		$results = pg_query($databaseconnection, $query);

		//display the results on the screen, using a while loop to account for multiple rows/columns
		echo "<table>\n";
		while($row = pg_fetch_array($results, null, PGSQL_ASSOC)){
			echo "\t<tr>\n";
			foreach ($row as $col_value){
				echo "\t\t<td>$col_value</td>\n";
			}
			echo "\t</tr>\n";
		}
		echo "\t</tr>\n";
		

			//Create a shorthand for the data in the form, i.e. variables we can use.
			$termA = $_REQUEST['searchTermA'];
			$termB = $_REQUEST['searchTermB'];
			$termC = $_REQUEST['searchTermC'];

			//Display the submitted information using the created variables inside an echo command
			echo "<p> Search query terms received</p>
					<p>You entered $termA $termB $termC </p>";

		//close the database connection 
		pg_close($databaseConnection);

		?>


	</body>
	

</html>