<?php 
    include "db.php";
    $query = "select temperature, humidity, illuminance, date from tbl_state where device_id='".$_GET['did']."' order by id desc limit 7;";
    $result = mysqli_query($conn, $query);
    $i=0;
    while($row = mysqli_fetch_assoc($result)){
        $dataset['label'][$i] = $row['date'];
        $dataset['temp'][$i] = $row['temperature'];
        $dataset['humi'][$i] = $row['humidity'];
        $dataset['illumi'][$i] = $row['illuminance'];
        $i++;
    }
    echo json_encode($dataset);
?>