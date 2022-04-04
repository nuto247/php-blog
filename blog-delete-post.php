<?php

include 'dbcon.php';

$post_id = $_GET['id'] ?? '';

$sql = "DELETE FROM post WHERE id = $post_id";

if (mysqli_query($con, $sql)) {

    header('location: blog-manage-posts.php');
} else {

    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}