
<?php
ob_start(); // Start output buffering
require_once('./components/attachments.php');

// Check if the Generate PDF button was clicked
if (isset($_POST['generate_pdf_btn'])) {
    // Ensure that no output is sent before FPDF code
    ob_clean(); // Clean (erase) the output buffer

    require_once('fpdf186/fpdf.php');

    // Create new PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font for title
    $pdf->SetFont('Arial', 'B', 16);

    // Title
    $pdf->Cell(0, 10, 'Rental Cars', 0, 1, 'C');
    $pdf->Ln(10); // Add some vertical spacing after the title

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Add content from HTML table
    $pdf->Cell(60, 10, 'Name', 1);
    $pdf->Cell(30, 10, 'Price', 1);
    $pdf->Cell(40, 10, 'Fuel Type', 1);
    $pdf->Cell(20, 10, 'Color', 1);
    $pdf->Cell(30, 10, 'Seat Count', 1);
    $pdf->Ln();

    // Fetch data again if needed
    $sql = "SELECT * FROM rent_cars";
    $result = $__conn->query($sql);
    while ($car = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, $car['name'], 1);
        $pdf->Cell(30, 10, $car['price'], 1);
        $pdf->Cell(40, 10, $car['fuel_type'], 1);
        $pdf->Cell(20, 10, $car['color'], 1);
        $pdf->Cell(30, 10, $car['seat_count'], 1);

        $pdf->Ln();
    }

    // Output PDF
    $pdf->Output('report.pdf', 'D');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('./components/attachments.php'); ?>
    <title>Homepage</title>
</head>

<body id="search">

    <?php include_once('./components/header.php'); ?>
    
    <?php
    $sql1 = "SELECT a.*, b.username,b.contact FROM rent_cars a INNER JOIN users b ON a.user_id = b.id WHERE b.id = " . $_SESSION['user_id'];
    $result1 = $__conn->query($sql1);

    ?>
<section>
        <h1>All Rent Cars</h1>
        <hr>

        <div id="search-results">
            <div class="vehicle-listings">
                <?php
                // user  ge car tika aragena e tike loop ekata dala eka eka car eke details tika pennanawa
                while ($car1 = $result1->fetch_assoc()) {
                ?>

                    <div class="vehicle">
                        <img style="width:250px; height:190px;" src="<?php echo $car1['image1']; ?>" alt="Car 1">
                        <h3><?php echo $car1['name']; ?></h3>
                        <p>Price: LKR <?php echo $car1['price']; ?></p>
                        <a href="./edit-rent-car-admin.php?id=<?php echo $car1['id']; ?>">Edit Car</a>
                        <a href="./components/delete-rent-car.php?id=<?php echo $car1['id']; ?>">Delete Car</a>
                    </div>
                <?php

                }


                ?>

            </div>
        </div>
    </section>




    <?php
    $sql = "SELECT a.*, b.username,b.contact FROM rent_cars a INNER JOIN users b ON a.user_id = b.id";
    $result = $__conn->query($sql);
    ?>

    <section>
        <h1>All Rental Cars</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                        <th style="background-color: #44a6c6;">Name</th>
                        <th style="background-color: #44a6c6;">Price</th>
                        <th style="background-color: #44a6c6;">Fuel Type</th>
                        <th style="background-color: #44a6c6;">Color</th>
                        <th style="background-color: #44a6c6;">Seat Count</th>
                    </tr>
                    <?php
                    while ($car = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car['name']; ?></td>
                            <td><?php echo $car['price']; ?></td>
                            <td><?php echo $car['fuel_type']; ?></td>
                            <td><?php echo $car['color']; ?></td>
                            <td><?php echo $car['seat_count']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <br>
                <form id="generate_pdf_form" method="POST" action="admin_rent_cars.php">
                    <button type="submit" name="generate_pdf_btn" class="btn btn-outline-primary">Generate Report</button>
                </form>

            </div>
        </div>
    </section>

    <?php include_once('./components/footer.php'); ?>

    <script>
        document.getElementById('generate_pdf_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'admin_rent_cars.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.responseType = 'blob'; // Set response type to blob
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Create a blob URL from the response
                    var blob = new Blob([xhr.response], { type: 'application/pdf' });
                    var url = window.URL.createObjectURL(blob);
                    // Create a temporary link element
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'RentalCars.pdf'; // Set the file name
                    document.body.appendChild(a);
                    a.click(); // Trigger the download
                    // Cleanup
                    window.URL.revokeObjectURL(url);
                    document.body.removeChild(a);
                }
            };
            xhr.send('generate_pdf_btn=1'); // Send the button click information
        });
    </script>

</body>

</html>