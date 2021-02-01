<html>
<head>
<title>Edit Student</title>
</head>
<body style="background-color:cornflowerblue; color:white;">
<a href="../"><b>Go back</b></a><br /><br />
<?php
 require_once('../mysqli_connect.php');

if(isset($_GET['student_id'])){
	$student_id = $_GET['student_id'];
	
	// Create a query for the database
	$select_query = "SELECT student_id, first_name, last_name, email, street, city, state, zip,
	phone, birth_date, sex, lunch_cost FROM students
	WHERE student_id = '$student_id'
	";
        
        $response = @mysqli_query($dbc, $select_query);
	if($response){
		while($row = mysqli_fetch_array($response)){
?>

<form action="editstudent.php?student_id=<?php echo $row['student_id']; ?>" method="post">
    
    <b>Edit an existing Student</b>

<p>Student ID:
<input type="text" readonly name="student_id" size="30" value="<?php echo $row['student_id']; ?>" />
</p>

    <p>First Name:
<input type="text" name="first_name" size="30" value="<?php echo $row['first_name']; ?>" />
</p>

<p>Last Name:
<input type="text" name="last_name" size="30" value="<?php echo $row['last_name']; ?>" />
</p>

<p>Email:
<input type="text" name="email" size="30" value="<?php echo $row['email']; ?>" />
</p>

<p>Street:
<input type="text" name="street" size="30" value="<?php echo $row['street']; ?>" />
</p>

<p>City:
<input type="text" name="city" size="30" value="<?php echo $row['city']; ?>" />
</p>

<p>State (2 Characters):
<input type="text" name="state" size="30" maxlength="2" value="<?php echo $row['state']; ?>" />
</p>

<p>Zip Code:
<input type="text" name="zip" size="30" maxlength="5" value="<?php echo $row['zip']; ?>" />
</p>

<p>Phone Number:
<input type="text" name="phone" size="30" value="<?php echo $row['phone']; ?>" />
</p>

<p>Birth Date (YYYY-MM-DD):
<input type="text" name="birth_date" size="30" value="<?php echo $row['birth_date']; ?>" />
</p>

<p>Sex (M or F):
<input type="text" name="sex" size="30" maxlength="1" value="<?php echo $row['sex']; ?>" />
</p>

<p>Lunch Cost:
<input type="text" name="lunch_cost" size="30" value="<?php echo $row['lunch_cost']; ?>" />
</p>

<p>
    <input type="submit" name="submit" value="Update" />
</p>
    
</form>
</body>
</html>

<?php
		}
	}
}
else{
	die("Param student_id not provided.");
}


if(isset($_POST['submit'])){
    
    $data_missing = array();
    
    if(empty($_POST['first_name'])){

        // Adds name to array
        $data_missing[] = 'First Name';

    } else {

        // Trim white space from the name and store the name
        $f_name = trim($_POST['first_name']);

    }

    if(empty($_POST['last_name'])){

        // Adds name to array
        $data_missing[] = 'Last Name';

    } else{

        // Trim white space from the name and store the name
        $l_name = trim($_POST['last_name']);

    }

    if(empty($_POST['email'])){

        // Adds name to array
        $data_missing[] = 'Email';

    } else {

        // Trim white space from the name and store the name
        $email = trim($_POST['email']);

    }

    if(empty($_POST['street'])){

        // Adds name to array
        $data_missing[] = 'Street';

    } else {

        // Trim white space from the name and store the name
        $street = trim($_POST['street']);

    }

    if(empty($_POST['city'])){

        // Adds name to array
        $data_missing[] = 'City';

    } else {

        // Trim white space from the name and store the name
        $city = trim($_POST['city']);

    }

    if(empty($_POST['state'])){

        // Adds name to array
        $data_missing[] = 'State';

    } else {

        // Trim white space from the name and store the name
        $state = trim($_POST['state']);

    }

    if(empty($_POST['zip'])){

        // Adds name to array
        $data_missing[] = 'Zip Code';

    } else {

        // Trim white space from the name and store the name
        $zip = trim($_POST['zip']);

    }

    if(empty($_POST['phone'])){

        // Adds name to array
        $data_missing[] = 'Phone Number';

    } else {

        // Trim white space from the name and store the name
        $phone = trim($_POST['phone']);

    }

    if(empty($_POST['birth_date'])){

        // Adds name to array
        $data_missing[] = 'Birth Date';

    } else {

        // Trim white space from the name and store the name
        $b_date = trim($_POST['birth_date']);

    }

    if(empty($_POST['sex'])){

        // Adds name to array
        $data_missing[] = 'Sex';

    } else {

        // Trim white space from the name and store the name
        $sex = trim($_POST['sex']);

    }

    if(empty($_POST['lunch_cost'])){

        // Adds name to array
        $data_missing[] = 'Lunch Cost';

    } else {

        // Trim white space from the name and store the name
        $lunch_cost = trim($_POST['lunch_cost']);

    }
	
	if(empty($_POST['student_id'])){

        // Adds name to array
        $data_missing[] = 'Student ID';

    } else {

        // Trim white space from the name and store the name
        $student_id = trim($_POST['student_id']);

    }
    
    if(empty($data_missing)){
		
		$query = "UPDATE students SET
		first_name = '$f_name',
		last_name = '$l_name',
		email = '$email',
		street = '$street', city = '$city', state = '$state',
		zip = '$zip', phone = '$phone', birth_date = '$b_date', sex = '$sex',
		lunch_cost = '$lunch_cost'
		WHERE student_id='$student_id'
		";
        
        $stmt = mysqli_prepare($dbc, $query) or die(mysqli_error($dbc));
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if($affected_rows == 1){
            
            echo 'Student Updated';
            
			header('location: getstudentinfo.php?student_updated=1');
			
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        } else {
            
            echo 'Error Occurred<br />';
            echo mysqli_error($dbc);
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        }
        
    } else {
        
        echo 'You need to enter the following data<br />';
        
        foreach($data_missing as $missing){
            
            echo "$missing<br />";
            
        }
        
    }
    
}

?>