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
        $arr = array('status' => 'error', 'msg' => 'Data Not Insert: ' . mysqli_error($conn));
    }
    echo json_encode($arr);
}
//End Create function
//user data show
if ($_POST['type'] == "SHOW_DATA") {

    $sql = "SELECT * FROM user_tbl ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // $id = $_POST['id'];
        $output = "";
        while ($res = mysqli_fetch_assoc($result)) {

            ?>
            <tr>
                <td>
                    <?= $res['id']; ?>
                </td>
                <td>
                    <?= $res['name']; ?>
                </td>
                <td>
                    <?= $res['username']; ?>
                </td>
                <td>
                    <?= $res['email']; ?>
                </td>
                <td>
                    <?= $res['address']; ?>
                </td>
                <td>
                    <button class='btn btn-warning btn-edit' id='btnedit' data-id="<?= $res['id']; ?>">Edit</button>
                    <button id='btndel' class='btn btn-danger btn-delete' data-id="<?= $res['id']; ?>">Delete</button>
                </td>
            </tr>

        <?php }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


//delete portion start
if ($_POST['type'] == 'DELETE_DATA') {
    $id = $_POST['id'];

    $sql = "DELETE FROM user_tbl WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {

        $arr = array('status' => 'success', 'msg' => 'Record deleted successfully!');
        echo json_encode($arr);

    } else {
        echo "Error: " . mysqli_error($conn);
        $arr = array('status' => 'error', 'msg' => 'Error!');
        echo json_encode($arr);

    }
} else {
    $arr = array('status' => 'error', 'msg' => 'Invalid request!');
    echo json_encode($arr);
}


//delete portion end

//edit portion start
if ($_POST['type'] == 'EDIT_DATA') {
    $id = $_POST['id'];

    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `name`, `username`, `email`, `address` FROM `user_tbl` WHERE id = '$id'"));

    $arr = array(
        'name' => $data['name'],
        'username' => $data['username'],
        'email' => $data['email'],
        'address' => $data['address']
    );
    echo json_encode($arr);

}

//edit portion end