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

if (isset($_POST['update'])){
    $status = $_POST['status'];
    $status = filter_var($status , FILTER_SANITIZE_STRING);

    $title = $_POST['title'];
    $title = filter_var($title , FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description , FILTER_SANITIZE_STRING);

    $update_playlist = $conn->prepare("UPDATE `plan` SET title=? , description=? , status = ? WHERE id=?");
    $update_playlist->execute([$title , $description ,$status , $get_id]);
    $message[] = 'plan updated';

    

    
}  
if(isset($_POST['delete_playlist'])){
    

    $verify_plan = $conn->prepare("SELECT * FROM `plan` WHERE id=?");
    $verify_plan->execute([$get_id]);

    if ($verify_plan->rowCount()>0){
       
        

        $delete_playlist = $conn->prepare("DELETE FROM `plan` WHERE id=?");
        $delete_playlist->execute([$get_id]);

        header('location:playists.php');


    }else{
        $message[] = 'plan was already deleted !' ; 
    }
}     





?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update plan</title>
    
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
    <!-- update section starts-->
    <section class="playlist-form">
        <h1 class="heading">update playlist</h1>

        <?php
                $select_plan = $conn->prepare("SELECT *FROM `plan` WHERE id = ?");
                $select_plan->execute([$get_id]);
                if($select_plan->rowCount() > 0){
                    while($fetch_plan = $select_plan->fetch(PDO::FETCH_ASSOC)){
                        $plan_id = $fetch_plan['id'];
                       
                    
            ?>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <p>update status</p>
            <select name="status" required id="" class="box">
                <option value="<?= $fetch_plan['status'];?>" selected> <?= $fetch_plan['status'];?></option>
                <option value="active">active</option>
                <option value="desactive">desactive</option>
            </select>
            <p>update title</p>
            <input type="text" class="box" name="title" maxlength="100" placeholder="enter image title" value="<?= $fetch_plan['title'];?>">
            <p>update plan </p>
            <textarea name="description" class="box" cols="30" rows="10"  placeholder="enter image desciption" maxlength="1000"><?= $fetch_plan['description'];?></textarea>
           
            <input type="submit" value="update plan" name="update" class="btn">
            <div class="flex-btn">
                <input type="submit" value="delete plan" name="delete_playlist" class="delete-btn">
                
            </div>

        </form>
        <?php 
                    }
                }else {
                    echo '<p class="empty"> plan was not found! </p>';
                }
            ?>

     </section>

    <!-- update section ends-->




    
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