<!DOCTYPE html>
<html lang="en">

<head>

    <?php include_once('./components/attachments.php'); ?>
    <title>Vehicle Sales Homepage</title>
</head>

<body id="search">


    <?php include_once('./components/header.php'); ?>

    <?php
    // user ta adala car tika db eken select karala gannawa
    $sql = "SELECT a.*, b.username,b.contact FROM cars a INNER JOIN users b ON a.user_id = b.id WHERE b.id = " . $_SESSION['user_id'];
    $result = $__conn->query($sql);
    ?>

    <section>
        <h1>My Cars</h1>
        <hr>

        <div id="search-results">
            <div class="vehicle-listings">
                <?php
                // user  ge car tika aragena e tike loop ekata dala eka eka car eke details tika pennanawa
                while ($car = $result->fetch_assoc()) {
                ?>

                    <div class="vehicle">
                        <img style="width:250px; height:190px;" src="<?php echo $car['image1']; ?>" alt="Car 1">
                        <h3><?php echo $car['name']; ?></h3>
                        <p>Price: LKR <?php echo $car['price']; ?></p>
                        <a href="./edit-car.php?id=<?php echo $car['id']; ?>">Edit Car</a>
                        <a href="./view-car.php?id=<?php echo $car['id']; ?>">View Car</a>
                        <a href="./components/delete-car.php?id=<?php echo $car['id']; ?>">Delete Car</a>
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