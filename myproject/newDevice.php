<?php
    include "header.php";
?>
<script>
    function check() {
        if (frm.device_id.value=="") {
            alert("디바이스 아이디가 입력되지 않았습니다.");
            frm.device_id.focus();
            return false;
        }
        else if (frm.device_name.value == "") {
            alert("디바이스 이름이 입려되지 않았습니다.");
            frm.device_name.focus();
            return false;
        }
        else if (frm.location.value == "") {
            alert("위치가 입력되지 않았습니다.");
            frm.location.focus();
            return false;
        }
        else {
            frm.submit();
            return true;
        }
    }
</script>
<section>
<form name="frm" action="newDevice_process.php" method="post">
    <table border="1">
        <tr>
            <td>디바이스 아이디</td>
            <td><input name="device_id" type="text"></td>
        </tr>
        <tr>
            <td>디바이스 이름</td>
            <td><input name="device_name" type="text"></td>
        </tr>
        <tr>
            <td>위치</td>
            <td><input name="location" type="text"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" onclick="check()" value="완료">
                <input type="reset" onclick="alert('정보를 지우고 다시 입력합니다.')" value="다시쓰기">
            </td>
        </tr>
    </table>
</form>
<!-- <link rel="stylesheet" href="style.css"> -->
</section>
<?php include "footer.php"; ?>