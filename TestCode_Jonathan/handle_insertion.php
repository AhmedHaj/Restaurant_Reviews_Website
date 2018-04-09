<!-- 
	This code supports the website  DeepCan.com 
	This code could copied and used directly within other pages, but for efficiency and maintenance one instances of this code is being used by reference in multiple contexts. In this way it serves as universal search handler.
  
	Author: Jonathan Calles 8906650 (jcall057@uottawa.ca) and Ahmed Haj Abdel Khaleq 8223727 (ahaja032@uottawa.ca)
		Last Updated: 2018-04-08

  	Advisory:
  		This website is a testing ground. Experimental and non-functional features may result.
	
	Development History:
	    2018-04-08 - Code initiated
	    2018-04-09 - Added the ability to add/delete Ratings, Add Restaurants, and Add Menu Item Ratings.

  	Planned:
    	- Set-up the different cases, with all the different SQL inserts to meet the requirements.
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

		//Perform different SQL insertions depending on the context
		switch (true) {

			case ($callingPage == "index" and $callingButton == "submit_add_restaurant"):

				//Create a shorthand for the data in the insert form, i.e. a variable we can use.
				$input1 = $_REQUEST["submit_add_restaurant_name"];
				$input2 = $_REQUEST["submit_add_restaurant_type"];
				$input3 = $_REQUEST["submit_add_restaurant_url"];
				//Manually escape apostrophes in the string
				$input1 = str_replace("'","''", $input1);
				$input2 = str_replace("'","''", $input2);
				$input3 = str_replace("'","''", $input3);
				//Display the submitted information using the created variables inside an echo command
				echo "	<p>You entered: $input1</p>
						<p>You entered: $input2</p>
						<p>You entered: $input3</p>";
				//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
				//http://php.net/manual/en/function.pg-escape-string.php
				$name = pg_escape_string($input1);
				$type = pg_escape_string($input2);
				$url = pg_escape_string($input3);

				//Find the last ID to compute the next ID
				$query = "SELECT MAX(restaurantid) FROM restaurant";
				$results = pg_query($databaseconnection, $query);
				$row = pg_fetch_row($results, 0);
				$value_cut = substr($row[0], 1);
				$val_next_id_num = $value_cut+1;
					echo"<p>Row to insert: $val_next_id_num</p>";
				
				//create insert statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				$query = "INSERT INTO restaurant(RestaurantID,Name,Type,URL) VALUES ('R{$val_next_id_num}','{$name}','{$type}','{$url}');";

				//execute insertion
				pg_query($databaseconnection, $query);

				//verify insertion was done at the right place
				$query = "SELECT MAX(restaurantid) FROM restaurant";
				$results = pg_query($databaseconnection, $query);
				$row = pg_fetch_row($results, 0);
				$val_last_id = $row[0];
					echo"<p>New Last RestaurantID: $val_last_id";

				break;

			case ($callingPage == "restaurant" and $callingButton == "submit_add_rating"):

				//Create a shorthand for the data in the insert form, i.e. a variable we can use.
				$input1 = $_REQUEST["submit_add_rating_price"];
				$input2 = $_REQUEST["submit_add_rating_food"];
				$input3 = $_REQUEST["submit_add_rating_mood"];
				$input4 = $_REQUEST["submit_add_rating_staff"];
				$input5 = $_REQUEST["submit_add_rating_comment"];
				$input6 = $_REQUEST["submit_add_rating_res_id"];

				//Manually escape apostrophes in the string
				$input5 = str_replace("'","''", $input5);
				
				
				//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
				//http://php.net/manual/en/function.pg-escape-string.php
				$comment = pg_escape_string($input5);
				$val_res_id = $input6;
				
				/*
				//Retrieving the userid
				$query = "SELECT MAX(restaurantid) FROM restaurant";
				$results = pg_query($databaseconnection, $query);
				$row = pg_fetch_row($results, 0);
				$value_cut = substr($row[0], 1);
				$val_next_id_num = $value_cut+1;
					echo"<p>Row to insert: $val_next_id_num</p>";

				Hardcoding the account for demo purpose
				*/
				$val_next_id_num = 'RA02';
				//create insert statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				$query = "INSERT INTO rating(UserID,Date,price,food,mood,staff,comments,restaurantID) VALUES ('{$val_next_id_num}','{$date}',$input1,$input2, $input3,$input4, '{$comment}', '{$val_res_id}');";

				//execute insertion
				pg_query($databaseconnection, $query);

				echo "<meta http-equiv='refresh' content='0'>";

				break;
				

			case ($callingPage == "restaurant" and $callingButton == "submit_delete_rating"):
				
				//Create a shorthand for the data in the insert form, i.e. a variable we can use.
				$input1 = $_REQUEST["submit_delete_rating_id"];
				$input2 = $_REQUEST["submit_delete_rating_date"];
			

				//Manually escape apostrophes in the string
				$input1 = str_replace("'","''", $input1);
				

			

				//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
				//http://php.net/manual/en/function.pg-escape-string.php
				$val_rater_id = pg_escape_string($input1);
				$val_date = $input2;
				
				
	
				//create insert statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				$query = "DELETE FROM rating  
						  WHERE userid = '{$val_rater_id}'
						  	AND
						  		date = '{$val_date}';";
	

				//execute insertion
				pg_query($databaseconnection, $query);

				echo "<meta http-equiv='refresh' content='0'>";

				break;

			

			case ($callingPage == "restaurant" and $callingButton == "submit_delete_item_rating"):
				
				//Create a shorthand for the data in the insert form, i.e. a variable we can use.
				$input1 = $_REQUEST['submit_delete_item_rating_id'];
				$input2 = $_REQUEST['submit_delete_item_rating_date'];
				$Input3 = $_REQUEST['submit_delete_item_rating_item'];

			

				//Manually escape apostrophes in the string
				$input1 = str_replace("'","''", $input1);
				$input3 = str_replace("'","''", $input3);
				

				

				//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
				//http://php.net/manual/en/function.pg-escape-string.php
				$val_rater_id = pg_escape_string($input1);
				$val_date = $input2;
				$val_item_id = pg_escape_string($input3);
				
				
				
	
				//create insert statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				$query = "DELETE FROM ratingItem 
						  WHERE userid = '{$val_rater_id}'
						  	AND
						  		date = '{$val_date}'
						  	AND 
						  		itemid = '{$val_item_id}';";
				

				//execute insertion
				pg_query($databaseconnection, $query);

				echo "<meta http-equiv='refresh' content='0'>";

				break;

			

			case ($callingPage == "restaurant" and $callingButton == "submit_add_item_rating"):

				//Create a shorthand for the data in the insert form, i.e. a variable we can use.
				$input1 = $_REQUEST["submit_add_rating_item_rating"];
				$input2 = $_REQUEST["submit_add_rating_item_comment"];
				$input3 = $_REQUEST["submit_add_rating_item_name"];

				

				//Manually escape apostrophes in the string
				$input2 = str_replace("'","''", $input2);
				$input3 = str_replace("'","''", $input3);
				
				
				//saves the input as an escaped string. Strings need to be sanitized before being used in an SQL query for safety, to escape non-compatible characters, take into account the current charset of the connection, and for security (e.g. SQL injections). SQL queries may not work if not using an escaped string variable.
				//http://php.net/manual/en/function.pg-escape-string.php
				$val_comment = pg_escape_string($input2);
				$val_date = $date;
				$val_rating = $input1;
				$val_item_name = pg_escape_string($input3);
				
				
				//Retrieving item name
				$query = "SELECT itemid from menuitem where name LIKE '%{$val_item_name}'";
				$results = pg_query($databaseconnection, $query);
				$row = pg_fetch_row($results, 0);
				$val_item_id = $row[0];
					

				
				
				$val_user_id = 'RA02';
				//create insert statements that will be executed. 
				//Can use PHP variables, but note the {} that need to go around the PHP variables
				$query = "INSERT INTO ratingItem(UserID,Date,ItemID,rating,comment) VALUES ('{$val_user_id}','{$val_date}','{$val_item_id}',$val_rating,'{$val_comment}');";

				//execute insertion
				pg_query($databaseconnection, $query);

				echo "<meta http-equiv='refresh' content='0'>";

				break;
				

			//perform default if non of the cases match
			default:
				# code...
				break;
		}



		//convert the rows from the result into a 2D array
		//print an error if $results was empty, i.e. nothing was retrieved from the SQL query
		/*
		$arr = pg_fetch_all($results);
		if(empty($arr)){
			echo "<p><b> Error - No results matching your query </b></p>";
			echo "<p><b> Note: the search is case sensitive (for now) </b></p>";
		}
		*/

			
		//close the database connection 
		pg_close($databaseconnection);


		
		?>