<?php
    include "db.php";
    $led_state = $_POST['led'];
    $door_state = $_POST['door'];
    // echo $led_state;
    // echo $door_state;
    $date = date("Y-m-d H:i:s", time());
    $query = "insert into tbl_ld_state(device_id, led_state, door_state, date) values('device1', ".$led_state.", ".$door_state.", '".$date."');";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "입력 성공";
    }else {
        echo "입력 실패";
    }
?>
<meta http-equiv="refresh" content="0; url=house.php">