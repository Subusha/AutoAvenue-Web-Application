<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('./dbconfig.php');

if (array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $sql = "DELETE FROM rented_details WHERE id=$id ";
    $__conn->query($sql);
    header("location: ../inventory.php");
} else {
    header("location: ../index.php");
}
