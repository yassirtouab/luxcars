<?php
error_reporting(0);
$success = "";
$fail = "";

if(isset($_POST['send'])){
    $email= $_POST['email'];
    $full_name= $_POST['full_name'];
    $subject= $_POST['subject'];
    $message= $_POST['message'];
    $headers = 'From:' . $full_name . '(' . $email . ')' ;
    $send = mail($email,$subject,$message,$headers);
    if($send){
        $success= "message was sent successfully";
    }
    else{
      try{
        $db = new PDO("mysql:host=localhost;dbname=contact","root","");
        $sql = "INSERT INTO contactus VALUES(NULL,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(1,$full_name,PDO::PARAM_STR);
        $stmt->bindValue(2,$email,PDO::PARAM_STR);
        $stmt->bindValue(3,$subject,PDO::PARAM_STR);
        $stmt->bindValue(4,$message,PDO::PARAM_STR);
        $stmt->execute();
        $db=NULL;
        $success= "message was submitted successfully";
      }
      catch(PDOException $e){
        $fail = "there is an error try again later";
      }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="contact.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="nav" id="nav">
          <input type="checkbox" id="nav-check">
          <div class="nav-header">
            <div class="nav-title">
              <h1>luxcars</h1>
            </div>
          </div>
          <div class="nav-btn">
            <label for="nav-check">
              <span></span>
              <span></span>
              <span></span>
            </label>
          </div>
          <div class="nav-links">
            <a href="home.html">home</a>
            <a href="#">contact</a>
            <a href="home.html#testimonials" >testimonials</a>
            <a href="about.html">about</a>
            <a href="home.html#buy">buy now</a>
          </div>
        </div>
        <div class="" id="scrollFix"></div>
        <div class="hero_text">
          <h1>contact us</h1>
        </div>
        <div class="hero_form">
          <form id="contact_form" action="#" method="post">
              <input minlength="8" name="full_name" type="text" placeholder="Full Name" required>
              <input name="email" type="email" placeholder="Email" required>
              <input minlength="2" name="subject" type="text" placeholder="Subject" required>
              <textarea minlength="8" maxlength="255" name="message" placeholder="Please enter a message" name="message" id="message" cols="30" rows="10" required></textarea>
              <input id="sned_btn" name="send" placeholder="send" value="Send" type="submit">
              <div class="success"><?= $success;?></div>
              <div class="fail"><?= $fail;?></div>

          </form>
        </div>
    </header>
    <footer>
            <div class="footer_heading__text">
                <h1>top brands</h1></div>
            <div class="footer_image">
                <img src="content/logos-slider.jpg">
            </div>
            
    </footer>
<script>
// sticky navbar code
window.onscroll = function() {myFunction()};
var navbar = document.getElementById("nav");
var scrollFix = document.getElementById("scrollFix");
var navbarHeight = document.getElementById("nav").offsetHeight;

function myFunction() {
  if (window.pageYOffset >= navbarHeight ) {
    navbar.classList.add("sticky");
    scrollFix.classList.add("scrollFix");
  } else {
    navbar.classList.remove("sticky");
    scrollFix.classList.remove("scrollFix");
  }
}
</script>
</body>
</html>