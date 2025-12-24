<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$conn = mysqli_connect($host, $user, $password, $db);

if ($conn === false) {
    die("Database connection failed");
}

if (isset($_POST['apply'])) {

    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $message = $_POST['message'];

    $sql = "INSERT INTO admission (name, email, phone, message)
            VALUES ('$name', '$email', '$phone', '$message')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Apply is successful";
    } else {
        echo "Application failed!";
    }
}
?>
