<!-- Currently this php code, as it stands, will generate a new webpage for easy testing. 
	However this code could function directly within index.html -->

<!doctype html>
<html>
	<head>
		<title>Search Query Feedback</title>
	</head>

	<body>
		<?php #this php code handles input data from the search form on index.html

		//Create a shorthand for the data in the form, i.e. variables we can use.
		$termA = $_REQUEST['searchTermA'];
		$termB = $_REQUEST['searchTermB'];
		$termC = $_REQUEST['searchTermC'];

		//Display the submitted information using the created variables inside an echo command
		echo "<p> Search query terms received</p>
				<p>You entered $termA $termB $termC </p>";
		?>


	</body>
	

</html>