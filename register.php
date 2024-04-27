<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style3.css">
    <title>Register</title>
    <style>
        .box h1 {
            border-bottom: 3px solid blue;
            width: fit-content;
            margin-left: 70px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box form-box">

            <?php

            include("connection.php");
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];

                //verifying the unique email

                $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");

                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_query($conn, "INSERT INTO users(username,email,age,password) VALUES('$username','$email','$age','$hash')") or die("Erroe Occured");

                    echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
                    echo "<a href='index.php'><button class='btn'>Login Now</button>";
                }
            } else {

            ?>
                <h1>Smart Finance</h1>
                <header>Sign Up</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" autocomplete="off" required>
                        <span id="emailError" style="color: red;"></span>
                    </div>

                    <div class="field input">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required pattern="^(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$" oninput="validatePassword()">
                        <img src="images/eye-close.png" alt="eye-close" id="eyeicon">
                    </div>
                    <span class="hint" id="passwordHint" style="color: red; display: none;">Password must be at least 8 characters long and contain at least one special character (!@#$%^&*)</span>

                    <div class="field">

                        <input type="submit" class="btn" name="submit" value="Register" required>
                    </div>
                    <div class="links">
                        Already a member? <a href="index.php">Sign In</a>
                    </div>
                </form>
        </div>
    <?php } ?>
    </div>


    <script>
        let eyeicon = document.getElementById("eyeicon");
        let password = document.getElementById("password");

        eyeicon.onclick = function() {
            if (password.type == "password") {
                password.type = "text";
                eyeicon.src = "images/eye-open.png";
            } else {
                password.type = "password";
                eyeicon.src = "images/eye-close.png";

            }
        }


        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');

        emailInput.addEventListener('input', function() {
            const email = emailInput.value;
            if (!email.includes('@') || !email.includes('.com')) {
                emailError.textContent = 'Email must contain "@" and end with ".com"';
            } else {
                emailError.textContent = '';
            }
        });


        function validatePassword() {
            var passwordInput = document.getElementById("password");
            var hint = document.getElementById("passwordHint");

            if (passwordInput.value.length >= 8 && /^(?=.*[!@#$%^&*])/.test(passwordInput.value)) {
                hint.style.display = "none"; // Hide the hint message if password meets the requirements
            } else {
                hint.style.display = "block"; // Show the hint message if password doesn't meet the requirements
            }
        }
    </script>

</body>

</html>