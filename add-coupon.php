<!doctype html>
<html lang="en">

<head>
    <title>新增優惠券</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a href="coupons.php" class="btn btn-info">優惠券列表</a>
        </div>
        <form action="doCouponInsert.php" method="POST">
            <div class="mb-2">
                <label for="coupon_name">優惠券名稱</label>
                <input type="text" class="form-control" name="coupon_name">
            </div>
            <div class="mb-2">
                <label for="discount">折扣</label>
                <input type="number" class="form-control" name="discount">
            </div>
            <div class="mb-2">
                <label for="min_expense">最低花費</label>
                <input type="number" class="form-control" name="min_expense">
            </div>
            <div class="mb-2">
                <label for="start_date">開始日期</label>
                <input type="datetime-local" class="form-control" name="start_date">
            </div>
            <div class="mb-2">
                <label for="end_date">結束日期</label>
                <input type="datetime-local" class="form-control" name="end_date">
            </div>
            <button class="btn btn-info" type="submit">送出</button>
        </form>
    </div>
</body>

</html>