<?php 
    include 'connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    if (!isset($user_id)) {
        header('location:login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header("location: login.php");
    }
    if (isset($_POST['submit-btn'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name= '$name' AND email='$email' AND $number = '$number' AND message= '$message'") or die('query failed');
        if (mysqli_num_rows($select_message)>0) {
            echo 'message already send';
        }else{
            mysqli_query($conn, "INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES('$user_id','$name','$email','$number','$message')") or die('query failed');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------------------------bootstrap icon link------------------------------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="main.css">
    <title>Mihimihi - contact us page</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>contact Us</h1>
            <p> It's your gateway to reaching out,
                 whether you have questions, feedback,<br> or simply want to connect. </p>
            <a href="index.php">home </a><span>/ contact</span>
        </div>
    </div>
    <div class="line"></div>
    <!-----------------------FAQ------------------------>
    <h1 class="title">F A Q</h1>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="img/26.jpg">
                <div>
                    <h1>What payment methods do we accept ?</h1>
    				<p>We accept cash on delivery(COD) and online banking.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/27.jpg">
                <div>
                    <h1>Is my personal information safe during purchases ?</h1>
    				<p>Yes, we take your privacy and security seriously. Our website uses secure encryption technology to protect your personal and financial information.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/28.jpg">
                <div>
                    <h1> How can I stay updated on promotions and new arrivals ?</h1>
    				<p>To stay informed about our latest promotions, new product arrivals, and exclusive offers, you can subscribe to our newsletter or follow us on social media.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <div class="form-container">
        <h1 class="title">Sent a message</h1>
        <form method="post">
            <div class="input-field">
                <label>full name</label><br>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>email address</label><br>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>phone number</label><br>
                <input type="number" name="number">
            </div>
            <div class="input-field">
                <label>your message</label><br>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">send message</button>
        </form>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="address">
        <h1 class="title">OUR FOUNDER</h1>
        <div class="row">
            <div class="box">
                <i class="bi bi-pen-fill"></i>
                <div>
                    <h4>company name</h4>
                    <p>YumLab Sdn. Bhd.</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-pin-fill"></i>
                <div>
                    <h4>Address</h4>
                    <p>Kawasan Perindustrian Meru Selatan,<br>
                    41050 Klang, Selangor</p>
                </div>
            </div>
            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <h4>email</h4>
                    <p>yumlab@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>