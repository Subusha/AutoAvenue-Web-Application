<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('./dbconfig.php');

if (array_key_exists('id', $_GET)) {
    $id = $_GET['id'];
    $sql = "DELETE FROM cars WHERE id = $id AND user_id=" . $_SESSION['user_id'];
    $__conn->query($sql);
    header("location: ../mycars.php");
} else {
    header("location: ../index.php");
}
