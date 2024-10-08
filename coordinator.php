<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<style>
.container {
	width: 50%;
	margin: auto;
	padding: 20px;
	background-color: #f2f2f2;
	border-radius: 5px;
	box-shadow: 0px 0px 10px #ccc;
}

form {
	display: flex;
	flex-direction: column;
	align-items: center;
}

label {
	margin-top: 10px;
}

input {
	padding: 10px;
	margin: 10px 0;
	width: 100%;
	border-radius: 5px;
	border: none;
}

button {
	padding: 10px;
	margin: 10px 0;
	width: 100%;
	background-color: #4CAF50;
	color: white;
	border: none;
	border-radius: 5px;
	cursor: pointer;
}

button:hover {
	background-color: #3e8e41;
}
</style>
	<div class="container">
		<form method="post" action="coordinator.php">
			<h1>Login</h1>
			<label for="coordinator_id">Coordinator ID</label>
			<input type="text" id="coordinator_id" name="coordinator_id" required>
			<label for="password">Password</label>
			<input type="password" id="password" name="password" required>
			<button type="submit" name="login">Login</button>
		</form>
	</div>
</body>
</html>
<?php
session_start();
$error = '';

if (isset($_POST['login'])) {
	if (empty($_POST['coordinator_id']) || empty($_POST['password'])) {
		$error = 'Please enter both your coordinator ID and password';
	} else {
		$coordinator_id = $_POST['coordinator_id'];
		$password = $_POST['password'];

		// Check if the coordinator ID and password are correct
		if ($coordinator_id === 'IITP_ADMIN' && $password === 'iitp@2023') {
			// Redirect to the home page
			header('Location: home.php');
			exit;
		} else {
			$error = 'Incorrect coordinator ID or password';
		}
	}
}
?>
