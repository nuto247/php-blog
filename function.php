<?php

include 'dbcon.php';

function pre($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit;
}

function getUser()
{

    global $con;

    $user_id = $_SESSION['user_id'];


    $query = "SELECT * FROM users WHERE id = $user_id ";

    if ($results = mysqli_query($con, $query)) {

        if (mysqli_num_rows($results) > 0) {

            return mysqli_fetch_assoc($results);
        }

        // $row = mysqli_fetch_row($result);

    } else {

        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}


// check if user is admin
function isAdmin()
{

   global $con;

    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE id = $user_id ";

    if ($results = mysqli_query($con, $query)) {

        if (mysqli_num_rows($results) > 0) {

             $userdata = mysqli_fetch_assoc($results);

             if($userdata['user_type'] == 1) {
                return true;
             } else {
                return false;
             }
        }

        // $row = mysqli_fetch_row($result);

    } else {

        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }

}
