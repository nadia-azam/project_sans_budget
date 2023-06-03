<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}

    
    if(isset($_POST['delete_plan'])){
        $delete_id = $_POST['delete_id'];
        $delete_id = filter_var($delete_id,FILTER_SANITIZE_STRING);
    
        $verify_plan = $conn->prepare("SELECT * FROM `plan` WHERE id=?");
        $verify_plan->execute([$delete_id]);
    
        if ($verify_plan->rowCount()>0){
            //$fetch_thumb = $verify_plan->fetch(PDO::FETCH_ASSOC);
            //$prev_thumb = $fetch_thumb['thumb'];
            //if ($prev_thumb != ''){
                //unlink('../uploaded_files/'.$prev_thumb);
            //}
            //$delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id=?");
            //$delete_bookmark->execute([$delete_id]);
    
            $delete_plan = $conn->prepare("DELETE FROM `plan` WHERE id=?");
            $delete_plan->execute([$delete_id]);
    
            $message[]='plan deleted!';
    
    
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
        <h1 class="heading">all my plans</h1>
        <div class="box-container">
            <div class="box" style="text-align: center;">
                <h3 class="title" style="padding-bottom: .7rem;">create new plan</h3>
                <a href="../admin/add_plans.php" class="btn">add plan</a>
            </div>
            <?php
                $select_plan = $conn->prepare("SELECT *FROM `plan` WHERE plan_id = ?");
                $select_plan->execute([$tutor_id]);
                if($select_plan->rowCount() > 0){
                    while($fetch_plan = $select_plan->fetch(PDO::FETCH_ASSOC)){
                        $plan_id = $fetch_plan['id'];
                        //$count_content = $conn->prepare(" SELECT * FROM `content` WHERE playlist_id= ?");
                        //$count_content->execute([$playlist_id]);
                        //$total_contents = $count_content->rowCount();
                    
            ?>
            <div class="box">
                <div class="flex">
                    <div><i class="fas fa-circle-dot"  style="color:<?php if($fetch_plan['status']=='important'){echo 'limegreen';}else{echo 'red';} ?>"></i><span style="color:<?php if($fetch_plan['status']=='important'){echo 'limegreen';}else{echo 'red';} ?>"><?= $fetch_plan['status']; ?></span></div>
                    <div><i class="fas fa-calendar"></i><span><?= $fetch_plan['date']; ?></span></div>
                </div><br><br><br>
                
                <h3 class="title" style="text-align: center;"><?= $fetch_plan['title']; ?></h3></br></br>
                <p class="description"><?= $fetch_plan['description']; ?></p>
                <form action="" method="POST" class="flex-btn">
                    <input type="hidden" name="delete_id" value="<?= $plan_id;?>">
                    <a href="update_plan.php?get_id=<?= $plan_id;?>" class="option-btn">update</a>
                    <input type="submit" value="delete" name="delete_plan" class="delete-btn">
                </form>
                
            </div>
            <?php 
                    }
                }else {
                    echo '<p class="empty"> plans not added yet ! </p>';
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