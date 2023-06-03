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
    $thumb_ext = pathinfo($thumb,PATHINFO_EXTENSION );
    $rename_thumb = create_unique_id().'.'.$thumb_ext;
    $thumb_tmp_name = $_FILES['thumb']['tmp_name'];
    $thumb_size = $_FILES['thumb']['size'];
    $thumb_folder = '../uploaded_files/'.$rename_thumb;

    $video = $_FILES['video']['name'];
    $video = filter_var($thumb, FILTER_SANITIZE_STRING);
    $video_ext = pathinfo($video,PATHINFO_EXTENSION );
    $rename_video = create_unique_id().'.'.$video_ext;
    $video_tmp_name = $_FILES['video']['tmp_name'];
    $video_size = $_FILES['video']['size'];
    $video_folder = '../uploaded_files/'.$rename_video;

    $verify_content = $conn->prepare("SELECT * FROM `content` WHERE  tutor_id = ? AND title = ? AND description = ?");
    $verify_content->execute([$tutor_id,$title,$description]);

    if($verify_content->rowCount() > 0){
        $message[] = 'content already created!';
    }else{
        $add_content = $conn->prepare("INSERT INTO `content` (id , tutor_id,  title, description,video, thumb, status ) VALUES (?,?,?,?,?,?,?)");
        $add_content->execute([$id, $tutor_id, $title, $description, $rename_video, $rename_thumb, $status]);
        move_uploaded_file($thumb_tmp_name,$thumb_folder);
        move_uploaded_file($video_tmp_name,$video_folder);
        $message[] = 'new content created!';

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
    <!-- add content section starts-->
    <section class="playlist-form">
        <h1 class="heading">add video</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>video status <span>*</span></p>
            <select name="status" required id="" class="box">
                <option value="active">active</option>
                <option value="desactive">desactive</option>
            </select>
            <p>video title <span>*</span></p>
            <input type="text" class="box" name="title" maxlength="100" placeholder="enter content title" required>
            <p>video description <span>*</span></p>
            <textarea name="description" class="box" cols="30" rows="10" required placeholder="enter content desciption" maxlength="1000"></textarea>
            
            <p>picture of video <span>*</span></p>
            <input type="file" name="thumb" required accept="image/*" class="box">
            <p>select video <span>*</span></p>
            <input type="file" name="video" required accept="video/*" class="box">
            <input type="submit" value="add video" name="submit" class="btn">
        </form>
    </section>
    
    <!-- add video section ends-->


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