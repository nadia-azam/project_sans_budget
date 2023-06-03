<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}

$count_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
$count_playlist->execute([$tutor_id]);
$total_playlist = $count_playlist->rowCount(); 


$count_plan = $conn->prepare("SELECT * FROM `plan` WHERE plan_id = ?");
$count_plan->execute([$tutor_id]);
$total_plan= $count_plan->rowCount();




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome">
    <!-- custom css file link-->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php
    include ("../components/admin_header.php");
    
    ?>

<!-- profile section starts-->
<section class="profile">
        <h1 class="heading">profile details</h1>

        <div class="details">
            <div class="tutor">
                <img src="../uploaded_files/<?= $fetch_profile['image'];?>" alt="">
                <h3><?= $fetch_profile['name']; ?></h3>
                <span> <?= $fetch_profile ['profession'];?></span>
                <a href="update.php" class="inline-btn">update profile</a>
            </div>
       
        <div class="box-container">
            <div class="box">
                <h3><?= $total_playlist; ?></h3>
                <p>all my plans </p>
                <a href="../admin/plans.php" class="btn">view plan</a>
            </div>
            <div class="box">
                <h3><?= $total_plan;?></h3>
                <p>total playlist</p>
                <a href="playists.php" class="btn"> view pictures</a>
            </div>
            <div class="box">
                <h3><?= $total_plan ?></h3>
                <p>total playlist</p>
                <a href="playists.php" class="btn"> view video</a>
            </div>
            <div class="box">
                <h3><?= $total_plan ?></h3>
                <p>total playlist</p>
                <a href="playists.php" class="btn"> view pdf</a>
            </div>
            <div class="box">
                <!--<h3><?= $total_plan ?></h3>
                <p>total playlist</p>-->
                <a href="budget.php" class="btn">see my budjet</a>
            </div>
        
            </div>
        </div>
    </section>


    <!-- profile section ends-->








<?php    include ("../components/footer.php");?>
<script >
        let footer = document.querySelector('.footer');
        let body = document.body;

        let  profile = document.querySelector('.header .flex .profile');
        let  searchform = document.querySelector('.header .flex .search-form');
        let  sideBar = document.querySelector('.side-bar');

        document.querySelector('#user-btn').onclick = () =>{
            profile.classList.toggle('active');
            
            searchform.classList.remove('active');
        }

        document.querySelector('#search-btn').onclick = () =>{
            searchform.classList.toggle('active');
            profile.classList.remove('active');
           
        }

        document.querySelector('#menu-btn').onclick = () =>{
            sideBar.classList.toggle('active');
            body.classList.toggle('active');
            footer.classList.toggle('active');
        }

        document.querySelector('#close-bar').onclick = () =>{
            sideBar.classList.remove('active');
            
        }


        window.onscroll = () =>{
            profile.classList.remove('active');
            searchform.classList.remove('active');


            if(window.innerWidth <1200){
                sideBar.classList.remove('active');
                body.classList.remove('active');
                footer.classList.remove('active');

            }
        }

        let toggleBtn = document.querySelector('#toggle-btn');
        let darkMode = localStorage.getItem('dark-mode');

        const enabelDarkMode = () => {
            toggleBtn.classList.replace('fa-sun','fa-moon');
            body.classList.add('dark');
            localStorage.setItem('dark-mode','enabled');
        }

        const disableDarkMode = () => {
            toggleBtn.classList.replace('fa-moon','fa-sun');
            body.classList.remove('dark');
            localStorage.setItem('dark-mode','disabled');
        }

        if(darkMode === 'enabled'){
            enabelDarkMode();
        }

        toggleBtn.onclick= (e) =>{
            let darkMode = localStorage.getItem('dark-mode');
            if(darkMode === 'disabled'){
                enabelDarkMode();
            }else{
                disableDarkMode();
            }
        } 
    </script>
</body>
</html>