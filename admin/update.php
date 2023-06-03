<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}
if (isset($_POST['submit'])){

    $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1 ");
    $select_tutor->execute([$tutor_id]);
    $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    if (!empty($name)){
        $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
        $update_name->execute([$name,$tutor_id]);
        $message[] = 'name updated successfully';
    }
    if (!empty($profession)){
        $update_profession = $conn->prepare("UPDATE `users` SET profession = ? WHERE id = ?");
        $update_profession->execute([$profession,$tutor_id]);
        $message[] = 'profession updated successfully';
    }
    if (!empty($email)){
        $select_tutor_email = $conn->prepare("SELECT * FROM `users` WHERE email=?");
        $select_tutor_email->execute([$email]);

        if($select_tutor_email->rowCount() > 0){
            $message[] = ' email already taken!';

        }else{
            $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
            $update_email->execute([$email,$tutor_id]);
            $message[] = 'email updated successfully';
        }
        
    }


    $prev_image = $fetch_tutor['image'];

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image,PATHINFO_EXTENSION );
    $rename = create_unique_id().'.'.$ext;
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = '../uploaded_files/'.$rename;

    if(!empty($image)){
        if($image_size > 2000000){
            $message[] = 'image size is too large!';
        }else{
            $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
            $update_image->execute([$rename,$tutor_id]);
            
            move_uploaded_file($image_tmp_name , $image_folder);
            if($prev_image != '' AND $prev_image != $rename){
                unlink('../uploaded_files/'.$prev_image);
            }
            $message[] = 'image updated successfully';
        }
    }
    $empty_pass='daezgxidnkleekdnjzyud5982ejhizgtzckfpe';

    $prev_pass = $fetch_tutor['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $c_pass = sha1($_POST['c_pass']);
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

    if($old_pass != $empty_pass){
        if($old_pass != $prev_pass){
            $message[] = 'old email not matched!';
        }elseif ($new_pass != $c_pass){
            $message[] = 'confirm password not matched!';
        }else{
            if($new_pass != $empty_pass){
                $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
                $update_pass->execute([$c_pass,$tutor_id]);
                $message[] = 'password updated successfully';                
            }else{
                $message[] = ' plase enter new password!';
            }
        }
    }
}


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

    <!-- update section starts -->

    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>update profile</h3>
            <div class="flex">
                <div>
                <p>your name </p>
                <input type="text" name="name" maxlength="50" placeholder="<?= $fetch_profile['name'];?>" class="box">
                <p>your profession </p>
                <select name="profession" class="box">
                    <option value="<?= $fetch_profile['profession'];?>" selected><?= $fetch_profile['profession'];?></option>
                    <option value="devloper">developer</option>
                    <option value="devloper">student</option>
                    <option value="devloper">doctor</option>
                    <option value="devloper">teacher</option>
                    <option value="devloper">photographer</option>
                    <option value="devloper">journalist</option>
                </select>
                <p>your email </p>
                <input type="email" name="email" maxlength="50" placeholder="<?= $fetch_profile['email'];?>" class="box">
                </div>
                <div class="col">
                    <p>old password</p>
                    <input type="password" name="old_pass" maxlength="20" placeholder="enter old password" class="box">
                    <p>your password</p>
                    <input type="password" name="new_pass" maxlength="20" placeholder="enter new password" class="box">
                    <p>confirm password</p>
                    <input type="password" name="c_pass" maxlength="20"  placeholder="confirm your new password" class="box">
                    
                </div>
            </div>
            <p>select picture</p>
            <input type="file" name="image" class="box"  accept="image/*">
            <input type="submit" value="update now" name="submit" class="btn">
            
            
        </form>
    </section>




    <!-- update section ends -->









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