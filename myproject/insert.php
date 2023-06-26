<?php
    include "db.php";
    date_default_timezone_set('Asia/Seoul');
    $temp = $_GET['temp'];
    $humi = $_GET['humi'];
    $illumi = $_GET['illumi'];
    $date = date("Y-m-d H:i:s", time());
    $device_id = $_GET['device_id'];
    $query = "insert into tbl_state(temperature, humidity, illuminance, date, device_id) values(".$temp.", ".$humi.", ".$illumi.", '".$date."', '".$device_id."');";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "입력 성공\n";
    }else {
        echo "입력 실패\n";
    }
    $query = "SELECT * FROM tbl_ld_state order by id desc limit 1;";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)){
        $led_state = $row['led_state'];
        $door_state = $row['door_state'];
    }
    if ($result) {
        echo "led : ".$led_state."\n";
        echo "door : ".$door_state."\n";
    }else {
        echo "실패\n";
    }
?>