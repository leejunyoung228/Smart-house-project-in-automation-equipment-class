<?php
    include "header.php";
    include "db.php";
    $query = "select * from tbl_state where ".$_GET['id'].";";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)){
        $device_id = $row['device_id'];
        $temperature = $row['temperature'];
        $humidity = $row['humidity'];
        $illuminance = $row['illuminance'];
    }
?>
<section>
    <form method="post" action="m_action.php">
        <table border="1">
            <tr>
                <td>ID</td>
                <td><input type="text" name=id value="<?php echo $_GET['id'];?>" readonly></td>
            </tr>
            <tr>
                <td>
                    온도
                </td>
                <td>
                    <input type="text" name=temp value="<?php echo $temperature;?>">
                </td>
            </tr>
            <tr>
                <td>
                    습도
                </td>
                <td>
                    <input type="text" name=humi value="<?php echo $humidity;?>">
                </td>
            </tr>
            <tr>
                <td>
                    빛의 양
                </td>
                <td>
                    <input type="text" name=illu value="<?php echo $illuminance;?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="저장">
                </td>
            </tr>
        </table>
    </form>
</section>

<?php
    include "footer.php";
?>