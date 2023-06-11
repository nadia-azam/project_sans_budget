<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $tutor_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    header('location:login.php');
}


if (isset($_POST['submit'])) {
    $id = create_unique_id();

    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);

    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);

    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);

    $fichier = $_FILES['pdf']['name'];
    $fichier_tmp_name = $_FILES['pdf']['tmp_name'];
    $fichier_size = $_FILES['pdf']['size'];
    $fichier_folder = '../uploaded_files/';

    $ext = pathinfo($fichier, PATHINFO_EXTENSION);
    $rename = create_unique_id() . '.' . $ext;
    $fichier_folder .= $rename;

    $verify_document = $conn->prepare("SELECT * FROM `pdf` WHERE id=? AND tutor_id = ? AND title = ? AND description = ? AND fichier=? AND status = ?");
    $verify_document->execute([$id, $tutor_id, $title, $description, $fichier, $status]);

    if ($verify_document->rowCount() > 0) {
        $message[] = 'Document already created!';
    } else {
        $add_document = $conn->prepare("INSERT INTO `pdf` (id, tutor_id, title, description, fichier, status) VALUES (?,?,?,?,?,?)");
        $add_document->execute([$id, $tutor_id, $title, $description, $rename, $status]);
        move_uploaded_file($fichier_tmp_name, $fichier_folder);
        $message[] = 'New document added!';
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
    <!-- add pdf section starts -->

    <section class="playlist-form">
        <h1 class="heading">add document</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <p>document status <span>*</span></p>
            <select name="status" required id="" class="box">
                <option value="important">important</option>
                <option value="not important">not important</option>
            </select>
            <p>document title <span>*</span></p>
            <input type="text" class="box" name="title" maxlength="100" placeholder="enter document title" required>
            <p>document description <span>*</span></p>
            <textarea name="description" class="box" cols="30" rows="10" required placeholder="enter document description" maxlength="1000"></textarea>
            <p>document file <span>*</span></p>
            <input type="file" name="pdf" required accept=".pdf, .doc, .docx, .txt, .csv, .xls, .xlsx" class="box">
            <input type="submit" value="add pdf" name="submit" class="btn">
        </form>
    </section>






    <!-- add pdf section ends -->


<?php    include ("../components/footer.php");?>
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