<?php
require_once("../housetunedb-connect.php");
$sql = "SELECT * FROM coupons WHERE valid=1";
$result = $conn->query($sql);
$couponCount = $result->num_rows;
$rows = $result->fetch_all(MYSQLI_ASSOC);

$now = time();

foreach ($rows as $row) {
    $id = $row["id"];
    if (strtotime($row["end_date"]) < $now) {
        $sqlInvalid = "UPDATE coupons SET valid=0 WHERE id='$id'";
        if ($conn->query($sqlInvalid) === TRUE) {
            echo "更新成功<br>";
        } else {
            echo "資料更新錯誤: " . $conn->error;
        }
    }
}
header("location: coupons.php");