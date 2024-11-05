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
    $sql = "SELECT * FROM rent_cars a WHERE a.id='$id'";
    $result = $__conn->query($sql);
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
            </div>
            <div class="vehicle-info">
                <h3><?php echo $car['name']; ?></h3>
                <ul>
                    <li><span>Rent Price:</span> $<?php echo $car['price']; ?></li>
                    <li><span>Fuel Type:</span> <?php echo $car['fuel_type']; ?></li>
                    <li><span>Seat Count:</span> <?php echo $car['seat_count']; ?></li>
                    <li><span>Color:</span> <?php echo $car['color']; ?></li>
                </ul>
            </div>
            <div class="vehicle">
                        <a href="./rent-car-form.php?id=<?php echo $car['id'];?>">Rent Car</a>
                    </div>
        </section>
    </main>

    <?php include_once('./components/footer.php'); ?>

</body>

</html>