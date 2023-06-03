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

    
    

    $verify_plan = $conn->prepare("SELECT * FROM `plan` WHERE id=? AND plan_id = ? AND title = ? AND description = ?  AND status = ?");
    $verify_plan->execute([$id,$tutor_id,$title,$description,$status]);

    if($verify_plan->rowCount() > 0){
        $message[] = 'plan already created!';
    }else{
        $add_plan = $conn->prepare("INSERT INTO `plan` (id , plan_id, title, description, status ) VALUES (?,?,?,?,?)");
        $add_plan->execute([$id, $tutor_id, $title, $description, $status]);
        
        $message[] = 'new plan created!';

    }

}



?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my plans</title>
    
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
    <!-- add list section started-->
    <section class="ecriture-form">
        <h1 class="heading">add plan</h1>

        



        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div class="box">
                    <p>plan status <span>*</span> </p>
                    <select name="status" required id="" class="select">
                        <option value="important">important</option>
                        <option value="not important">not important</option>
                        <option value="not important">urgent</option>
                        <option value="not important">not urgent</option>
                    </select>
                </div>
                <div class="box" > 
                    <p>plan title<span>*</span> </p>
                    <input type="text" class="box" name="title" maxlength="100" placeholder="enter plan title" required>
                </div>  
            </div>
            <p>what it is your planing ?</p>
            
            <textarea name="description" class="box" cols="30" rows="10" required placeholder="plan desciption..." maxlength="1000"  
            id="myTextArea"onfocus="addFirstLineNumber()" onkeydown="addLineNumbers(event)"
            ></textarea>
            <input type="submit" value="add plan" name="submit" class="btn">

        </form>
        

     </section>
    <!-- add list section ends-->


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





        // style de textearea 
        var isFirstLine = true;

function addFirstLineNumber() {
  if (isFirstLine) {
    var textarea = document.getElementById("myTextArea");
    textarea.value = "1) ";
    isFirstLine = false;
  }
}

function addLineNumbers(event) {
  if (event.keyCode === 13) {
    event.preventDefault();

    var textarea = document.getElementById("myTextArea");
    var lines = textarea.value.split("\n");

    if (lines.length === 1 && lines[0].trim() === "") {
      textarea.value = "1) ";
    } else {
      var currentLineNumber = lines.length;
      var newLine = (currentLineNumber + 1) + ") ";

      // Ajouter la nouvelle ligne au contenu existant
      textarea.value += "\n" + newLine;
    }
  }
}
    </script>
</body>
</html>