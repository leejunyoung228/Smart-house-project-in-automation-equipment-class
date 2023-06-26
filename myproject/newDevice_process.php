<?php
    include "header.php";
    include "db.php";
    $device_id = $_POST['device_id'];
    $device_name = $_POST['device_name'];
    $location = $_POST['location'];
    $conn = mysqli_connect('localhost', $db_id, $db_pw, $db_name);
    $query = "insert into tbl_device values('".$device_id."', '".$device_name."', '".$location."');";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>";
        echo "alert('입력 성공!');";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('입력 실패!');";
        echo "</script>";
    }
?>
<meta http-equiv="refresh" content="0; url=newDevice.php">