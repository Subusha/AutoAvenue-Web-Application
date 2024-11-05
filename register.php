<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./components/attachments.php'); ?>
    <title>Register</title>
</head>

<?php
// data save karana ariable tika hadanawa
$username = $email = $password = $contact =  $con_password = "";
$er_email = $er_conpassword = $er_contact = "";

// register button eka ebuwada check karanawa
if (array_key_exists('register', $_POST)) {
    // form eke data tika gannawa
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $conpassword = $_POST['conpassword'];
    if ($password === $conpassword) {
        $encp = md5($password);
        // user kalin register welada balanwa
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $__conn->query($sql);
        if ($result->num_rows > 0) {
            $er_email = "This email address is already registered!";
        } else {
            //  user wa register karala db ekata ywanawa
            $sql2 = "INSERT INTO users VALUES (NULL, '$username', '$email', '$encp', '$contact', 1)";
            if (($__conn->query($sql2) === TRUE)) {
                $sql = "SELECT * FROM users WHERE email='$email'";
                $result = $__conn->query($sql);
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                header('location:login.php');
            }
        }
    } else {
        // error eka pennawa
        $er_conpassword = "Passwords don't match. Confirm your password!";
    }
}
?>

<body id="login">
    <div class="container" style="width: 500px;">
        <a href="./index.php"><img src="./images/logo1.png" alt="" class="logo"></a>
        <p>Create a new account by filling out the registration form below.</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validate()">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required value="<?php echo $username; ?>">
                <div class="error" id="er_username"><?php echo $er_email; ?></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <div class="error" id="er_email"><?php echo $er_email; ?></div>
            </div>
            <div class="form-group">
                <label for="contact">Contact No</label>
                <input type="text" id="contact" name="contact" required>
                <div class="error" id="er_contact"><?php echo $er_contact; ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error" id="er_password"><?php echo $er_conpassword; ?></div>
            </div>
            <div class="form-group">
                <label for="conpassword">Confirm Password</label>
                <input type="password" id="conpassword" name="conpassword" required>
            </div>
            <button type="submit" name="register">Register</button>
            <div class="x">
                Already have an account?<br> <a style="text-decoration: none; color:white; font-weight:bolder;" href="./login.php">Login here</a>
            </div>

        </form>
    </div>
</body>

<script>
    function validate() {
        // validating regex tika
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const regex1 = /^[A-Z a-z]+$/;
        const regex2 = /^[0-9]+$/;

        var email = document.getElementById('email').value;
        var username = document.getElementById('username').value;
        var contact = document.getElementById('contact').value;
        var password = document.getElementById('password').value;
        var conpassword = document.getElementById('conpassword').value;

        var eemail = document.getElementById('er_email');
        var eusername = document.getElementById('er_username');
        var econtact = document.getElementById('er_contact');
        var epassword = document.getElementById('er_password');
        // errors tika reset karanawwa
        eemail.innerHTML = "";
        eusername.innerHTML = "";
        econtact.innerHTML = "";
        epassword.innerHTML = "";

        // validation tika
        if (!regex.test(email)) {
            eemail.innerHTML = "Invalid Email Address";
            return false;
        }
        if (!regex1.test(username)) {
            eusername.innerHTML = "Invalid Username";
            return false;
        }
        if (!regex2.test(contact)) {
            econtact.innerHTML = "Invalid Contact";
            return false;
        }
        if (password !== conpassword) {
            epassword.innerHTML = "Passwords don't match";
            return false;
        }
        return true;
    }
</script>

</html>