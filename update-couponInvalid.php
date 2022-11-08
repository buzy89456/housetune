<?php
if (!isset($_GET["id"])) {
    echo "請循正常管道進入本頁";
    exit;
}
require_once("../housetunedb-connect.php");

$id = $_GET["id"];
$sql = "SELECT * FROM coupons WHERE id='$id' AND valid=0";
$result = $conn->query($sql);
$couponCount = $result->num_rows;
$row = $result->fetch_assoc();

$now = time();

if (strtotime($row["end_date"]) > $now) {
    $sqlInvalid = "UPDATE coupons SET valid=1 WHERE id='$id'";
    if ($conn->query($sqlInvalid) === TRUE) {
        echo "上架完成";
        header("location: coupons.php");
    }
} else {
    echo "上架優惠券錯誤: 時間已失效" . $conn->error;
}
