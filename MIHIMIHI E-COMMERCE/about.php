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
    <title>Mihimihi- About</title>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>about us</h1>
            <p>At Mihimihi, our journey is a testament to passion, dedication,<br> and a relentless pursuit of excellence.<br>
            Join us on this incredible journey and be a part of our story.
            </p>
            <a href="index.php">home </a><span>/ about us</span>
        </div>
    </div>
    <div class="line"></div>
    <!-----------------------about us------------------------>
    <div class="line2"></div>
    <div class="about-us">
        <div class="row">
            <div class="box">
                <div class="title">
                   
                    <h1>Hello, <br>this is Mihimihi!</h1>
                </div>
                <p>I am introducing you to our newest merchant, MIHIMIHI.
                We served French puff with a variety of flavored custards filling, such as matcha, vanilla, chocolate, strawberry, & hazelnut.
                What is great about our French puff is they are freshly baked to ensure the freshness.
                You can indulge your tastebuds with premium taste mascarpone custard filling.
                If you are looking for a healthy yet delicious snack, MIHIMIHI French Puffs will
                be perfect because they are low sugar, no preservative, and no coloring!</p>
            </div>
            <div class="img-box">
                <img src="img/about3.jpg">
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <!-----------------------features----------------------->
    <div class="line4"></div>
    <div class="features">
        <div class="title">
            <h1>Variety Promotions</h1>
            <span>in physical store only</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="img/icon.png">
                <h4>BUY 5 FREE 1</h4>
                <p>RM44.50</p>
            </div>
            <div class="box">
                <img src="img/icon.png">
                <h4>BUY 1 GET 2ND 50% OFF</h4>
                <p>only on Mon/Tue</p>
            </div>
            <div class="box">
                <img src="img/icon.png">
                <h4>Buy 2 / Buy 3</h4>
                <p>RM17 / RM25</p>
            </div>
            <div class="box">
                <img src="img/icon.png">
                <h4>Mini Set</h4>
                <p>1 for RM17.80 / 2 for RM31.90</p>
            </div>
        </div>
    </div>
    <div class="line"></div>
    
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>

</html>