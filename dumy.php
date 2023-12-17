<?php

$name = $_POST['name'];
$userName = $_POST['userName'];
$name = $_POST['userName'];
$email = $_POST['email'];
$address = $_POST['address'];

// Check if the user name already exists
$checkDuplicateQuery = "SELECT COUNT(*) AS count FROM user_tbl WHERE name = '$name'";
$result = mysqli_query($conn, $checkDuplicateQuery);
$row = mysqli_fetch_assoc($result);
$userCount = $row['count'];


if ($userCount > 0) {
    $arr = array('status' => 'error', 'msg' => 'User name already exists. Please choose a different one.');
} elseif ($name != '' && $userName != '' && $email != '' && $address != '') {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $arr = array('status' => 'error', 'msg' => 'Invalid email format');
    } else {

        $sql = "INSERT INTO `user_tbl`(`name`, `username`, `email`, `address`) VALUES ('$name','$username','$email','$address')";

        if (mysqli_query($conn, $sql)) {
            $arr = array('status' => 'success', 'msg' => 'Data Insert Successfully!');

            // //email function call
// $insertedEmail = $email;
// $insertedUserName = $name;
// $insertedUserPass = $password;
// mailFunction($insertedEmail, $insertedUserName, $insertedUserPass);



        } else {
            $arr = array('status' => 'error', 'msg' => 'Data Not Insert');
        }
    }
} else {
    $arr = array('status' => 'error', 'msg' => 'Input field must not be empty');
}

echo json_encode($arr);