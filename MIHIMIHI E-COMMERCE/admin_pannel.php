<?php 

	include 'connection.php';
	session_start();
	$admin_id = $_SESSION['admin_name'];

	if (!isset($admin_id)) {
		header('location:login.php');
	}

	if (isset($_POST['logout'])) {
		session_destroy();
		header('location:login.php');	
	}
?>
<style type="text/css">
	<?php 
		include 'style.css';

	?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--box icon link-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	
	<title>admin panel</title>
</head>
<body>
	<?php include 'admin_header.php'; ?>
	<div class="line4"></div>
	<section class="dashboard">
		<div class="box-container">
			<div class="box">
				<?php 
					$total_pendings = 0;
					$select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
					while ($fetch_pending = mysqli_fetch_assoc($select_pendings)) {
						$total_pendings += $fetch_pending['total_price'];
					}
				?>
				<h3>RM <?php echo $total_pendings; ?></h3>
				<p>total pendings</p>
			</div>
			<div class="box">
				<?php 
					$total_completes = 0;
					$select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'complete'") or die('query failed');
					while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
						$total_completes += $fetch_completes['total_price'];
					}
				?>
				<h3>RM <?php echo $total_completes; ?></h3>
				<p>total completed</p>
			</div>
			<div class="box">
				<?php 
					$select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
					$num_of_orders = mysqli_num_rows($select_orders);
				?>
				<h3><?php echo $num_of_orders; ?></h3>
				<p>order placed</p>
			</div>
			
			<div class="box">
				<?php 
					$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
					$num_of_users = mysqli_num_rows($select_users);
				?>
				<h3><?php echo $num_of_users; ?></h3>
				<p>total normal users</p>
			</div>
			<div class="box">
				<?php 
					$select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
					$num_of_admin = mysqli_num_rows($select_admins);
				?>
				<h3><?php echo $num_of_admin; ?></h3>
				<p>total admin</p>
			</div>
			<div class="box">
				<?php 
					$select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
					$num_of_users = mysqli_num_rows($select_users);
				?>
				<h3><?php echo $num_of_users; ?></h3>
				<p>total registered users</p>
			</div>
			<div class="box">
				<?php 
					$select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
					$num_of_message = mysqli_num_rows($select_message);
				?>
				<h3><?php echo $num_of_message; ?></h3>
				<p>new messages</p>
			</div>
		</div>
	</section>
	<div class="line4"></div>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>