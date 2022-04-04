<?php

include 'dbcon.php';

$user_id = $_GET['id'] ?? '';

$sql = "DELETE FROM users WHERE id = $user_id";

if (mysqli_query($con, $sql)) {

    header('location: manage-user.php');
} else {

    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}