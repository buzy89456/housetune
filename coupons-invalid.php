<?php
require_once("../housetunedb-connect.php");

if (isset($_GET["search"]) && $_GET["search"] != "") {
    $search = $_GET["search"];

    $sql = "SELECT * FROM coupons WHERE coupon_name LIKE '%$search%' OR discount LIKE '%$search%' AND valid=0";
    $result = $conn->query($sql);
    $couponsCount = $result->num_rows;
} else if (isset($_GET["min"])) {
    $min = $_GET["min"];
    $max = $_GET["max"];

    if (empty($min)) $min = 0;
    if (empty($max)) $max = 9999999;
    $sql = "SELECT * FROM coupons WHERE discount >= $min AND discount <=$max AND valid=0";
    $result = $conn->query($sql);
    $couponsCount = $result->num_rows;
} else if (isset($_GET["expense_min"])) {
    $expense_min = $_GET["expense_min"];
    $expense_max = $_GET["expense_max"];

    if (empty($expense_min)) $expense_min = 0;
    if (empty($expense_max)) $expense_max = 9999999;
    $sql = "SELECT * FROM coupons WHERE min_expense >= $expense_min AND min_expense <=$expense_max AND valid=0";
    $result = $conn->query($sql);
    $couponsCount = $result->num_rows;
} else if (isset($_GET["date_start"])) {
    $date_start = $_GET["date_start"];
    $date_end = $_GET["date_end"];

    $sql = "SELECT * FROM coupons WHERE start_date >= '$date_start' AND end_date <= '$date_end' AND valid=0";
    $result = $conn->query($sql);
    $couponsCount = $result->num_rows;
} else if (isset($_GET["sort_by"])) {
    $sort_by = $_GET["sort_by"];
    $order_by = $_GET["order_by"];
    $sql = "SELECT * FROM coupons  WHERE valid=0 ORDER BY $sort_by $order_by";
    $result = $conn->query($sql);
    $couponsCount = $result->num_rows;
} else {
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
    $sqlAll = "SELECT * FROM coupons WHERE valid=0";
    $resultAll = $conn->query($sqlAll);
    $couponsCount = $resultAll->num_rows;

    $per_page = 5;
    $page_start = ($page - 1) * $per_page;
    $sql = "SELECT * FROM coupons WHERE valid=0 LIMIT $page_start,$per_page";
    $result = $conn->query($sql);
    $totalPage = ceil($couponsCount / $per_page);
}
$rows = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Coupons-Invalid</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .input {
            display: none;
        }

        .inputShow {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="py-2 row justify-content-center">
            <div class="col-auto"><a href="coupons.php" class="btn btn-info">???????????????</a></div>
        </div>
        <div class="py-2">
            <form action="coupons-invalid.php" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="?????????????????????????????????????????????" value="<?php if (isset($_GET["search"]) && $_GET["search"] != "") echo $search ?>">
                    <button class="btn btn-info" type="submit">??????</button>
                </div>
            </form>
        </div>
        <div class="py-2">
            <div class="row align-items-center g-2">
                <div class="col-auto">
                    <select class="form-select select1" name="select">
                        <option disabled selected value="">?????????????????????</option>
                        <option value="1">??????</option>
                        <option value="2">????????????</option>
                        <option value="3">??????</option>
                    </select>
                </div>
                <div class="col-auto">
                    <div class="inputarea">
                        <form action="coupons-invalid.php" method="GET">
                            <div class="input input1 row g-2">
                                <div class="col-auto">
                                    <input type="number" class="form-control" name="min" value="">
                                </div>
                                <div class="col-auto">~</div>
                                <div class="col-auto">
                                    <input type="number" class="form-control" name="max" value="">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-info" type="submit">??????</button>
                                </div>
                            </div>
                        </form>
                        <form action="coupons-invalid.php" method="GET">
                            <div class="input input2 row g-2">
                                <div class="col-auto">
                                    <input type="number" class="form-control" name="expense_min" value="">
                                </div>
                                <div class="col-auto">~</div>
                                <div class="col-auto">
                                    <input type="number" class="form-control" name="expense_max" value="">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-info" type="submit">??????</button>
                                </div>
                            </div>
                        </form>
                        <form action="coupons-invalid.php" method="GET">
                            <div class="input input3 row g-2">
                                <div class="col-auto">
                                    <input type="datetime-local" class="form-control" name="date_start" value="">
                                </div>
                                <div class="col-auto">~</div>
                                <div class="col-auto">
                                    <input type="datetime-local" class="form-control" name="date_end" value="">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-info" type="submit">??????</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($_GET["search"]) && $_GET["search"] != "") : ?>
            <div class="py-2">
                <a href="coupons-invalid.php" class="btn btn-info">??????????????????</a>
            </div>
            <h3><?= $_GET["search"] ?> ???????????????</h3>
        <?php endif ?>
        <?php if (isset($_GET["sort_by"])) : ?>
            <div class="py-2">
                <a href="coupons-invalid.php" class="btn btn-info">??????????????????</a>
            </div>
        <?php endif ?>
        <?php if (isset($min) || isset($expense_min) || isset($date_start)) : ?>
            <div class="py-2">
                <a href="coupons-invalid.php" class="btn btn-info">??????????????????</a>
            </div>
            <?php if (isset($min)) : ?>
                <h3>??????????????????</h3>
            <?php endif ?>
            <?php if (isset($expense_min)) : ?>
                <h3>????????????????????????</h3>
            <?php endif ?>
            <?php if (isset($date_start)) : ?>
                <h3>??????????????????</h3>
            <?php endif ?>
        <?php endif ?>
        <div class="py-2">
            ??? <?= $couponsCount ?> ????????????
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>???????????????</th>
                    <th>??????</th>
                    <th>??????</th>
                    <th>????????????</th>
                    <th>
                        <div class="row align-items-end">
                            <label for="" class="col-auto">????????????</label>
                            <div class="col-auto">
                                <select class="form-select select2" name="" id="">
                                    <option disabled selected>??????</option>
                                    <option value="startNear">????????????</option>
                                    <option value="startFar">????????????</option>
                                </select>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="row align-items-end">
                            <label for="" class="col-auto">????????????</label>
                            <div class="col-auto">
                                <select class="form-select select3" name="" id="">
                                    <option disabled selected>??????</option>
                                    <option value="endNear">????????????</option>
                                    <option value="endFar">????????????</option>
                                </select>
                            </div>
                        </div>
                    </th>
                    <th>??????</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($couponsCount > 0) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= $row["coupon_name"] ?></td>
                            <td><?= $row["discount"] ?></td>
                            <td><?= $row["type"] ?></td>
                            <td><?= $row["min_expense"] ?></td>
                            <td><?= $row["start_date"] ?></td>
                            <td><?= $row["end_date"] ?></td>
                            <td><?php $now = time();
                                if (strtotime($row["end_date"]) < $now) {
                                    echo "?????????";
                                } else {
                                    echo "????????????";
                                }
                                ?></td>
                            <td>
                                <a href="edit-couponInvalid.php?id=<?= $row["id"] ?>" class="btn btn-info">??????</a>
                                <a href="update-couponInvalid.php?id=<?= $row["id"] ?>" class="btn btn-danger">??????</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
        <?php if (!isset($search) && !isset($min) && !isset($expense_min) && !isset($date_start) && !isset($_GET["sort_by"])) : ?>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($i == $page) echo "active" ?>">
                            <a class="page-link" href="coupons-invalid.php?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>
                </ul>
            </nav>
        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script>
        const options = document.querySelector(".select1");
        const inputs = document.querySelectorAll(".input");
        const selectText = document.querySelector("#selectText")
        const sortStart = document.querySelector(".select2")
        const sortEnd = document.querySelector(".select3")

        options.addEventListener("change", function() {
            hideAllInputs()
            switch (options.value) {
                case ("1"):
                    document.querySelector(".input1").classList.add("inputShow")
                    break
                case ("2"):
                    document.querySelector(".input2").classList.add("inputShow")
                    break
                case ("3"):
                    document.querySelector(".input3").classList.add("inputShow")
                    break
                default:
                    break
            }
        })

        function hideAllInputs() {
            for (input of inputs) {
                input.classList.remove("inputShow")
            }
        }

        sortStart.addEventListener("change", (event) => {
            switch (sortStart.value) {
                case ("startNear"):
                    window.location.assign("coupons-invalid.php?sort_by=start_date&order_by=ASC")
                    break;
                case ("startFar"):
                    window.location.assign("coupons-invalid.php?sort_by=start_date&order_by=DESC")
                    break;
                default:
                    break
            }
        })
        sortEnd.addEventListener("change", (event) => {
            switch (sortEnd.value) {
                case ("endNear"):
                    window.location.assign("coupons-invalid.php?sort_by=end_date&order_by=ASC")
                    break;
                case ("endFar"):
                    window.location.assign("coupons-invalid.php?sort_by=end_date&order_by=DESC")
                    break;
                default:
                    break
            }
        })
    </script>
</body>

</html>