<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acceuil</title>
    
    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome">
    <!-- custom css file link-->
    <link rel="stylesheet" href="../css/acceuil_style.css">
</head>
<body style="padding-left:0rem ; background-color: white;">
<header class="header" >
    <section class="flex">
        <img src="../images/myLogo.jpeg" style="width: 200px;" alt="">
        <!--<a href="dashboard.php" class="logo">TimoneY.</a>-->
        <!--<form action="search_page.php" method="post" class="search-form">
            <input type="text" placeholder="search here..." required maxlength="100" name="search_box">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form>-->
  
        <div class="menu" style="display: flex; gap:4rem ; text-decoration:none; font-size:1.8rem; padding-top:0.7rem ; color:black">
            <a class="nav-link" href="#"><p class="menu-link" >Home  <span class="arrow"></span></p></a>
            <a class="nav-link" href="#"><p class="menu-link">Services  <span class="arrow"></span> </p></a>
            <a class="nav-link" href="#"><p class="menu-link">Contacts  <span class="arrow"></span></p></a>
            <a class="nav-link" href="../admin/sign.php" id="connexion1" ><p class="menu-link">connexion <span class="arrow"></span></p></a>
        </div>

        
        <div class="login" style="display: flex;gap:1rem; padding-top:0rem ;">
                <a href="../admin/sign.php" class="btn " id="connexion">Connexion</a>
                <!--<a href="../admin/register.php" class="btn">Log In </a>-->
                
                
        </div>

        <div class="icons" style="padding-top:0.8rem ;">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
        </div>

    </section>
</header>
<section class="about">
    <div class="row">
        
        <div class="content">
            <h3>welcome to your timoney?</h3>
            <p>for every minute spent organizing , an hour is earned.threfore, <span>Timoney</span> is your choice  for both organizing 
            your <span>Time</span> and organizing your <span>money</span></p><br><br>
            <a href="courses.html" class="inline-btn btn">go</a>
        </div>
        <div class="image">
            <img src="../images/photo_welcome.jpeg" alt="">
        </div>
    </div>














<script>
    let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .flex .menu');

menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};
window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};
</script>

    
</body>
</html>
