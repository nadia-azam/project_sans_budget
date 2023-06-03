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

    $verify_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE id=?");
    $verify_playlist->execute([$delete_id]);

    if ($verify_playlist->rowCount()>0){
        $fetch_thumb = $verify_playlist->fetch(PDO::FETCH_ASSOC);
        $prev_thumb = $fetch_thumb['thumb'];
        if ($prev_thumb != ''){
            unlink('../uploaded_files/'.$prev_thumb);
        }
        //$delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id=?");
        //$delete_bookmark->execute([$delete_id]);

        $delete_playlist = $conn->prepare("DELETE FROM `playlist` WHERE id=?");
        $delete_playlist->execute([$delete_id]);

        $message[]='playlist deleted!';


    }else{
        $message[] = 'playist was already deleted !' ; 
    }
}


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all playlist</title>
    
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
    <!-- view playlist section starts-->

    <section class="playlists">
        <h1 class="heading">all favorite pictures</h1>
        <div class="box-container">
            <div class="box" style="text-align: center;">
                <h3 class="title" style="padding-bottom: .7rem;">create new picture</h3>
                <a href="../admin/add_image.php" class="btn">add picture</a>
            </div>
            <?php
                $select_playlist = $conn->prepare("SELECT *FROM `playlist` WHERE tutor_id = ?");
                $select_playlist->execute([$tutor_id]);
                if($select_playlist->rowCount() > 0){
                    while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
                        $playlist_id = $fetch_playlist['id'];
                        //$count_content = $conn->prepare(" SELECT * FROM `content` WHERE playlist_id= ?");
                        //$count_content->execute([$playlist_id]);
                        //$total_contents = $count_content->rowCount();
                    
            ?>
            <div class="box">
                <div class="flex">
                    <div><i class="fas fa-circle-dot"  style="color:<?php if($fetch_playlist['status']=='important'){echo 'limegreen';}else{echo 'red';} ?>"></i><span style="color:<?php if($fetch_playlist['status']=='important'){echo 'limegreen';}else{echo 'red';} ?>"><?= $fetch_playlist['status']; ?></span></div>
                    <div><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
                </div>
                <div class="thumb">
                    <!--<span><?= $total_contents; ?></span>-->
                    <img src="../uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
                </div>
                <h3 class="title"><?= $fetch_playlist['title']; ?></h3>
                <p class="description"><?= $fetch_playlist['description']; ?></p>
                <form action="" method="POST" class="flex-btn">
                    <input type="hidden" name="delete_id" value="<?= $playlist_id;?>">
                    <a href="update_images.php?get_id=<?= $playlist_id;?>" class="option-btn">update</a>
                    <input type="submit" value="delete" name="delete_playlist" class="delete-btn">
                </form>
                <a href="view_picture.php?get_id=<?= $playlist_id;?>" class="btn">view picture</a>
            </div>
            <?php 
                    }
                }else {
                    echo '<p class="empty"> picture not addded yet !</p>';
                }
            ?>
        </div>
    </section>

    <!-- view playlist section ends-->




    
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

        document.querySelectorAll('.description').forEach(content => {
            if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0,100);
        })

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