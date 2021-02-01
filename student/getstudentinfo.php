<body style="background-color:#ff00ff; color:white;">
<a href="../"><b>Go back</b></a><br />
<?php
// Get a connection for the database
require_once('../mysqli_connect.php');


if(isset($_GET['student_updated'])) {
    if ($_GET['student_updated'] == "1") {
        echo 'Update successful!';
    }
}


// Create a query for the database
$query = "SELECT student_id, first_name, last_name, email, street, city, state, zip,
phone, lunch_cost, birth_date FROM students";

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr>
<td align="left"><b>Edit</b></td>
<td align="left"><b>Delete</b></td>
<td align="left"><b>ID</b></td>
<td align="left"><b>First Name</b></td>
<td align="left"><b>Last Name</b></td>
<td align="left"><b>Email</b></td>
<td align="left"><b>Street</b></td>
<td align="left"><b>City</b></td>
<td align="left"><b>State</b></td>
<td align="left"><b>Zip</b></td>
<td align="left"><b>Phone</b></td>
<td align="left"><b>Lunch Cost</b></td>
<td align="left"><b>Birth Day</b></td>
</tr>';

$total_lunch_cost = 0;

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){
	
	$total_lunch_cost = $total_lunch_cost + $row['lunch_cost'];

echo '<tr><td align="left">' . 
'<a href="editstudent.php?student_id=' . $row['student_id']  . '">Edit</a>' . '</td><td align="left">' . 
'<a href="deletestudent.php?student_id=' . $row['student_id']  . '">Delete</a>' . '</td><td align="left">' . 
$row['student_id'] . '</td><td align="left">' . 
$row['first_name'] . '</td><td align="left">' . 
$row['last_name'] . '</td><td align="left">' .
$row['email'] . '</td><td align="left">' . 
$row['street'] . '</td><td align="left">' .
$row['city'] . '</td><td align="left">' . 
$row['state'] . '</td><td align="left">' .
$row['zip'] . '</td><td align="left">' . 
$row['phone'] . '</td><td align="left">' .
$row['lunch_cost'] . '</td><td align="left">' .
$row['birth_date'] . '</td><td align="left">';

echo '</tr>';
}

echo '</table>';

echo "<br />";
echo "Total lunch cost: $$total_lunch_cost.";
echo "<br />";

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);

}

// Close connection to the database
mysqli_close($dbc);

?>
</body>