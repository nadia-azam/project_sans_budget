<?php
include ("../components/connect.php");
if(isset($_COOKIE['tutor_id'])){
    $user_id = $_COOKIE['tutor_id'];
}else{
    $tutor_id = '';
    
}

if(isset($_POST['submit1'])){
    $id = create_unique_id();
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $profession = $_POST['profession'];
    $profession = filter_var($profession, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $c_pass = sha1($_POST['c_pass']);
    $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image,PATHINFO_EXTENSION );
    $rename = create_unique_id().'.'.$ext;

    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = '../uploaded_files/'.$rename;

    $select_tutor_email = $conn->prepare("SELECT * FROM `users` WHERE email=?");
    $select_tutor_email->execute([$email]);

    if($select_tutor_email->rowCount() > 0){
        $message[] = 'email already taken';
    }else{
        if($pass != $c_pass){
            $message[] = 'password not matched';
        }else{
            if($image_size > 2000000){
                $massage[] = 'image size is too large !' ;
            }else{
                $insert_tutor = $conn->prepare("INSERT INTO `users` (id , name, profession , email , password , image) VALUES (?,?,?,?,?,?)");
                $insert_tutor->execute([$id , $name , $profession , $email , $c_pass , $rename]);
                move_uploaded_file($image_tmp_name,$image_folder);

                $verify_tutor = $conn->prepare("SELECT * FROM `users` WHERE email= ? AND password= ? LIMIT 1");
                $verify_tutor->execute([$email , $c_pass]);
                $row = $verify_tutor->fetch(PDO::FETCH_ASSOC);

                if($insert_tutor){
                    if($verify_tutor->rowCount() > 0){
                    setcookie('tutor_id' , $row['id'], time() + 60*60*24*30, '/');
                    header('location:dashboard.php');
                    }else{
                        $message[] = 'something went wrong!' ; 
                    }
                }
            }

            
        }
        
    }
    //$message[]= 'its working!';
}
if(isset($_POST['submit2'])){

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
 
    $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
    $select_tutor->execute([$email, $pass]);
    $row = $select_tutor->fetch(PDO::FETCH_ASSOC);
    
    if($select_tutor->rowCount() > 0){
      setcookie('tutor_id', $row['id'], time() + 60*60*24*30, '/');
      header('location:../admin/dashboard.php');
    }else{
       $message[] = 'incorrect email or password!';
    }
 
 }

?>





























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/style_sign.css">
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Create An Account</h1>
                <span>use your email for registration</span>
                <input type="text" name="name" placeholder="Name" required>
                <select name="profession"  >
                    <option value="" disabled selected>--select your profession</option>
                    <option value="developer" >developer</option>
                    <option value="student" >student</option>
                    <option value="doctor" >doctor</option>
                    <option value="teacher" >teacher</option>
                    <option value="photographer" >photographer</option>
                    <option value="journalist" >journalist</option>
                    <option value="other" >other</option>
                
                </select>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Password" required>
                <input type="password" name="c_pass" placeholder="Confirm Your Password" required>
                <input type="file" id="file-input" name="image" accept="image/*" required>
                                <br/>
                <button id="btn" type="submit" name="submit1">Sign Up</button>
            
            
            
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Sign In</h1>
                <span>Login to your account</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Password" required>
                
                <button id="btn" name="submit2">Sign In</button><!--vers le profil-->
            </form>
        </div>

        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back</h1>
                    <h1>Have Already Account ?</h1>
                    <p>To keep connect with us please login with your account here ! </p>
                    <button class="ghost" id="signIn">sign In</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1>Hello Friend </h1>
                    <h1>Create Your Account</h1>
                    <p>Enter your personal detail and start journey with us</p>
                    <button class="ghost" id="signUp">sign Up</button>

                </div>
            </div>

        </div>

    </div>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click',()=>{
            container.classList.add("right-panel-active")
        })

        signInButton.addEventListener('click',()=>{
            container.classList.remove("right-panel-active")
        })

        


    </script>
</body>
</html>