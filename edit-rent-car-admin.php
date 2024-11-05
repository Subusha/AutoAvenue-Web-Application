<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('./components/attachments.php'); ?>
    <title>Vehicle Sales Homepage</title>
</head>

<?php
// variable tika hadanawa
$name = $price = $make = $model = $year = $desc = $etype = $ftype = $hpower = $scount = $color = $im1 = $im2 = $im3 = "";
$er_name = $er_price = $er_make = $er_model = $er_year = $er_desc = $er_etype = $er_ftype = $er_hpower = $er_scount = $er_color = $er_im1 = $er_im2 = $er_im3 = "";
if (array_key_exists('edit', $_POST)) {
    // form data tika gannawa
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $ftype = $_POST['fuel-type'];
    $scount =  $_POST['seat-count'];
    $color =  $_POST['color'];

    $user = $_SESSION['user_id'];
    $timestamp = time();
    // car eke detaiils update karanawa
    $sql = "UPDATE rent_cars SET `name`='$name',price='$price',fuel_type='$ftype',seat_count='$scount',color='$color' WHERE id=$id";
    if (($__conn->query($sql) === TRUE)) {
        header("location:./inventory.php");
    }
}
$cid = "";
// car eke dananata thiyena details tika gannawa
if (array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $cid = $id;
    $sql = "SELECT a.*, b.username,b.contact FROM rent_cars a INNER JOIN users b ON a.user_id = b.id WHERE a.id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        header('location:./view-car.php?id=' . $id);
    }
    $car = $result->fetch_assoc();
} else if (array_key_exists('id', $_POST)) {
    $id = $_POST['id'];
    $cid = $id;
    $sql = "SELECT a.*, b.username,b.contact FROM rent_cars a INNER JOIN users b ON a.user_id = b.id WHERE a.id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        header('location:./view-car.php?id=' . $id);
    }
    $car = $result->fetch_assoc();
} else {
    header('location:./inventory.php');
}




?>


<body id="add">
    <?php include_once('./components/header.php'); ?>

    <section>

        <div class="form-wrap">
            <h1>Edit This Car</h1>
            <div id="x">
                <div class="vehicle-images">
                    <img src="./<?php echo $car['image1']; ?>" alt="<?php echo $car['image1']; ?>">
                    <img src="./<?php echo $car['image2']; ?>" alt="<?php echo $car['image2']; ?>">
                </div>
            </div>
            <form id="add-car-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return validate()">
                <input type="hidden" name="id" value="<?php echo $cid; ?>" required>
                <div class="wrap">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" value="<?php echo $car['name']; ?>" required>
                </div>
                <div class="wrap">
                    <label for="price">Price:</label><br>
                    <input type="text" id="price" name="price" value="<?php echo $car['price']; ?>" required>
                </div>
                <div class="wrap">
                    <label for="fuel-type">Fuel Type:</label><br>
                    <select id="fuel-type" name="fuel-type">
                        <option value="gasoline" <?php if ($car['fuel_type'] == "gasoline") {
                                                        echo "selected";
                                                    } ?>>Gasoline</option>
                        <option value="diesel" <?php if ($car['fuel_type'] == "diesel") {
                                                    echo "selected";
                                                } ?>>Diesel</option>
                        <option value="electric" <?php if ($car['fuel_type'] == "electric") {
                                                        echo "selected";
                                                    } ?>>Electric</option>
                        <option value="hybrid" <?php if ($car['fuel_type'] == "hybrid") {
                                                    echo "selected";
                                                } ?>>Hybrid</option>
                        <option value="biofuel" <?php if ($car['fuel_type'] == "biofuel") {
                                                    echo "selected";
                                                } ?>>Biofuel</option>
                    </select>
                </div>
                <div class="wrap">
                    <label for="seat-count">Seat Count:</label><br>
                    <input type="number" id="seat-count" name="seat-count" value="<?php echo $car['seat_count']; ?>" required>
                </div>
                <div class="wrap">
                    <label for="color">Color:</label><br>
                    <select name="color">
                        <option value="red" <?php if ($car['color'] == "red") {
                                                echo "selected";
                                            } ?>>Red</option>
                        <option value="blue" <?php if ($car['color'] == "blue") {
                                                    echo "selected";
                                                } ?>>Blue</option>
                        <option value="green" <?php if ($car['color'] == "green") {
                                                    echo "selected";
                                                } ?>>Green</option>
                        <option value="yellow" <?php if ($car['color'] == "yellow") {
                                                    echo "selected";
                                                } ?>>Yellow</option>
                        <option value="black" <?php if ($car['color'] == "black") {
                                                    echo "selected";
                                                } ?>>Black</option>
                        <option value="white" <?php if ($car['color'] == "white") {
                                                    echo "selected";
                                                } ?>>White</option>
                        <option value="silver" <?php if ($car['color'] == "silver") {
                                                    echo "selected";
                                                } ?>>Silver</option>
                        <option value="gray" <?php if ($car['color'] == "gray") {
                                                    echo "selected";
                                                } ?>>Gray</option>
                        <option value="orange" <?php if ($car['color'] == "orange") {
                                                    echo "selected";
                                                } ?>>Orange</option>
                        <option value="purple" <?php if ($car['color'] == "purple") {
                                                    echo "selected";
                                                } ?>>Purple</option>
                    </select>
                </div>
                <div class="wrap">
                    <button type="submit" class="add-btn" name="edit">Edit Vehicle</button>
                </div>
            </form>
        </div>
    </section>
    <?php include_once('./components/footer.php'); ?>
</body>

<script>
    function validate() {
        const rname = /^[A-Z a-z 0-9]+$/;
        const rdesc = /^[A-Z a-z 0-9 , . /]+$/;
        const rprice = /^[0-9]{4,10}$/;
        const rscount = /^[0-9]{1,2}$/;
        var name = document.getElementById('name').value;
        var description = document.getElementById('description').value;
        var price = document.getElementById('price').value;
        var fuel_type = document.getElementById('fuel-type').value;
        var seat_count = document.getElementById('seat-count').value;
        var color = document.getElementById('color').value;

        if (!rname.test(name)) {
            alert("Invalid name format or empty field");
            return false;
        }
        if (!rdesc.test(description)) {
            alert("Invalid description format or empty field");
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
        return true;
    }
</script>

</html>