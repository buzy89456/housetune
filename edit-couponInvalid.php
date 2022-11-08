<?php
if (!isset($_GET["id"])) {
    echo "優惠券不存在";
    exit;
}
$id = $_GET["id"];
require_once("../housetunedb-connect.php");
$sql = "SELECT * FROM coupons WHERE id='$id' AND valid=0";
$result = $conn->query($sql);
$couponCount = $result->num_rows;
$row = $result->fetch_assoc();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Edit CouponInvalid</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <?php if ($couponCount == 0) : ?>
            優惠券不存在
        <?php else : ?>
            <div class="py-2">
                <a href="coupons-invalid.php" class="btn btn-info">回優惠券列表</a>
            </div>
            <form action="doUpdateCouponInvalid.php" method="POST">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <input type="hidden" value="<?= $row["id"] ?>" name="id">
                            <td>id</td>
                            <td><?= $row["id"] ?></td>
                        </tr>
                        <tr>
                            <td>優惠券名稱</td>
                            <td><input type="text" class="form-control" name="coupon_name" value="<?= $row["coupon_name"] ?>"></td>
                        </tr>
                        <tr>
                            <td>折扣</td>
                            <td><input type="number" class="form-control" name="discount" value="<?= $row["discount"] ?>"></td>
                        </tr>
                        <tr>
                            <td>最低花費</td>
                            <td><input type="number" class="form-control" name="min_expense" value="<?= $row["min_expense"] ?>"></td>
                        </tr>
                        <tr>
                            <td>開始日期</td>
                            <td><input type="datetime-local" class="form-control" name="start_date" value="<?= $row["start_date"] ?>"></td>
                        </tr>
                        <tr>
                            <td>結束日期</td>
                            <td><input type="datetime-local" class="form-control" name="end_date" value="<?= $row["end_date"] ?>"></td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-info" type="submit">送出</button>
            </form>
        <?php endif ?>
    </div>
</body>

</html>