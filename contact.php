<!DOCTYPE html>
<html lang="en">

<head>

<?php include_once('./components/attachments.php'); ?>
    <title>Rent car form</title>  
</head>

<?php
// data save karana ariable tika hadanawa

$username = $email = $contact =  $message = "";

// register button eka ebuwada check karanawa
if (array_key_exists('submitdata', $_POST)) {
    
    // form eke data tika gannawa
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];
    
    $sql2 = "INSERT INTO contact_us VALUES (NULL, '$username', '$email', '$contact', '$message')";
    
    if (mysqli_query($__conn,$sql2))
    {
        
        header('location:contact.php');
    }
    
        



            }


?>
<body id="login1">

<?php include_once('./components/header.php'); ?>

    <div class="container" style="width:800px;background-color:black; color:white;">
    
        <a href="./index.php"><img src="./images/logo1.png" alt="" class="logo"></a>
        <br><br>
        <p>Please fill out the following form to contact us</p>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
            <div class="form-group">
                <label style="text-align: left;" for="username" >Name:</label>
                <input type="text" id="username" name="username" required value="<?php echo $username; ?>" >
                
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="email" >Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>" >
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="contact" >Contact No:</label>
                <input type="number" id="contact" name="contact" value="<?php echo $contact; ?>">
                
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="message" ></label>
                
                <p><label for="message">Enter your message here</label></p>
<br><br>
                <textarea id="message" name="message" rows="6" cols="70">

                </textarea>

                <br>
                
            </div>
            
            <br>
            <button style="width: 160px;" type="submit" name="submitdata">Contact</button>
        </form>

        
    </div>
    <?php include_once('./components/footer.php'); ?>
</body>



</html>