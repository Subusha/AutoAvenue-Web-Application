<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./components/attachments.php'); ?>
    <title>Vehicle Add Page</title>
</head>

<?php
$name = $price = $make = $model = $year = $desc = $etype = $ftype = $hpower = $scount = $color = $im1 = $im2 = $im3 = "";
$er_name = $er_price = $er_make = $er_model = $er_year = $er_desc = $er_etype = $er_ftype = $er_hpower = $er_scount = $er_color = $er_im1 = $er_im2 = $er_im3 = "";

$targetDir = "uploads/";

if (array_key_exists('add', $_POST)) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $year =  $_POST['year'];
    $desc =  $_POST['description'];
    $etype =  $_POST['engine-type'];
    $ftype = $_POST['fuel-type'];
    $hpower =  $_POST['horsepower'];
    $scount =  $_POST['seat-count'];
    $color =  $_POST['color'];

    $user = $_SESSION['user_id'];
    $timestamp = time();

    $f1 = $targetDir . $_SESSION["user_id"] . '_' . $timestamp . '_vehical.' . pathinfo(basename($_FILES["image1"]["name"]), PATHINFO_EXTENSION);;
    $f2 = $targetDir . $_SESSION["user_id"] . '_' . $timestamp . '_interior.' . pathinfo(basename($_FILES["image2"]["name"]), PATHINFO_EXTENSION);;
    $f3 = $targetDir . $_SESSION["user_id"] . '_' . $timestamp . '_engine.' . pathinfo(basename($_FILES["image3"]["name"]), PATHINFO_EXTENSION);;

    move_uploaded_file($_FILES["image1"]["tmp_name"], $f1);
    move_uploaded_file($_FILES["image2"]["tmp_name"], $f2);
    move_uploaded_file($_FILES["image3"]["tmp_name"], $f3);

    $sql = "INSERT INTO cars VALUES('NULL','$name','$price','$ftype','$year','$desc','$etype','$hpower','$scount','$color','$f1','$f2','$f3','0','$user')";
    if (($__conn->query($sql) === TRUE)) {
        header("location:./index.php");
    }
}


?>


<body id="add">
    <?php include_once('./components/header.php'); ?>

    <section>

        <div class="form-wrap">
            <h1>Add New Car</h1>
            <form id="add-car-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" onsubmit="return validate()">
                <div class="wrap">
                    <label for="make">Name:</label><br>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="wrap">
                    <label for="year">Year:</label><br>
                    <input type="text" id="year" name="year" required>
                </div>
                <div class="wrap">
                    <label for="description">Description:</label><br>
                    <input type="text" id="description" name="description" required>
                </div>
                <div class="wrap">
                    <label for="price">Price:</label><br>
                    <input type="text" id="price" name="price" required>
                </div>
                <div class="wrap">
                    <label for="engine-type">Engine Type:</label><br>
                    <select id="engine-type" name="engine-type">
                        <option value="V4">V4</option>
                        <option value="V6">V6</option>
                        <option value="V8">V8</option>
                        <option value="Inline-4">Inline-4</option>
                        <option value="Inline-6">Inline-6</option>
                    </select>
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
                    <label for="horsepower">Horsepower:</label><br>
                    <input type="number" id="horsepower" name="horsepower" required>
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
                    <label for="image3">Engine Image:</label><br>
                    <input type="file" id="image3" name="image3" required>
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
        const rdesc = /^[A-Z a-z 0-9 , . /]+$/;
        const ryear = /^[0-9]{4}$/;
        const rprice = /^[0-9]{4,10}$/;
        const rhpower = /^[0-9]{2,5}$/;
        const rscount = /^[0-9]{1,2}$/;
        var name = document.getElementById('name').value;
        var year = document.getElementById('year').value;
        var description = document.getElementById('description').value;
        var price = document.getElementById('price').value;
        var engine_type = document.getElementById('engine-type').value;
        var fuel_type = document.getElementById('fuel-type').value;
        var horsepower = document.getElementById('horsepower').value;
        var seat_count = document.getElementById('seat-count').value;
        var color = document.getElementById('color').value;
        var image1 = document.getElementById('image1').value;
        var image2 = document.getElementById('image2').value;
        var image3 = document.getElementById('image3').value;

        if (!rname.test(name)) {
            alert("Invalid name format or empty field");
            return false;
        }
        if (!ryear.test(year)) {
            alert("Invalid year format or empty field");
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
        if (!rhpower.test(horsepower)) {
            alert("Invalid horsepower format or empty field");
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
        if (image3 == null) {
            alert("Enter engine image");
            return false;
        }
        return true;
    }
</script>


</html>