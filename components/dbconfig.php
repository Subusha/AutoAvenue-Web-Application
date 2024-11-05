<?php
$__servername = "localhost";
$__username = "root";
$__password = "";
$__dbname = "vehicle_sale";
$__page_error = "";

try {
    $__conn = new mysqli($__servername, $__username, $__password, $__dbname);
} catch (mysqli_sql_exception $__e) {
    $_redtitle = 'Database Not Connected';
    $_redmsg = 'This happened sometime when server is down or database is not operational.';
    header("location:./redirect.php?title=$_redtitle&msg=$_redmsg");
    return;
}



