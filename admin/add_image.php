<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}

if (isset($_POST['submit'])){
    $id = create_unique_id();

    $status = $_POST['status'];
    $status = filter_var($status , FILTER_SANITIZE_STRING);

    $title = $_POST['title'];
    $title = filter_var($title , FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description , FILTER_SANITIZE_STRING);

    $thumb = $_FILES['thumb']['name'];
    $thumb = filter_var($thumb, FILTER_SANITIZE_STRING);
    $ext = pathinfo($thumb,PATHINFO_EXTENSION );
    $rename = create_unique_id().'.'.$ext;
    $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
    $thumb_size = $_FILES['thumb']['size'];
    $thumb_folder = '../uploaded_files/'.$rename;

    $verify_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE id=? AND tutor_id = ? AND title = ? AND description = ? AND thumb=? AND status = ?");
    $verify_playlist->execute([$id,$tutor_id,$title,$description,$thumb,$status]);

    if($verify_playlist->rowCount() > 0){
        $message[] = 'picture already created!';
    }else{
        $add_playlist = $conn->prepare("INSERT INTO `playlist` (id , tutor_id, title, description, thumb, status ) VALUES (?,?,?,?,?,?)");
        $add_playlist->execute([$id, $tutor_id, $title, $description, $rename, $status]);
        move_uploaded_file($thumb_tmp_name,$thumb_folder);
        $message[] = 'new picture added!';

    }

    
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add image</title>
    
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
    <!-- add playlist section starts-->

    <section class="playlist-form">
        <h1 class="heading">add picture</h1>

        



        <form action="" method="POST" enctype="multipart/form-data">
            <p>image status <span>*</span></p>
            <select name="status" required id="" class="box">
                <option value="important">important</option>
                <option value="not important">not important</option>
            </select>
            <p>image title <span>*</span></p>
            <input type="text" class="box" name="title" maxlength="100" placeholder="enter playlist title" required>
            <p>image description <span>*</span></p>
            <textarea name="description" class="box" cols="30" rows="10" required placeholder="enter playist desciption" maxlength="1000"></textarea>
            <p>image wanted <span>*</span></p>
            <input type="file" name="thumb" required accept="image/*" class="box">
            <input type="submit" value="create favorite" name="submit" class="btn">

        </form>
        

     </section>



    <!-- add playlist section ends-->



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