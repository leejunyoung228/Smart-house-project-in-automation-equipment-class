<?php 
    include "db.php";
    $query = "delete from tbl_state where id = ".$_GET['id'].";";
    $result = mysqli_query($conn, $query);
?>
<meta http-equiv="refresh" content="0; url=list.php">