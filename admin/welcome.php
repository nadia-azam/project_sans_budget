<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/welcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="./icone.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="icon" href="../images/myLogoLettreGrand.png" type="image/x-icon">

    <title>Timoney Welcome </title>
<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400&family=Roboto:wght@300&display=swap');

:root{
    --main-color : #0fb4bd;
    --black:#2c3e50;
    --white : white;
    --oragen : #f39c12;
    --red : #e74c3c;
    --light-black: #777;
    --light-white : #fff9;
    --dark-bg: rgba(0,0,0,.7);
    --liight-bg : #eee ;
    --border:.1rem solid rgba(0,0,0,.2);
    --box-shadow : 0 .5rem 1rem rgba(0,0,0,.1);
    --text-shadow : 0 .5rem 3rem rgba(0,0,0,.3);
}
*{
 
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none; border: none;
    text-decoration: none;
    
}

*::selection{
    background-color: var(--main-color);
    color: #fff;
}
*::-webkit-scrollbar {
    width: 1rem;
    height: .5rem;
}
*::-webkit-scrollbar-track {
    background-color: transparent;
}
*::-webkit-scrollbar-thumb {
    background-color: var(--main-color);
}
html{
    font-size: 62.5%;
    overflow-x: hidden;
}
body{
    padding-bottom: 9rem;
   }
section{
    padding: 2rem;
    margin: 0 auto;
    max-width: 1200px;
}

.header{
    position: sticky;
    top:0; left: 0; right: 0;
    background-color: var(--white);
    border-bottom: var(--border);
    z-index: 1000;
    box-shadow: var(--box-shadow);
   font-family: 'Nunito' , sans-serif;
}

.header .flex{
    display: flex;
    align-items: center;
    padding-top: 1rem;
    justify-content: space-between;
    position: relative;
}
.header .flex .logo{
    font-size: 2.5rem;
    color: var(--black);
}

.header .flex .icons div{
    margin-left: .5rem;
    height: 4.5rem;
    width: 4.5rem;
    line-height: 4.4rem;
    font-size: 2rem;
    color: var(--black);
    cursor: pointer;
    background-color: var(--liight-bg);
    text-align: center;
    border-radius: .5rem;
}

.header .flex .icons div:hover{
    color: var(--white);
    background-color: var(--black);
}

#connexion1{
    display: none;
}
.header .flex .menu a{
    color: var(--black);
}

.header .flex .menu a:hover{
    color: var(--main-color);
}

#connexion{
    background-color: black;
    color: var(--white);
}

.btn{
    margin-top: 1rem;
    border-radius: 2rem;
    padding: 1rem 3rem;
    cursor: pointer;
    color: #fff;
    font-size: 1.8rem;
    text-align: center;
    text-transform: capitalize;
}
.container {
  display: flex;
  align-items: center;
padding-left:1.5rem;
}
    
.text {
  flex: 1;
  padding-right: 60px; /* Espacement entre le texte et l'image */
}
#welcome{
    color: #18B7BE;
    font-weight: 200px;
    font-size:50px;
    padding-left: 2rem;
    font-style: italic;
    text-align: center;
    font-weight: initial;
    font-family: "Times New Roman", serif;
}
#img_welcome {
  width: 630px;
}

.box {
  height: 450px;
  background: linear-gradient(#F3EECF, #D6DADA, #A1D6E2, #A5DADA);
  position: relative;
  margin-top: 3rem;
}

.HB {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

#h {
  color: rgb(10, 9, 9);
  font-style: italic;
  margin-top: 3rem;
  text-align: center;
  font-weight: initial;
  font-family: "Times New Roman", serif;
  font-size: 3.1rem;
  
}
#go {
  text-decoration: none;
  color: hsl(0, 0%, 2%);
  font-size: 20px;
  letter-spacing: 2px;
  background: linear-gradient(225deg, #9fb0d6 0%, #25cfdb 50%, #f0e1b0 100%);
  border-radius: 40px;
  padding: 12px 32px;
  position: relative;
  overflow: hidden;
  border: none;
  cursor: pointer;
  box-shadow: 0px -0px 0px 0px rgb(137, 222, 243), 0px 0px 0px 0px rgba(39, 200, 255, 0.5);
margin-top:1.5rem;
}

#go:hover {
  background: linear-gradient(225deg, #367e6e 0%, #90c98b 50%, #f0e1b0 100%);

  transform: translate(0,-6px);
  box-shadow: 10px -10px 25px 0px rgba(6, 7, 7, 0.25), -10px 10px 25px 0px rgba(10, 21, 22, 0.25);

}
#go:hover ::after{

transform: rotate(150deg);
}

#CITATION{ 
  font-family: "Garamond", serif;
  font-size: 2.8rem;
  font-weight: 800;
  text-align: center;
  margin-top: 1rem;
}


#PAB{
margin-top: 1.2rem;
  text-align: center;
  font-size:12px;
}

.img {
  display: flex;
  align-items: center;
}

.footer{
  background-color: black;
  padding: 5rem 10% 12rem;
font-size:100%;
margin-bottom: -9rem;

}
.footer .box-footer{
  display: grid;
  grid-template-columns: repeat(auto-fit , minmax(18rem,1fr));/*auto-fit , minmax(10rem,1fr)*/
  grid-gap: 0.2rem;
}

.footer .box-footer .links h3{
  color: #1995AD;
  font-size: 2.2rem;
  padding-bottom: 1rem;
  padding-top: 2rem;
}
.footer .box-footer .links a{
  color: #BCBABE;
  font-size: 1.7rem;
  text-decoration: none;
  padding-bottom: 1rem; /* la disctance entre les a */
  line-height: 1;
  display: block;
  padding-top: 0.1rem;
}

.footer .box-footer .links a i{
  color:  #05B7C0;
  padding-right: .5rem;
  transition: .2s linear;
  padding-top: 1rem;

}
.footer .box-footer .links a:hover i{
  padding-right: 2rem;
}
#menu-btn{
    display: none;
}



.about .row{
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-top: 4rem;
}
.about .row .image{
    flex: 1 1 40rem;
}
.about .row .image img{
    width: 100%;
    height: 40rem;
    object-fit: cover;
}
.about .row .content {
    flex: 1 1 40rem;
    text-align: start;
}
.about .row .content h3{
    font-size: 4rem;
    color: var(--main-color);
    padding: 1.5rem 0;
    font-style: italic;
    text-align: center;
    font-weight: initial;
    font-family: "Times New Roman", serif;
    
}
.about .row .content p{
    line-height: 2;
    font-size: 2rem;
    color: var(--light-color);
    padding: 1.5rem 0;
    margin-top: 2rem;
    font-style: italic;
    text-align: center;
    font-weight: initial;
    font-family: "Times New Roman", serif;
}
.about .row .content p span{
    color: var(--main-color);
}




@media (max-width:768px) {
  #menu-btn{
      
      display: inline-block;
      height: 4.5rem;
    width: 4.5rem;
    line-height: 4.4rem;
    font-size: 2rem;
    color: var(--black);
    cursor: pointer;
    background-color: var(--liight-bg);
    text-align: center;
    border-radius: .5rem;

  }
  
  .header .flex .menu{
      position: absolute;
      top: 99%; left: 0; right: 0;
      background-color: var(--white);
      border-top: var(--border);
      padding: 2rem;
      clip-path: polygon(0 0 , 100% 0,100% 0,0 0);
  }
  .header .flex .menu.active{
      clip-path: polygon(0 0 , 100% 0,100% 100%, 0 100%);
  }
  .header .flex .menu a{
      display: block;
      margin: 2rem;
      text-align: center;
      align-items: center;
  }
  #connexion {
      display: none;
  }
  #connexion1{
      display: block;
  }
  #text2 {
    text-align: center;
  }
  .about .row .image img{
      
      height: 400px;
      width: 500px;
      object-fit: cover;
      text-align: center;
      align-items: center;
  }
  .about .row .content h3{
    text-align: center;
  }
  .about .row .content p{
    text-align: center;
  }
  #CITATION{ 
  
  font-size: 1.8rem;
  
 
}
#HB{
    margin-top: 1rem;
}

@media (max-width:620px) {
    .about .row .image img{
      
      height: 300px;
      width: 100%;
      object-fit: cover;
      text-align: center;
      margin-bottom: 3rem;
      padding-left: 2rem;
    }
  #CITATION{ 
  
  font-size: 1rem;
  font-weight: 700;
  margin-top: 2rem;
}
#h{
    font-size: 1.8rem;
}


}

}
@media (max-width:450px) {
  html{
      font-size: 50%;
  }
  .heading{
      font-size: 2.5rem;
  }
  body{
      padding-bottom: 12rem;
  }
  .header .flexs img{
      width: 150px;
  }
  .about .row .image img{
      
      padding-left: 2rem;
      
      
  }}
  @media screen and (max-width: 668px) {
    .box {
      height: 500px;
    
    }
    
    #h{
      font-weight: 150px;
      font-size:30px;
    
    }
    
    #CITATION{ 
      font-size: 18px;
      font-weight: bolder;
    }
    
    #PAB{
      font-size: 11px;
    }
    .header .flex .menu{
        position: absolute;
        top: 99%; left: 0; right: 0;
        background-color: var(--white);
        border-top: var(--border);
        padding: 2rem;
        clip-path: polygon(0 0 , 100% 0,100% 0,0 0);
    }
    .header .flex .menu.active{
        clip-path: polygon(0 0 , 100% 0,100% 100%, 0 100%);
    }
    .header .flex .menu a{
        display: block;
        margin: 1rem;
        text-align: center;
        font-size: 1.7rem;
    }
    
       }
    @media (min-width:862px) AND (max-width: 907px) {
        .image #img_welcome {
           width: 400px;
         }
 
        }
       @media (min-width:768px) AND (max-width: 862px) {
       .image #img_welcome {
          width: 300px;
        }

       }
       @media (max-width: 768px) {
        .container {
          display: flex;
          flex-wrap: wrap;
        }
        
        .text {
          flex: 1;
          padding-right: 20px;
          margin-bottom: 20px;
        
        }
        
        
    .image {
      flex: 1;
    }
    #img_welcome {
      width: 330px;
    }
    
    #welcome{
      color: #18B7BE;
      font-weight: 150px;
      font-size:30px;
      text-align: center;
    }
    
    }
    

</style>

</head>
<body>
<header class="header" id="head" >
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
                <div id="menu-btn" class="fas fa-bars"></div>
                
        </div>

        <!--<div class="icons" style="padding-top:0.8rem ;">
            <div id="menu-btn" class="fas fa-bars"></div>
            
        </div>-->

    </section>
</header>

<!--welcome-->  <!---->
<section class="about">
    <div class="row">
        
        <div class="content">
            <h3>Welcome to your Timoney</h3>
            <p>for every minute spent organizing , an hour is earned.threfore, <span>Timoney</span> is your choice  for both organizing 
            your <span>Time</span> and organizing your <span>money</span></p><br><br>
            <a href="courses.html" class="inline-btn btn">go</a>
        </div>
        <div class="image">
            <img src="../images/photo_welcome.jpeg" alt="">
        </div>
    </div>
</section>
<!--gooo+quote-->
<div class="box">
    <div class="HB">
      <h1 id="h" >Ready to achieve great things? Sign up!</h1>
      <button id="go" href="#">GO</button>
    </div>
    <div class="img" style="margin-top: 3rem;">
      <img src="../images/left-quote.png" width="60px" height="130px" style="margin-left: 1rem;display: block;" id="img">
      <div class="parag">
        <p id="CITATION" >
          “Our goals can only be reached through a vehicle of plan, in which we must fervently believe, and upon which we must vigorously act. There is no other route to success.”
        </p>
        <p id="PAB"><span>― Pablo Picasso, painter</span></p>
      </div>
    </div>
  </div>
<!--footer-->
<div class="footer">
    <div class="box-footer">
        <div class="links">
            <h3>Quick links</h3>
            <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
            <a href="about.php"> <i class="fas fa-angle-right"></i> services</a>
            <a href="package.php"> <i class="fas fa-angle-right"></i> contacts</a>
            
        </div>
        <div class="links">
            <h3>Extra links</h3>
            <a href="#"> <i class="fas fa-angle-right"></i> ask questions</a>
            <a href="#"> <i class="fas fa-angle-right"></i> about us</a>
            <a href="#"> <i class="fas fa-angle-right"></i> arivacy policy</a>
            
        </div>
        <div class="links">
            <h3>Contact info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +212608251522</a>
            <a href="#"> <i class="fas fa-phone"></i> +212608251522</a>
            <a href="#"> <i class="fas fa-map"></i> Oujda , Maroc</a>
        </div>
        <div class="links">
            <h3>Follow us </h3>
            <a href="#"> <i class="fab fa-facebook-f"></i> facebook</a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram</a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter</a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin</a>
        </div>
    </div>
    

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