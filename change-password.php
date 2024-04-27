<?php
include("connection.php");
session_start();

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['myuser'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['current_password']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Fetch the current password from the database
    $id = $_SESSION['myuser'];
    $passwordQuery = "SELECT password FROM users WHERE Id='$id'";
    $passwordResult = mysqli_query($conn, $passwordQuery);
    $row = mysqli_fetch_assoc($passwordResult);
    $currentPasswordHash = $row['password'];

    // Check if the current password matches the one stored in the database
    if (password_verify($currentPassword, $currentPasswordHash)) {
        // Check if new password and confirm password match
        if ($newPassword === $confirmPassword) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update user profile with new password
            $edit_query = "UPDATE users SET password='$hashedPassword' WHERE Id='$id'";
            $data1 = mysqli_query($conn, $edit_query);

            if ($data1) {
                // Password changed successfully
                $success_message = "Password Changed Successfully!";
            } else {
                $error_message = "Error updating password: " . mysqli_error($conn);
            }
        } else {
            $error_message = "New password and confirm password do not match.";
        }
    } else {
        $error_message = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Smart Finanace</title>
    <style>
        .input {
            margin: 5px 0px 10px 0px;
        }

        .box h1 {
            border-bottom: 3px solid blue;
            width: fit-content;
            margin-left: 70px;
        }

        .box header {
            font-size: 22px;
        }

        .error-message {
            border: 2px solid red;
            width: 80%;
            margin-left: 35px;
            border-radius: 5px;
            text-align: center;
            background-color: whitesmoke;
        }

        .fas {
            position: relative;
            bottom: 32px;
            left: 370px;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="box form-box">



            <?php if (isset($success_message)) : ?>
                <div class="message">
                    <p><?php echo $success_message; ?></p>
                </div>
                <br>
                <a href="dashboard.php"><button class="btn">Go Home</button></a>
            <?php else : ?>
                <h1>Smart Finance</h1>
                <header>Change Password</header>
                <?php if (isset($error_message)) : ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form action="" method="post">

                    <div class="input">
                        <label for="current_password">Current Password:</label><br>
                        <input type="password" id="current_password" name="current_password" required>
                        <i class="fas fa-eye-slash icon" id="showCurrent"></i>
                    </div>

                    <div class="input">
                        <label for="new_password">New Password:</label><br>
                        <input type="password" id="new_password" name="new_password" required>
                        <i class="fas fa-eye-slash icon" id="showNew"></i>
                    </div>

                    <div class="input">
                        <label for="confirm_password">Confirm Password:</label><br>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                        <i class="fas fa-eye-slash icon" id="showConfirm"></i>
                    </div>

                    <div class="input">
                        <input type="submit" class="btn" value="Change Password">
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const togglePassword = (inputField, eyeIcon) => {
            if (inputField.type === 'password') {
                inputField.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                inputField.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        };

        const showCurrent = document.getElementById('showCurrent');
        const showNew = document.getElementById('showNew');
        const showConfirm = document.getElementById('showConfirm');
        const currentPassword = document.getElementById('current_password');
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('confirm_password');

        showCurrent.addEventListener('click', () => {
            togglePassword(currentPassword, showCurrent);
        });

        showNew.addEventListener('click', () => {
            togglePassword(newPassword, showNew);
        });

        showConfirm.addEventListener('click', () => {
            togglePassword(confirmPassword, showConfirm);
        });
    </script>

    </script>
</body>

</html>