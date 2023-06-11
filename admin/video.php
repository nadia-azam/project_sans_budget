<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}

if(isset($_POST['delete_playlist'])){
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id,FILTER_SANITIZE_STRING);

    $verify_playlist = $conn->prepare("SELECT * FROM `content` WHERE id=?");
    $verify_playlist->execute([$delete_id]);

    if ($verify_playlist->rowCount()>0){
        $fetch_thumb = $verify_playlist->fetch(PDO::FETCH_ASSOC);
        $prev_thumb = $fetch_thumb['thumb'];
        if ($prev_thumb != ''){
            unlink('../uploaded_files/'.$prev_thumb);
        }
        //$delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id=?");
        //$delete_bookmark->execute([$delete_id]);

        $delete_playlist = $conn->prepare("DELETE FROM `content` WHERE id=?");
        $delete_playlist->execute([$delete_id]);

        $message[]='video deleted!';


    }else{
        $message[] = 'video was already deleted !' ; 
    }
}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.com/libraries/font-awesome">
    <!-- custom css file link-->
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="icon" href="../images/myLogoLettreGrand.png" type="image/x-icon">
</head>
<body>
<?php
    include ("../components/admin_header.php");
    
    ?>
    <!-- view playlist section starts-->

    <section class="playlists">
        <h1 class="heading">all favorite video</h1>
        <div class="box-container">
            <div class="box" style="text-align: center;">
                <h3 class="title" style="padding-bottom: .7rem;">create new video</h3>
                <a href="../admin/add_video.php" class="btn">add video</a>
            </div>
            <?php
                $select_content = $conn->prepare("SELECT *FROM `content` WHERE tutor_id = ?");
                $select_content->execute([$tutor_id]);
                if($select_content->rowCount() > 0){
                    while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
                        $playlist_id = $fetch_content['id'];
                        //$count_content = $conn->prepare(" SELECT * FROM `content` WHERE playlist_id= ?");
                        //$count_content->execute([$playlist_id]);
                        //$total_contents = $count_content->rowCount();
                    
            ?>
            <div class="box">
                <div class="flex">
                    <div><i class="fas fa-circle-dot"  style="color:<?php if($fetch_content['status']=='important'){echo 'limegreen';}else{echo 'red';} ?>"></i><span style="color:<?php if($fetch_content['status']=='important'){echo 'limegreen';}else{echo 'red';} ?>"><?= $fetch_content['status']; ?></span></div>
                    <div><i class="fas fa-calendar"></i><span><?= $fetch_content['date']; ?></span></div>
                </div>

                <a href="view_video.php?get_id=<?= $playlist_id;?>" class="thumb">
                    <i class="fas fa-play" id="back" style="position: absolute;top: -19.3rem; left: 0rem; right: 0.12rem;height: 20.4rem;background-color: rgb(0, 0, 0, .5);
                    display: flex;align-items: center;justify-content: center;font-size: 4rem;color: #fff;border-radius: .5rem;"></i>
                    <img src="../uploaded_files/<?= $fetch_content['thumb']; ?>" alt="">
                    <h3 class="title"><?= $fetch_content['title']; ?></h3>
                </a>

                
                <p class="description"><?= $fetch_content['description']; ?></p>
                <form action="" method="POST" class="flex-btn">
                    <input type="hidden" name="delete_id" value="<?= $playlist_id;?>">
                    <!--<a href="update_video.php?get_id=<?= $playlist_id;?>" class="option-btn">update</a>-->
                    <a href="view_video.php?get_id=<?= $playlist_id;?>" class="btn">watch</a>
                    <input type="submit" value="delete" name="delete_playlist" class="delete-btn">
                </form>
                
                
            </div>
            <?php 
                    }
                }else {
                    echo '<p class="empty"> video not addded yet !</p>';
                }
            ?>
        </div>
    </section>

    <!-- view playlist section ends-->

    









<script >
        let footer = document.querySelector('.footer');
        let body = document.body;

        let  profile = document.querySelector('.header .flex .profile');
        let  searchform = document.querySelector('.header .flex .search-form');
        let  sideBar = document.querySelector('.side-bar');
        let logo = document.getElementById("#logo2");

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
            logo.src="../images/myLogo(1).jpg";
        }

        const disableDarkMode = () => {
            toggleBtn.classList.replace('fa-moon','fa-sun');
            body.classList.remove('dark');
            localStorage.setItem('dark-mode','disabled');
            logo.src="../images/myLogo.jpeg";
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