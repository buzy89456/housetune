<?php
if (!isset($_GET["id"])) {
    echo "請循正常管道進入本頁";
    exit;
}
require_once("../housetunedb-connect.php");

$id = $_GET["id"];
$sql = "UPDATE coupons SET valid=0 WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "刪除完成";
    header("location: coupons.php");
} else {
    echo "刪除優惠券錯誤: " . $conn->error;
}
