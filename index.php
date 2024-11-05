<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
    <?php include_once('./components/attachments.php'); ?>
</head>

<body>
    <?php include_once('./components/header.php'); ?>
    <section id="hero">
        <div class="hero-content" style="padding-bottom: 20px;">
            <br>
            <h1>Welcome to Vehicle Sales and Rentals</h1>
            <p>Our vehicle selling website is a reliable and user-friendly platform that connects buyers and sellers in
                the automotive industry. Whether you're in the market for a new car or looking to sell your existing
                vehicle, our website offers a seamless experience. With a wide range of listings from various car
                brands, models, and price ranges, finding your perfect vehicle has never been easier.</p>
            <p>Browse through our extensive collection of cars, motorcycles, trucks, and more. Each listing provides
                comprehensive details about the vehicle, including its make, model, year, price, engine type, fuel type,
                horsepower, seat count, and color. High-quality images showcase the vehicles from different angles,
                giving you a closer look at their features and design.</p>
                <br>
            <a href="./search.php" class="cta-button">Browse Vehicles</a>
        </div>

    </section>

    <section id="featured-vehicles">
        <h2>Featured Vehicles</h2>
        <div class="vehicle-listings">

            <?php
            $sql = "SELECT name,image1,price,id FROM cars LIMIT 3";
            $result = $__conn->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
            <div class="vehicle">
                <img style="width:200px; height:130px;" src="./<?php echo $row['image1']; ?>" alt="<?php echo $row['image1']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p>Price: $<?php echo $row['price']; ?></p>
                <a href="./view-car.php?id=<?php echo $row['id']; ?>">View Car</a>
            </div>
            <?php } ?>
        </div>
    </section>

    <?php include_once('./components/footer.php'); ?>
</body>

</html>