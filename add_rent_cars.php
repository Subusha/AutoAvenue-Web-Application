<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./components/attachments.php'); ?>
    <title>Vehicle Add Page</title>
</head>

<?php
$name = $price = $ftype = $scount = $color = $im1 = $im2 = "";
$targetDir = "uploads/";

if (array_key_exists('add', $_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $ftype = $_POST['fuel-type'];
    $scount =  $_POST['seat-count'];
    $color =  $_POST['color'];

    $user = $_SESSION['user_id'];
    $timestamp = time();

    $f1 = $targetDir . $_SESSION["user_id"] . '_' . $timestamp . '_vehical.' . pathinfo(basename($_FILES["image1"]["name"]), PATHINFO_EXTENSION);;
    $f2 = $targetDir . $_SESSION["user_id"] . '_' . $timestamp . '_interior.' . pathinfo(basename($_FILES["image2"]["name"]), PATHINFO_EXTENSION);;

    move_uploaded_file($_FILES["image1"]["tmp_name"], $f1);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $f2);

    $sql = "INSERT INTO rent_cars VALUES('NULL','$price','$scount','$name','$f1','$f2','$ftype','$color','$user')";
    if (($__conn->query($sql) === TRUE)) {
        header("location:./add_rent_cars.php");
    }
}

?>

<body id="add">
    <?php include_once('./components/header.php'); ?>

    <section>

        <div class="form-wrap">
            <h1>Add Rent Car</h1>
            <form id="add-car-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return validate()">
                <div class="wrap">
                    <label for="make">Name:</label><br>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="wrap">
                    <label for="price">Price:</label><br>
                    <input type="text" id="price" name="price" required>
                </div>
                <div class="wrap">
                    <label for="fuel-type">Fuel Type:</label><br>
                    <select id="fuel-type" name="fuel-type">
                        <option value="gasoline">Gasoline</option>
                        <option value="diesel">Diesel</option>
                        <option value="electric">Electric</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="biofuel">Biofuel</option>
                    </select>
                </div>
                <div class="wrap">
                    <label for="seat-count">Seat Count:</label><br>
                    <input type="number" id="seat-count" name="seat-count" required>
                </div>
                <div class="wrap">
                    <label for="color">Color:</label><br>
                    <select name="color">
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="yellow">Yellow</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="silver">Silver</option>
                        <option value="gray">Gray</option>
                        <option value="orange">Orange</option>
                        <option value="purple">Purple</option>
                    </select>

                </div>
                <div class="wrap">
                    <label for="image1">Vehical Image:</label><br>
                    <input type="file" id="image1" name="image1" required>
                </div>
                <div class="wrap">
                    <label for="image2">Interior Image:</label><br>
                    <input type="file" id="image2" name="image2" required>
                </div>
                <div class="wrap">
                    <button type="submit" class="add-btn" name="add">Add Vehicle</button>
                </div>
            </form>
        </div>
    </section>
    <?php include_once('./components/footer.php'); ?>
</body>

<script>
    function validate() {
        const rname = /^[A-Z a-z 0-9]+$/;
        const rprice = /^[0-9]{4,10}$/;
        const rscount = /^[0-9]{1,2}$/;
        var name = document.getElementById('name').value;
        var price = document.getElementById('price').value;
        var fuel_type = document.getElementById('fuel-type').value;
        var seat_count = document.getElementById('seat-count').value;
        var color = document.getElementById('color').value;
        var image1 = document.getElementById('image1').value;
        var image2 = document.getElementById('image2').value;

        if (!rname.test(name)) {
            alert("Invalid name format or empty field");
            return false;
        }
        if (!rprice.test(price)) {
            alert("Invalid price format or empty field");
            return false;
        }
        if (!rscount.test(seat_count)) {
            alert("Invalid seat count format or empty field");
            return false;
        }
        if (image1 == null) {
            alert("Enter vehical image");
            return false;
        }
        if (image2 == null) {
            alert("Enter interior image");
            return false;
        }
        return true;
    }
</script>


</html>