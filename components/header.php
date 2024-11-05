<?php

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to check if user is an admin
function isAdmin() {
    return (isset($_SESSION['role']) && $_SESSION['role'] == 0);
}

// Function to redirect to home page
function redirectToHome() {
    header("Location: ./index.php");
    exit();
}

// Function to handle logout
function logout() {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    redirectToHome(); // Redirect to home page
}

// Check if logout action is requested
if (isset($_GET['logout'])) {
    logout(); // Call logout function
}

?>

<header style="height:70px;">
    <nav style="font-size:20px; padding-left:20px;">
        <ul>
            <li>
                <a href="./index.php">Home</a>
            </li>

            <?php if (isLoggedIn()) { ?>
            <?php if (isAdmin()) { ?>
            <li class="dropdown">
                <a
                    href="#"
                    class="dropdown-toggle"
                    id="carsDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Cars
                </a>
                <ul class="dropdown-menu" aria-labelledby="carsDropdown">
                    <li>
                        <a class="dropdown-item" href="./add.php">Add Sales Car</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./add_rent_cars.php">Add Rent Car</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./mycars.php">My Cars</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./admin_cars.php">View Sales Cars</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./admin_rent_cars.php">View Rental Cars</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./admin_users.php">View Users</a>
            </li>
            <li>
                <a href="./inventory.php">Inventory</a>
            </li>
            <li>
                <a href="./customercare.php">Customer Care</a>
            </li>
        <?php } else { ?>
            <li>
                <a href="./about-us.php">About Us</a>
            </li>
            <li class="dropdown">
                <a
                    href="#"
                    class="dropdown-toggle"
                    id="carsDropdown"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Cars
                </a>
                <ul class="dropdown-menu" aria-labelledby="carsDropdown">
                    <li>
                        <a class="dropdown-item" href="./add.php">Add Car</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./mycars.php">My Cars</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./rent.php">Rent Cars</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="./search.php">Buy Cars</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="./feedback.php">Feedbacks</a>
            </li>
            <li>
                <a href="./contact.php">Contact Us</a>
            </li>
            <?php } ?>
            <ul class="navbar" style="display: flex; justify-content: space-between;">
                <li>
                    <a href="?logout=true">Logout</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="./about.php">About Us</a>
                </li>
                <li style="margin-left: auto;">
                    <a href="./login.php">Login</a>
                </li>
            </ul>
            <?php } ?>
    </ul>
</nav>
</header>