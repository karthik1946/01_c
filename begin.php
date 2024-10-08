<!DOCTYPE html>
<html>
<head>
	<title>IIT Patna Placements</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
			background-color: #F8F8F8;
            background-image: url('https://cache.careers360.mobi/media/article_images/2023/2/18/iit-patna-featured-image.jpg');
            background-repeat: no-repeat;
            background-size: cover;
		}

		h1 {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  color: white;
}



p {
    text-align: center;
    margin-top: 0;
    font-size: 20px;
    font-weight: bold;
    color: white;

}


		form {
			display: flex;
			flex-direction: row;
			justify-content: center;
			margin-top: 30px;
		}

		input[type="submit"] {
    background-color: #004F9F;
    border: none;
    color: white;
    padding: 15px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease-in-out;
}

		input[type="submit"]:hover {
			background-color: #005EA6;
		}
	</style>
</head>
<body>
	<h1>Welcome to the IIT Patna Placements website</h1>
	<p>A onestop solution for all queries regarding Placements </p>
	<p>Please choose your category:</p>
	<form method="post" action="">
		<input type="submit" name="student" value="Student">
		<input type="submit" name="recruiter" value="Recruiter">
		<input type="submit" name="alumni" value="Alumni">
		<input type="submit" name="Trends" value="Trends">
		<input type="submit" name="Coordinator" value="Coordinator">
	</form>

	<?php
		if(isset($_POST['student'])) {
			header('Location: http://localhost/student.php');
			exit();
		} elseif(isset($_POST['recruiter'])) {
			header('Location: http://localhost/company_register.php');
			exit();
		} elseif(isset($_POST['alumni'])) {
			header('Location: http://localhost/alumni.php');
			exit();
		}
		elseif(isset($_POST['Trends'])) {
			header('Location: http://localhost/random.php');
			exit();
		}
		elseif(isset($_POST['Coordinator'])) {
			header('Location: http://localhost/coordinator.php');
			exit();
		}
	?>
</body>
</html>
