
<?php 
    include "header.php";
    include "db.php";
    date_default_timezone_set('Asia/Seoul');
    $query = "select led_state, door_state from tbl_ld_state order by id desc limit 1";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)){
        $led_state = $row['led_state'];
        $door_state = $row['door_state'];
    }
    function changeled($state) {
        $date = date("Y-m-d H:i:s", time());
        echo "console.log(".$date.")";
        // $iquery1 = "insert into tbl_ld_state(device_id, led_state, door_state, date) values('device1', ".$state.", ".$door_state.");";
        // $r = mysqli_query($conn, $query);
    }
?>
<script>
    function changeled(data) {
        document.frm.led.value = data;
    }
    function changedoor(data) {
        document.frm.door.value = data;
    }
</script>
<section>
<form method="post" action="h_action.php" name="frm">
    <table border="0">
        <tr>
            <th>
                전등
            </th>
            <th>
                문
            </th>
        </tr>
<?php
    echo("<input type=hidden value=".$led_state." name=led>");
    echo("<input type=hidden value=".$door_state." name=door>");
    echo("<tr><td>");
    if ($led_state == 0) {
        echo "<button onclick=changeled(1) id=on_btn></button>";
    }else if($led_state == 1) {
        echo "<button onclick=changeled(0) id=off_btn></button>";
    }
    echo("</td><td>");
    if ($door_state == 0) {
        echo "<button onclick=changedoor(1) id=on_btn></button>";
    }else if ($door_state == 1) {
        echo "<button onclick=changedoor(0) id=off_btn></button>";
    }
    echo("</td></tr>");
?>
    <table>
</form>
</section>
<?php include "footer.php"; ?>
<style>
    button {
        border-radius: 50px;
        width: 40px;
        height: 40px;
    }
    #on_btn{
        background-color: red;
    }
    #off_btn {
        background-color: yellowgreen;
    }
    table{
        width: 200px;
        height: 100px;
        align-items: center;
    }
</style>