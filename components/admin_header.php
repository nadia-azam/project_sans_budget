<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>




<!-- header section starts-->
<header class="header">
    <section class="flex">

        <a href="dashboard.php" class="logo">TimoneY.</a>
        <!--<form action="search_page.php" method="post" class="search-form">
            <input type="text" placeholder="search here..." required maxlength="100" name="search_box">
            <button type="submit" class="fas fa-search" name="search_btn"></button>
        </form>-->

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
        </div>
        <div class="profile">
            <?php
            $select_profile = $conn -> prepare(" SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            
            ?>
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <span><?= $fetch_profile['profession']; ?></span>
            <a href="../admin/profil.php" class="btn">view profile</a>
            <div class="flex-btn">
                
                <a href="update.php" class="btn">update </a>
                <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
            </div>
            
            <!--<div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>-->
            

            <?php
            
            }else{

            
            ?>
            <h3 style="text-align: center;">please login first</h3>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>

            <?php

            }
            
            ?>

        </div>
    </section>
</header>
<!-- header section ends-->

<!-- side bar section starts-->
<div class="side-bar">
        <div id="close-bar">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile">
            <?php
            $select_profile = $conn -> prepare(" SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$tutor_id]);
            if($select_profile->rowCount() > 0){
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            
            ?>
            <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
            <h3><?= $fetch_profile['name']; ?></h3>
            <span><?= $fetch_profile['profession']; ?></span>

            <a href="../admin/profil.php" class="btn">view profile</a>

            

            <?php
            
            }else{

            
            ?>
            <h3 style="text-align: center;">please login first</h3>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">login</a>
                <a href="register.php" class="option-btn">register</a>
            </div>

            <?php

            }
            
            ?>

        </div>
        <nav class="navbar">
            <a href="dashboard.php"><i class="fas fa-home "></i><span>home</span></a>
            <a href="../admin/plans.php"><i class="fas fa-comment "></i><span>my plans</span></a>
            <a href="../admin/favorite.php"><i class="fas fa-bars-staggered "></i><span>my favorites</span></a>
            <a href="../admin/budget.php"><i class="fas fa-graduation-cap "></i><span>budget</span></a>
            
            <a href="../components/admin_logout.php" onclick="return confirm('logout from this website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
        </nav>
</div>
<!-- side bar section ends-->