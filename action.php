<?php

//database connection
include 'db.php';

//user create
if ($_POST['type'] == "USER_CREATE") {
    $name = $_POST['name'];
    $username = $_POST['userName'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $sql = "INSERT INTO `user_tbl`(`name`, `username`, `email`, `address`) VALUES ('$name','$username','$email','$address')";

    if (mysqli_query($conn, $sql)) {
        $arr = array('status' => 'success', 'msg' => 'Data Insert Successfully!');
    } else {
        $arr = array('status' => 'error', 'msg' => 'Data Not Insert');
    }
    echo json_encode($arr);
}
