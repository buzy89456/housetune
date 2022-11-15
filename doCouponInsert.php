<?php
require_once("../housetunedb-connect.php");

if (!isset($_POST["coupon_name"])) {
    echo "請循正常管道進入本頁";
    exit;
}

$coupon_name = $_POST["coupon_name"];
$discount = $_POST["discount"];
$type = $_POST["type"];
$min_expense = $_POST["min_expense"];
$start_date = $_POST["start_date"];
$end_date = $_POST["end_date"];

if (empty($coupon_name)) {
    echo "請輸入優惠券名稱";
    exit;
}
if (empty($discount)) {
    echo "請輸入折扣";
    exit;
}
if (empty($start_date)) {
    echo "請輸入開始日期";
    exit;
}
if (empty($end_date)) {
    echo "請輸入結束日期";
    exit;
}

$sql = "SELECT * FROM coupons WHERE coupon_name='$coupon_name'";
$result = $conn->query($sql);
$couponCount = $result->num_rows;
if ($couponCount > 0) {
    echo "優惠券名稱已存在";
    exit;
}

if (strtotime($start_date) > strtotime($end_date)) {
    echo "時間設定錯誤";
    exit;
}

$now = time();
if (strtotime($start_date) > $now) {
    $sqlInsert = "INSERT INTO coupons (coupon_name,discount,type,min_expense,start_date,end_date,valid) VALUES ('$coupon_name',$discount,'$type',$min_expense,'$start_date','$end_date',0)";
} else {
    $sqlInsert = "INSERT INTO coupons (coupon_name,discount,type,min_expense,start_date,end_date,valid) VALUES ('$coupon_name',$discount,'$type',$min_expense,'$start_date','$end_date',1)";
}

if ($conn->query($sqlInsert) === true) {
    $last_id = $conn->insert_id;
    echo "優惠券新增完成,id: $last_id";
} else {
    echo "優惠券新增錯誤" . $conn->error;
}
$conn->close();
header("location: coupons.php");
