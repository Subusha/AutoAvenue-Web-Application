<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./components/attachments.php'); ?>
    <title>Login</title>
</head>

<?php
$email = $password = "";
$er_email = $er_password = "";
if (array_key_exists('login', $_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        $er_email = "This email address is not registered!";
    } else {
        $encp = md5($password);
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$encp'";
        $result = $__conn->query($sql);
        if ($result->num_rows == 0) {
            $er_password = "Password is incorrect!";
        } else {
            $row = $result->fetch_assoc();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            header('location:index.php');
        }
    }
}

?>

<body id="login">
    <div class="container" style="width: 500px;">
        <a href="./index.php"><img src="./images/logo1.png" alt="" class="logo"></a>
        <p>Please enter your credentials to log into your account.</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validate()">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required value="<?php echo $email; ?>">
                <div class="error" id="er_email"><?php echo $er_email; ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error"><?php echo $er_password; ?></div>
            </div>
            <br>
            <button type="submit" name="login" style="width:380px; margin-left:40px;">Login</button>
            <div class="x">
                Don't you have an account?<br> <a  style="text-decoration: none; color:white; font-weight:bolder;" href="./register.php">Register here</a>
            </div>
        </form>
    </div>
</body>

<script>
    function validate() {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var email = document.getElementById('email').value;
        var eemail = document.getElementById('er_email');
        eemail.innerHTML = "";
        if (!regex.test(email)) {
            eemail.innerHTML = "Invalid Email Address";
            return false;
        }
        return true;
    }
</script>

</html>