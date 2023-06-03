<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}

if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
}else{
    $get_id = '';
    header('location:playists.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update playlist</title>
    
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

    <!--section view picture start-->

    <section class="playlist-details">
            <h1 class="heading">playlist details</h1>
            <?php
                $select_content = $conn->prepare("SELECT * FROM `content` WHERE id = ? ");
                $select_content->execute([$get_id]);
                if($select_content->rowCount() > 0){
                    while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
                        
                        $count_content = $conn->prepare(" SELECT * FROM `content` WHERE tutor_id = ?");
                        $count_content->execute([$get_id]);
                        $total_contents = $count_content->rowCount(); 
            ?>

        <div class="row">           
            <div class="thumb">
                    
                    <video src="../uploaded_files/<?= $fetch_content['video']?>" height="350" width="100%" controls autoplay alt="">
                    <div class="flex">
                        <p><i class="fas fa-video"><span><?= $total_contents; ?></span></i></p>
                    </div>
                    <p><i class="fas fa-calendar"></i><span><?= $fetch_content ['date']?></span></p>
            </div>
            <div class="details">
                    <h3 class="title"><?= $fetch_content ['title']; ?></h3>
                    <p class="description"><?= $fetch_content['description']?></p>
                    <form action="" method="POST" class="flex-btn">
                        <input type="hidden" name="delete_id" value="<?= $playlist_id['id'];?>">
                        <a href="update_playist.php?get_id=<?= $playlist_id['id'];?>" class="option-btn">update</a>
                        <input type="submit" value="delete" name="delete_playlist" class="delete-btn">
                    </form>
            </div>


                    
         


            <?php 
            }
                }else {
                    echo '<p class="empty"> playlist was not found! </p>';
                }
            ?>
            </div>   
    </section>


    
   

    <!--section view picture ends-->



<?php
    include ("../components/footer.php");
    
    ?>




    <!-- custom js file link -->
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