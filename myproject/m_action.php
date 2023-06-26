<?php
    include "db.php";
    $query = "update tbl_State set temperature=".$_POST['temp'].", humidity=".$_POST['humi'].", illuminance=".$_POST['illu']." where id=".$_POST['id'].";";
    $result = mysqli_query($conn, $query);

    // if ($result) {
    //     echo "<script>";
    //     echo "alert('성공');";
    //     echo "</script>";
    // }else {
    //     echo "<script>";
    //     echo "alert('실패');";
    //     echo "</script>";
    // }
?>
<meta http-equiv="refresh" content="0; url=list.php">