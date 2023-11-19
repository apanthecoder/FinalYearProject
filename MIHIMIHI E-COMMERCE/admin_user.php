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

    // Delete users from the database
    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        
        mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
        $message[] = 'User removed successfully';
        header('location:admin_user.php');
    }

    // Add a new admin
    if (isset($_POST['add_admin'])) {
        $new_admin_name = $_POST['new_admin_name'];
        $new_admin_email = $_POST['new_admin_email'];
        $new_admin_password = $_POST['new_admin_password'];

        // You should hash the password before saving it to the database for security reasons.
        // You can use password_hash() for this.

        $hashed_password = password_hash($new_admin_password, PASSWORD_DEFAULT);

        mysqli_query($conn, "INSERT INTO `users`(`name`, `email`, `password`, `user_type`) VALUES ('$new_admin_name', '$new_admin_email', '$hashed_password', 'admin')") or die('query failed');
        $message[] = 'New admin added successfully';
        header('location:admin_user.php');
    }
?>
<style type="text/css">
    <?php include 'style.css'; ?>
</style>
<link rel="stylesheet" href="admin_form.css">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>admin panel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '
                <div class="message">
                    <span>' . $message . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
            ';
        }
    }
    ?>
    <div class="line4"></div>

    <!--  new admin -->
    <section class="add-admin-form">
        <h2>Add a New Admin</h2>
        <form method="post">
            <div class="input-field">
                <label>Name</label>
                <input type="text" name="new_admin_name" required>
            </div>
            <div class="input-field">
                <label>Email</label>
                <input type="email" name="new_admin_email" required>
            </div>
            <div class "input-field">
                <label>Password</label>
                <input type="password" name="new_admin_password" required>
            </div>
            <input type="submit" name="add_admin" value="Add Admin" class="btn">
        </form>
    </section>
<br>
<br>
<br>
<br>

    <section class="message-container">
        <h1 class="title">Total User Accounts</h1>
        <div class="box-container">
            <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            if (mysqli_num_rows($select_users) > 0) {
                while ($fetch_users = mysqli_fetch_assoc($select_users)) {
                    ?>
                    <div class="box">
                        <p>User ID: <span><?php echo $fetch_users['id']; ?></span></p>
                        <p>Name: <span><?php echo $fetch_users['name']; ?></span></p>
                        <p>Email: <span><?php echo $fetch_users['email']; ?></span></p>
                        <p>User Type: <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                            echo 'orange';
                        } ?>"><?php echo $fetch_users['user_type']; ?></span></p>
                        <a href="admin_user.php?delete=<?php echo $fetch_users['id']; ?>"
                           onclick="return confirm('Delete this user');" class="delete">Delete</a>
                    </div>
                    <?php
                }
            } else {
                echo '
                    <div class="empty">
                        <p>No users added yet!</p>
                    </div>
                ';
            }
            ?>
        </div>
    </section>
</body>
</html>
