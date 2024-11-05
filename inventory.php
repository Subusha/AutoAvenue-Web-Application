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
    $pdf->AddPage('L', array(210, 240));

    // Set font for title
    $pdf->SetFont('Arial', 'B', 16);

    // Title
    $pdf->Cell(0, 10, 'Inventory', 0, 1, 'C');
    $pdf->Ln(10); // Add some vertical spacing after the title

    // Set font for title
    $pdf->SetFont('Arial', 'B', 14);

    // Title
    $pdf->Cell(0, 10, 'Sales Cars', 0, 1, 'C');
    $pdf->Ln(10); // Add some vertical spacing after the title

    // Set font
    $pdf->SetFont('Arial', '', 9);

    // Add content from HTML table
    $pdf->Cell(60, 10, 'Name', 1);
    $pdf->Cell(25, 10, 'Price', 1);
    $pdf->Cell(20, 10, 'Fuel Type', 1);
    $pdf->Cell(20, 10, 'Engine Type', 1);
    $pdf->Cell(15, 10, 'Year', 1);
    $pdf->Cell(20, 10, 'Color', 1);
    $pdf->Cell(20, 10, 'Horsepower', 1);
    $pdf->Cell(20, 10, 'Seat Count', 1);
    $pdf->Ln();

    // Fetch data again if needed
    $sql = "SELECT * FROM cars";
    $result = $__conn->query($sql);
    while ($car = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, $car['name'], 1);
        $pdf->Cell(25, 10, $car['price'], 1);
        $pdf->Cell(20, 10, $car['fuel_type'], 1);
        $pdf->Cell(20, 10, $car['eng_type'], 1);
        $pdf->Cell(15, 10, $car['year'], 1);
        $pdf->Cell(20, 10, $car['color'], 1);
        $pdf->Cell(20, 10, $car['horsepower'], 1);
        $pdf->Cell(20, 10, $car['seat_count'], 1);

        $pdf->Ln();
    }

        $pdf->Ln(20);

        // Set font for title
        $pdf->SetFont('Arial', 'B', 14);

        // Title
        $pdf->Cell(0, 10, 'Rental Cars', 0, 1, 'C');
        $pdf->Ln(10); // Add some vertical spacing after the title
    
        // Set font
        $pdf->SetFont('Arial', '', 9);
    
        // Add content from HTML table
        $pdf->Cell(60, 10, 'Name', 1);
        $pdf->Cell(25, 10, 'Price', 1);
        $pdf->Cell(20, 10, 'Fuel Type', 1);
        $pdf->Cell(20, 10, 'Color', 1);
        $pdf->Cell(20, 10, 'Seat Count', 1);
        $pdf->Ln();
    
        // Fetch data again if needed
        $sql = "SELECT * FROM rent_cars";
        $result = $__conn->query($sql);
        while ($car = $result->fetch_assoc()) {
            $pdf->Cell(60, 10, $car['name'], 1);
            $pdf->Cell(25, 10, $car['price'], 1);
            $pdf->Cell(20, 10, $car['fuel_type'], 1);
            $pdf->Cell(20, 10, $car['color'], 1);
            $pdf->Cell(20, 10, $car['seat_count'], 1);
    
            $pdf->Ln();
        }

        $pdf->Ln(20);

        // Set font for title
        $pdf->SetFont('Arial', 'B', 14);

        // Title
        $pdf->Cell(0, 10, 'Rented Details', 0, 1, 'C');
        $pdf->Ln(10); // Add some vertical spacing after the title
    
        // Set font
        $pdf->SetFont('Arial', '', 9);
    
        // Add content from HTML table
        $pdf->Cell(30, 10, 'Name', 1);
        $pdf->Cell(55, 10, 'Email', 1);
        $pdf->Cell(30, 10, 'Contact Number', 1);
        $pdf->Cell(60, 10, 'Vehicle Name', 1);
        $pdf->Cell(20, 10, 'Rent Price', 1);
        $pdf->Cell(25, 10, 'Needed Days', 1);
        $pdf->Ln();
    
        // Fetch data again if needed
        $sql = "SELECT a.*, b.username,b.contact FROM rented_details a INNER JOIN users b ON a.user_id = b.id";
        $result = $__conn->query($sql);
        while ($car = $result->fetch_assoc()) {
            $pdf->Cell(30, 10, $car['username'], 1);
            $pdf->Cell(55, 10, $car['email'], 1);
            $pdf->Cell(30, 10, $car['contact'], 1);
            $pdf->Cell(60, 10, $car['vehicalname'], 1);
            $pdf->Cell(20, 10, $car['Rent_price'], 1);
            $pdf->Cell(25, 10, $car['No_of_Days'], 1);
    
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
    $sql = "SELECT a.*, b.username,b.contact FROM cars a INNER JOIN users b ON a.user_id = b.id";
    $result = $__conn->query($sql);

    $sql1 = "SELECT a.*, b.username,b.contact FROM rented_details a INNER JOIN users b ON a.user_id = b.id";
    $result1 = $__conn->query($sql1);

    $sql2 = "SELECT a.*,b.username,b.contact FROM rent_cars a INNER JOIN users b ON a.user_id = b.id";
    $result2 = $__conn->query($sql2);


    ?>

    <section>
        <h1>All Cars</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                    <th style="background-color: #CB4154;">Name</th>
                    <th style="background-color: #CB4154;">Price</th>
                    <th style="background-color: #CB4154;">Fuel Type</th>
                    <th style="background-color: #CB4154;">Engine Type</th>
                    <th style="background-color: #CB4154;">Year</th>
                    <th style="background-color: #CB4154;">Color</th>
                    <th style="background-color: #CB4154;">Horsepower</th>
                    <th style="background-color: #CB4154;">Seat Count</th>
                    <th style="background-color: #CB4154;">Action</th>
                    </tr>
                    <?php
                    while ($car = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car['name']; ?></td>
                            <td><?php echo $car['price']; ?></td>
                            <td><?php echo $car['fuel_type']; ?></td>
                            <td><?php echo $car['eng_type']; ?></td>
                            <td><?php echo $car['year']; ?></td>
                            <td><?php echo $car['color']; ?></td>
                            <td><?php echo $car['horsepower']; ?></td>
                            <td><?php echo $car['seat_count']; ?></td>
                            <td><button style="border-radius: 40px; background-color:#FF3838; height: 30px;"><a style="text-decoration: none; color:black;" href="./components/delete-car-inventory.php?id=<?php echo $car['id']; ?>">Delete Car</a></button>&nbsp
                            <button style="margin-right: -85px; border-radius: 40px; background-color:#FFEA19; height: 30px;"><a style=" text-decoration: none; color:black;" href="./edit-car-admin.php?id=<?php echo $car['id']; ?>">Update Car</a></button></td>
                        </tr>
                    <?php

                    }


                    ?>

                </table>


            </div>
        </div>
    </section>




    <section>
        <h1>All Rental Cars</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                    <th style="background-color: #CB4154;">Name</th>
                    <th style="background-color: #CB4154;">Price</th>
                    <th style="background-color: #CB4154;">Fuel Type</th>
                    <th style="background-color: #CB4154;">Color</th>
                    <th style="background-color: #CB4154;">Seat Count</th>
                    <th style="background-color: #CB4154;">Action</th>
                    </tr>
                    <?php
                    while ($car2 = $result2->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car2['name']; ?></td>
                            <td><?php echo $car2['price']; ?></td>
                            <td><?php echo $car2['fuel_type']; ?></td>
                            <td><?php echo $car2['color']; ?></td>
                            <td><?php echo $car2['seat_count']; ?></td>
                            <td><button style="border-radius: 40px; background-color:#FF3838; height: 30px;"><a style="text-decoration: none; color:black;" href="./components/delete-rent-car-inventory.php?id=<?php echo $car2['id']; ?>">Delete Car</a></button>&nbsp
                            <button style="margin-right: -85px; border-radius: 40px; background-color:#FFEA19; height: 30px;"><a style=" text-decoration: none; color:black;" href="./edit-rent-car-admin.php?id=<?php echo $car2['id']; ?>">Update Car</a></button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </section>




    <section>
        <h1>All Rented Details</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                    <th style="background-color: #CB4154;">User Name</th>
                    <th style="background-color: #CB4154;">Email</th>
                    <th style="background-color: #CB4154;">Contact No</th>
                    <th style="background-color: #CB4154;">Vehicle Name</th>
                    <th style="background-color: #CB4154;">Rent Price</th>
                    <th style="background-color: #CB4154;">Need Days</th>
                    <th style="background-color: #CB4154;">Action</th>
                    </tr>
                    <?php
                    while ($car1 = $result1->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car1['username']; ?></td>
                            <td><?php echo $car1['email']; ?></td>
                            <td><?php echo $car1['contact']; ?></td>
                            <td><?php echo $car1['vehicalname']; ?></td>
                            <td><?php echo $car1['Rent_price']; ?></td>
                            <td><?php echo $car1['No_of_Days']; ?></td>
                            <td><button style="border-radius: 40px; background-color:#FF3838; height: 30px;"><a style="text-decoration: none; color:black;" href="./components/delete-rent-details.php?id=<?php echo $car1['id']; ?>">Delete Rent</a></button></td>
                        </tr>
                    <?php

                    }


                    ?>

                </table>
                <br><br>
                <form id="generate_pdf_form" method="POST" action="inventory.php">
                    <button type="submit" name="generate_pdf_btn" class="btn btn-outline-danger">Generate Report</button>
                </form>


            </div>
        </div>
    </section>

    <?php include_once('./components/footer.php'); ?>

    <script>
        document.getElementById('generate_pdf_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'inventory.php', true);
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
                    a.download = 'Inventory.pdf'; // Set the file name
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