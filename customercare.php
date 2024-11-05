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

    $pdf->SetFont('Arial', 'B', 16);

    // Title
    $pdf->Cell(0, 10, 'Customer Care', 0, 1, 'C');
    $pdf->Ln(10); // Add some vertical spacing after the title


    // Set font for title
    $pdf->SetFont('Arial', 'B', 14);

    // Title
    $pdf->Cell(0, 5, 'User Feedbacks', 0, 1, 'C');
    $pdf->Ln(10); // Add some vertical spacing after the title

    // Set font
    $pdf->SetFont('Arial', '', 9);

    // Add content from HTML table
    $pdf->Cell(60, 10, 'Name', 1);
    $pdf->Cell(55, 10, 'Email', 1);
    $pdf->Cell(20, 10, 'Contact No', 1);
    $pdf->Cell(15, 10, 'Satisfy', 1);
    $pdf->Cell(70, 10, 'Feedback', 1);
    $pdf->Ln();

    // Fetch data again if needed
    $sql = "SELECT * FROM feedback";
    $result = $__conn->query($sql);
    while ($car = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, $car['username'], 1);
        $pdf->Cell(55, 10, $car['email'], 1);
        $pdf->Cell(20, 10, $car['contact'], 1);
        $pdf->Cell(15, 10, $car['satisfy'], 1);
        $pdf->Cell(70, 10, $car['message'], 1);
        $pdf->Ln();
    }

        $pdf->Ln(10);

        // Set font for title
        $pdf->SetFont('Arial', 'B', 14);

        // Title
        $pdf->Cell(0, 10, 'Contact Details', 0, 1, 'C');
        $pdf->Ln(5); // Add some vertical spacing after the title
    
        // Set font
        $pdf->SetFont('Arial', '', 9);
    
        // Add content from HTML table
        $pdf->Cell(60, 10, 'Name', 1);
        $pdf->Cell(55, 10, 'Email', 1);
        $pdf->Cell(20, 10, 'Contact No', 1);
        $pdf->Cell(80, 10, 'Message', 1);
    
        $pdf->Ln();
    
        // Fetch data again if needed
        $sql = "SELECT * FROM contact_us";
        $result = $__conn->query($sql);
        while ($car = $result->fetch_assoc()) {
            $pdf->Cell(60, 10, $car['name'], 1);
            $pdf->Cell(55, 10, $car['email'], 1);
            $pdf->Cell(20, 10, $car['contact'], 1);
            $pdf->Cell(80, 10, $car['message'], 1);
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
    <title>Vehicle Sales Homepage</title>
</head>

<body id="search">


    <?php include_once('./components/header.php'); ?>

    <?php
    $sql1 = "SELECT * FROM feedback";
    $result1 = $__conn->query($sql1);

    $sql2 = "SELECT * FROM contact_us";
    $result2 = $__conn->query($sql2);

    ?>

    <section>
        <h1>All User Feedbacks</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                    <th style="background-color: #454545;">User Name</th>
                    <th style="background-color: #454545;">Email</th>
                    <th style="background-color: #454545;">Contact No</th>
                    <th style="background-color: #454545;">Feedback</th>
                    <th style="background-color: #454545;">Satisfy</th>
                    <th style="background-color: #454545;">Action</th>
                    </tr>
                    <?php
                    while ($car1 = $result1->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car1['username']; ?></td>
                            <td><?php echo $car1['email']; ?></td>
                            <td><?php echo $car1['contact']; ?></td>
                            <td><?php echo $car1['message']; ?></td>
                            <td><?php echo $car1['satisfy']; ?></td>
                            <td><button style="border-radius: 40px; background-color:#FF3838; height: 30px;"><a style="text-decoration: none; color:black;" href="./components/delete-feedback.php?id=<?php echo $car1['id']; ?>">Delete Feedback</a></button></td>
                        </tr>
                    <?php

                    }


                    ?>

                </table>


            </div>
        </div>
    </section>


    <section>
        <h1>Contact Us Details</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                    <th style="background-color: #454545;">User Name</th>
                    <th style="background-color: #454545;">Email</th>
                    <th style="background-color: #454545;">Contact No</th>
                    <th style="background-color: #454545;">Message</th>
                    <th style="background-color: #454545;">Action</th>
                    </tr>
                    <?php
                    while ($car2 = $result2->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car2['name']; ?></td>
                            <td><?php echo $car2['email']; ?></td>
                            <td><?php echo $car2['contact']; ?></td>
                            <td><?php echo $car2['message']; ?></td>
                            <td><button style="border-radius: 40px; background-color:#FF3838; height: 30px;"><a style="text-decoration: none; color:black;" href="./components/delete-contact.php?id=<?php echo $car2['id']; ?>">Delete Contact</a></button></td>
                        </tr>
                    <?php

                    }


                    ?>

                </table>

                <br><br>
                <form id="generate_pdf_form" method="POST" action="customercare.php">
                    <button type="submit" name="generate_pdf_btn" class="btn btn-outline-secondary">Generate Report</button>
                </form>

            </div>
        </div>
    </section>



    <?php include_once('./components/footer.php'); ?>

    <script>
        document.getElementById('generate_pdf_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'customercare.php', true);
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
                    a.download = 'CustomerCare.pdf'; // Set the file name
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