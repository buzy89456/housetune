<?php
require_once("../housetunedb-connect.php");
if (!isset($_POST["coupon_name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$id = $_POST["id"];
$coupon_name = $_POST["coupon_name"];
$discount = $_POST["discount"];
$min_expense = $_POST["min_expense"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

$sql = "UPDATE coupons SET coupon_name='$coupon_name',discount='$discount',min_expense='$min_expense',start_date='$start_date',end_date='$end_date' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
} else {
    echo "資料更新錯誤: " . $conn->error;
}

header("location: coupons.php");
