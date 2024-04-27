<?php
include("connection.php");
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['myuser'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style3.css">


    <title>SMART FINANCE</title>
    <style>
        .box h1 {
            border-bottom: 3px solid blue;
            width: fit-content;
            margin-left: 70px;
        }

        .box header {
            font-size: 22px;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="box form-box">

            <?php
            if ($_POST['submit']) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['myuser'];
                $edit_query = "UPDATE users SET username='$username', email='$email', age='$age' WHERE Id='$id'";
                $data1 = mysqli_query($conn, $edit_query);

                if ($data1) {
                    echo "<div class='message'>
                                <p>Profile Updated!</p>
                            </div> <br>";
                    echo "<a href='dashboard.php'><button class='btn'>Go Home</button>";
                }
            } else {
                $id1 = $_SESSION['myuser'];
                $query = "SELECT * FROM users WHERE Id = $id1";
                $queryexe = mysqli_query($conn, $query);
                $userResult = mysqli_fetch_assoc($queryexe);


            ?>


                <h1>Smart Finance</h1>
                <header>Edit Profile</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $userResult['username']; ?>" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $userResult['email']; ?>" autocomplete="off" required>
                        <span id="emailError" style="color: red;"></span>
                    </div>

                    <script>
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
                    </script>


                    <div class="field input">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" value="<?php echo $userResult['age']; ?>" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Update" required>
                    </div>
                </form>
        </div>
    </div>

</body>

</html>

<?php } ?>