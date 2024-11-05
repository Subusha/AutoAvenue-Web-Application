<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('./dbconfig.php');

if (array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $sql = "DELETE FROM rent_cars WHERE id = $id AND user_id=" . $_SESSION['user_id'];
    $__conn->query($sql);
    header("location: ../rent.php");
} else {
    header("location: ../rent.php");
}