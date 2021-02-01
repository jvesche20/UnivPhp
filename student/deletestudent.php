<?php
		require_once('../mysqli_connect.php');
		
		$student_id = trim($_GET['student_id']);
		
		$query = "DELETE FROM STUDENTS WHERE student_id=?";
		
		$stmt = mysqli_prepare($dbc, $query);
		
		mysqli_stmt_bind_param($stmt, "i", $student_id);
		
		mysqli_stmt_execute($stmt);
		
		echo mysqli_error($dbc);
?>
<html>
<head>
<title>Student Deleted</title>
</head>
<body style="background-color:crimson;">
<a href="getstudentinfo.php"><b>Go back</b></a><br /><br />
<a href="../"><b>Go home</b></a><br /><br />
<br /><br />
The student has been deleted.
</body>
</html>