<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./components/attachments.php'); ?>
    <title>Vehicle Sales Homepage</title>
</head>

<body id="search">


    <?php include_once('./components/header.php'); ?>

    <?php
    // car wala thiyena seram tika aragannawa
    $sql = "SELECT * FROM rent_cars ";
    $result = $__conn->query($sql);
    
    ?>

    <section>
        <h1>Search Cars</h1>

        <form id="search-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="make">Search by name / year:</label>
            <input type="text" id="make" name="key">

            <input type="submit" name="search" value="Search">
        </form>
        <hr>

        <div id="search-results">
            <div class="vehicle-listings">
                <?php
                while ($car = $result->fetch_assoc()) {
                ?>

                    <div class="vehicle">
                        <img style="width:250px; height:190px;" src="./<?php echo $car['image1']; ?>" alt="<?php echo $car['image1']; ?>">
                        <h3><?php echo $car['name']; ?></h3>
                        <p>Price: $<?php echo $car['price']; ?></p>
                        <a href="./view-rent-car.php?id=<?php echo $car['id']; ?>">Rent Car</a>
                    </div>
                <?php

                }


                ?>

            </div>
        </div>
    </section>

    <?php include_once('./components/footer.php'); ?>

</body>

</html>