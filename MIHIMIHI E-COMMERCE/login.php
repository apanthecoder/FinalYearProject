<?php
include 'connection.php';
session_start();

if (isset($_POST['submit-btn'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);
        if (password_verify($password, $row['password'])) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['admin_email'] = $row['email'];
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_pannel.php');
            } else if ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                header('location:index.php');
            } else {
                $message[] = 'Incorrect email or password';
            }
        } else {
            $message[] = 'Incorrect email or password';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--box icon link-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Register page</title>
</head>
<body>
	
	
	<section class="form-container">
		<?php 
			if (isset($message)) {
				foreach ($message as $message) {
					echo '
						<div class="message">
							<span>'.$message.'</span>
							<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
						</div>

					';
				}
			}
		?>
		<form method="post">
			<h1>login now</h1>
			<div class="input-field">
				<label> email</label><br>
				<input type="email" name="email" placeholder="enter your email" required>
			</div>
			<div class="input-field">
				<label> password</label><br>
				<input type="password" name="password" placeholder="enter your password" required>
			</div>
			<input type="submit" name="submit-btn" value="login now" class="btn">
			<p>Do not have an account ? <a href="register.php">register now</a></p>
		</form>

		<div class="user-manual">
            <h2>User Manual</h2>
            <p>1 - user need to register if dont have an account.<br>
			   2 - user can insert email and password to login.<br>
			   3 - user can browse the website/ placed an order/ payment.<br>  </p>
			<h2>Admin Manual</h2>
			<p>1 - admin need to login by insert email and password.<br>
			   2 - admin able to CRUD any data. <br>
			   3 - admin able to add new admin. </p>
        </div>
	</section>
</body>
</html>