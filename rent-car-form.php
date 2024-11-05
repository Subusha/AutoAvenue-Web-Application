<!DOCTYPE html>
<html lang="en">

<head>
<?php include_once('./components/attachments.php'); ?>
    <title>Rent car form</title>
    
</head>

<?php
$cname = $contact = $vname = $sumtotal = $rprice = $noofdays = $email = $etype = $ftype = $hpower = $scount = $color = $im1 = $im2 = $im3 = "";

if (array_key_exists('submitdata', $_POST)) {
    // form data tika gannawa
    
    $cname = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $vname =  $_POST['vehicalname'];
    $rprice =  $_POST['Rent_price'];
    $noofdays =  $_POST['No_of_Days'];

    $user = $_SESSION['user_id'];
    $timestamp = time();


    // car eke detaiils update karanawa

    $sql = "INSERT INTO rented_details VALUES('NULL','$cname','$vname','$rprice','$email','$contact','$noofdays','$user')";
    

    if (($__conn->query($sql) === TRUE))
    {            
            header("location:./rent.php");
    }
        

        
}





$cid = "";
// car eke dananata thiyena details tika gannawa
if (array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $cid = $id;
    $sql = "SELECT name,price FROM rent_cars a WHERE a.id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        header('location:./view-car.php?id=' . $id);
    }
    $car = $result->fetch_assoc();
}
else if (array_key_exists('id', $_POST)) {
    $id = $_POST['id'];
    $cid = $id;
    $sql = "SELECT name,price FROM rent_cars a WHERE a.id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        header('location:./view-car.php?id=' . $id);
    }
    $car = $result->fetch_assoc();
} 

else
{
    header('location:./rent.php');
}

?>

<body id="login1">

<?php include_once('./components/header.php'); ?>

    <div class="container" style="width:800px;background-color:black; color:white;">
    
        <a><img src="./images/logo1.png" alt="" class="logo"></a>
        <br><br>
        <p>Please fill out the following form to rent a vehicle</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
            <div class="form-group">
                <label style="text-align: left;" for="username"> Customer Name:</label>
                <input type="text" id="username" name="username"  >
                
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="email">Email:</label>
                <input type="text" id="email" name="email">
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="contact">Contact No:</label>
                <input type="text" id="contact" name="contact">
                
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="vehicalname"> Vehicle Name:</label>
                <input type="text" id="vehicalname" name="vehicalname" value="<?php echo $car['name']; ?>" >
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="Rent_price">Rent Price Per Day:</label>
                <input type="number" id="Rent_price" name="Rent_price" value="<?php echo $car['price']; ?>">
                
            </div>
            <div class="form-group">
                <label style="text-align: left;" for="No_of_Days">Needed No of Days:</label>
                <input type="number" id="No_of_Days" name="No_of_Days" required>
            </div>

            <button type="button" name="calculate" onclick="multiplyBy()">Calculate Price</button>
            <br><br>
            <b><p style="font-size: 20px;">The Total Price is Rs : <span id = "result" name="sum"></span> 
        </b>
            <div class="x">
            </div>
            <br>
            <button style="width: 160px;" type="submit" name="submitdata" >ADD QUATATION</button>
        </form>

        
    </div>
    <?php include_once('./components/footer.php'); ?>
</body>

<script>
    function multiplyBy() {

// Get the values of the input fields with the ids "firstNumber" and "secondNumber"
num1 = document.getElementById("Rent_price").value;
num2 = document.getElementById("No_of_Days").value;


// Set the inner HTML of the element with the id "result" to the product of the two numbers
document.getElementById("result").innerHTML = num1*num2;

}
</script>

</html>