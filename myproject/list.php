<?php 
    include "header.php";
    include "db.php";
?>
<section>
<!-- <link rel="stylesheet" href="style.css"> -->
<form method=post action=list.php>
    <table border=1 align=center>
        <tr>
            <th>디바이스ID</th>
            <td>
            <select name=did style="width:100%; text-align: center;">
                <?php
                    $query = "select device_id from tbl_device;";
                    $result = mysqli_query($conn, $query);
                    if(isset($_POST['did'])){
                        while($row = mysqli_fetch_assoc($result)){
                            if ($_POST['did'] == $row['did']) {
                                echo "<option value='".$row['device_id']."' selected=\'selected\'>".$row['device_id']."</option>";
                            }else{
                                echo "<option value='".$row['device_id']."'>".$row['device_id']."</option>";
                            }
                            
                        }
                    }else{
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<option value='".$row['device_id']."'>".$row['device_id']."</option>";
                            
                        }
                    }
                ?>
            </select>
            </td>
        </tr>
        <tr>
            <th>제한</th>
            <td>
            <?php
                if (isset($_POST['limit'])) {
                    if($_POST['limit']==10){
                        echo "<input type=radio name=limit value=10 checked>10개";
                        echo "<input type=radio name=limit value=20>20개";
                        echo "<input type=radio name=limit value=30>30개";
                    }else if($_POST['limit'] == 20){
                        echo "<input type=radio name=limit value=10 >10개";
                        echo "<input type=radio name=limit value=20 checked>20개";
                        echo "<input type=radio name=limit value=30>30개";
                    }elseif ($_POST['limit'] == 30) {
                        echo "<input type=radio name=limit value=10 >10개";
                        echo "<input type=radio name=limit value=20 >20개";
                        echo "<input type=radio name=limit value=30 checked>30개";
                    }

                }else{
                    echo "<input type=radio name=limit value=10 checked>10개";
                    echo "<input type=radio name=limit value=20>20개";
                    echo "<input type=radio name=limit value=30>30개";
                }
            ?>
            </td>
        </tr>
        <tr>
            <th>정렬</th>
            <td>
                <?php
                    if (isset($_POST['order'])) {
                        if($_POST['order'] == 'asc'){
                            echo "<input type=radio name=order value=asc checked>오름차순";
                            echo "<input type=radio name=order value=desc>내림차순";
                        }else if ($_POST['order'] == 'desc') {
                            echo "<input type=radio name=order value=asc >오름차순";
                            echo "<input type=radio name=order value=desc checked>내림차순";
                        }
                    }else{
                        echo "<input type=radio name=order value=asc >오름차순";
                        echo "<input type=radio name=order value=desc checked>내림차순";
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan=2 style="text-align: center;">
            <input type=submit value=확인>
            </td>
        </tr>
    </table>
</form>
<?php
    if(isset($_POST['did'])){
        // echo "<p align=center>Device ID가 선택된경우 DeviceID = ".$_POST['did']."</p><br>";
        $query = "select * from tbl_state where device_id = '".$_POST['did']."' order by date ".$_POST['order']." limit ".$_POST['limit'].";";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);
    if($count > 0){
        echo "<table border=1 width=650 align=center>";
        echo "<tr>";
        echo "<th>key</th>";
        echo "<th>디바이스ID</th>";
        echo "<th>온도</th>";
        echo "<th>습도</th>";
        echo "<th>밝기(낮을수록 밝음)</th>";
        echo "<th>시간</th>";
        echo "<th>수정</th>";
        echo "<th>삭제</th>";
        echo "</tr>";
        $i = 0;
        while($row = mysqli_fetch_assoc($result)){
            if($i == 0){
                $graph2 = $row['temperature'];
                $graph3 = $row['humidity'];
            }
            $mytemp[$i] = $row['temperature'];
            $myhumi[$i] = $row['humidity'];
            $mydate[$i] = $row['date'];
            $i++;

            echo "<tr><td>".$row['id']."</td>";
            echo "<td>".$row['device_id'] ."</td>";
            echo "<td>".$row['temperature']."℃</td>";
            echo "<td>".$row['humidity']."%</td>";
            echo "<td>".$row['illuminance']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "<td><a href=modify.php?id=".$row['id'].">[수정]</a></td>";
            echo "<td><a href=delete.php?id=".$row['id'].">[삭제]</a></td>";
        }
        echo "</table>";
        // echo "<table border=1 width=650 align=center><tr><td>";
        // include 'graph2.php';
        // echo "</td><td>";
        // include 'graph3.php';
        // echo "</td><tr><td colspan='2'";
        // include 'graph.php';
        // echo "</td><tr></table>";
    }else {
        echo "<h1>Data is empty</h1>";
    }
    }else{
        // echo "<p align=center>Device id가 선택되지 않았습니다</p><br>";
    }
    
?>
</section>
<?php include "footer.php"; ?>