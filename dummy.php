<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Did you changed your job?</h1>
    <form method="post" action="">
        <input type="submit" name="yes" value="Yes">
        <input type="submit" name="no" value="No">
    </form>
</body>
</html>

<?php
if(isset($_POST['yes'])) {
    // Redirect to another page
    header("Location: alumni_addinfo.php");
    exit;
} elseif(isset($_POST['no'])) {
    // Handle "No" button click
    echo "You chose No.";
}
?>


