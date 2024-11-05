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
    $pdf->Cell(0, 10, 'Registered Users', 0, 1, 'C');
    $pdf->Ln(10); // Add some vertical spacing after the title

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Add content from HTML table
    $pdf->Cell(60, 10, 'Name', 1);
    $pdf->Cell(70, 10, 'Email', 1);
    $pdf->Cell(40, 10, 'Contact No', 1);
    $pdf->Ln();

    // Fetch data again if needed
    $sql = "SELECT * FROM users";
    $result = $__conn->query($sql);
    while ($car = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, $car['username'], 1);
        $pdf->Cell(70, 10, $car['email'], 1);
        $pdf->Cell(40, 10, $car['contact'], 1);
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
    $sql = "SELECT email, username, id, contact FROM users WHERE role = 1";
    $result = $__conn->query($sql);
    ?>

    <section>
        <h1>Registered Users</h1>
        <hr>

        <div id="search-results">
            <div class="table-wrap">
                <table id="table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    while ($car = $result->fetch_assoc()) {
                    ?>

                        <tr>
                            <td><?php echo $car['username']; ?></td>
                            <td><?php echo $car['email']; ?></td>
                            <td><?php echo $car['contact']; ?></td>
                            <td><button style="border-radius: 40px; background-color:#FF3838; height: 30px;"><a style="text-decoration: none; color:black;" href="./components/delete-user.php?id=<?php echo $car['id']; ?>">Delete User</a></button></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
                <br>
                <form id="generate_pdf_form" method="POST" action="admin_users.php">
                    <button type="submit" name="generate_pdf_btn" class="btn btn-outline-success">Generate PDF</button>
                </form>

            </div>
        </div>
    </section>
    <br><br>

    <?php include_once('./components/footer.php'); ?>

<script>
        document.getElementById('generate_pdf_form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'admin_users.php', true);
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
                    a.download = 'RegisteredUsers.pdf'; // Set the file name
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