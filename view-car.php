<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('./components/attachments.php'); ?>
    <title>Vehicle Details</title>
</head>
<?php
$car = "";
// car ekaka id eka hambunoth e car eke details tika gannawa
if (array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $sql = "SELECT a.*, b.username,b.contact FROM cars a INNER JOIN users b ON a.user_id = b.id WHERE a.id='$id'";
    $result = $__conn->query($sql);
    if ($result->num_rows == 0) {
        // car details naththan index ekata return karanawa
        header('location:./index.php');
    }
    $car = $result->fetch_assoc();
}
?>

<body id="details" class="car1" style="background-image: url('./<?php echo $car['image1']; ?>');">
    <?php include_once('./components/header.php'); ?>
    <main>
        <section id="vehicle-details">
            <h2>Vehicle Details</h2>
            <div class="vehicle-images">
                <img src="./<?php echo $car['image1']; ?>" alt="<?php echo $car['image1']; ?>">
                <img src="./<?php echo $car['image2']; ?>" alt="<?php echo $car['image2']; ?>">
                <img src="./<?php echo $car['image3']; ?>" alt="<?php echo $car['image3']; ?>">
            </div>
            <div class="vehicle-info">
                <h3><?php echo $car['name']; ?></h3>
                <ul>
                    <li><span>Price:</span> $<?php echo $car['price']; ?></li>
                    <li><span>Year:</span> <?php echo $car['year']; ?></li>
                    <li><span>Description:</span> <?php echo $car['description']; ?></li>
                    <li><span>Engine Type:</span> <?php echo $car['eng_type']; ?></li>
                    <li><span>Fuel Type:</span> <?php echo $car['fuel_type']; ?></li>
                    <li><span>Horsepower:</span> <?php echo $car['horsepower']; ?></li>
                    <li><span>Seat Count:</span> <?php echo $car['seat_count']; ?></li>
                    <li><span>Color:</span> <?php echo $car['color']; ?></li>
                    
                </ul>
            </div>
            <div class="vehicle-info">
                <h3>Owner Infomation</h3>
                <ul>
                    <li><span>Name:</span> <?php echo $car['username']; ?></li>
                    <li><span>Contact No:</span> <?php echo $car['contact']; ?></li>
                </ul>
            </div>
        </section>
    </main>

    <?php include_once('./components/footer.php'); ?>

</body>

</html>