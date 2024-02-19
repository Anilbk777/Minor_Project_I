<?php 
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style3.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
             
              include("connection.php");
              if(isset($_POST['btnlogin'])){
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $password = mysqli_real_escape_string($conn,$_POST['password']);

                $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND password='$password' ") ;
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['age'] = $row['age'];
                    $_SESSION['id'] = $row['Id'];
                }
                else{
                    echo "<div class='message'>
                      <p>Wrong Username or Password</p>
                       </div> <br>";
                   echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['valid'])){
                    header("Location: dashboard.php");
                }
              }else{

             

            
            ?>
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <img src="images/eye-close.png" alt="eye-close" id="eyeicon">
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="btnlogin" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
      <?php
    if(isset($_POST['btnlogin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $que = "SELECT email,password FROM users WHERE email='$email' and password='$password'";
        
       if (mysqli_num_rows(mysqli_query($conn,$que))) {
        $fetch_id = "SELECT Id FROM users WHERE email='$email' ";
        $result = mysqli_query($conn,$fetch_id);
            $row = mysqli_fetch_array($result);
            $_SESSION['myuser']=$row['Id'];
        header("location:dashboard.php");
       }
    }  

    
    
    ?>

<script>
    let eyeicon  = document.getElementById("eyeicon");
    let password  = document.getElementById("password");

    eyeicon.onclick = function(){
        if(password.type == "password"){
            password.type = "text";
            eyeicon.src = "images/eye-open.png";
        }
        else{
            password.type = "password";
            eyeicon.src = "images/eye-close.png";

        }
    }

</script>

</body>
</html>