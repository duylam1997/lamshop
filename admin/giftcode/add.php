<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//add categories
if (isset($_POST['submit'])) {
    //validate php
    $makhuyenmai    = $_POST['makhuyenmai'];
    $qty            = $_POST['qty'];
    $value    = $_POST['value'];
    $ngaybatdau      = $_POST['ngaybatdau'];
    $ngayketthuc = $_POST['ngayketthuc'];

    $error = [];
    $error['makhuyenmai']    = empty($makhuyenmai) ? "Vui lòng nhập mã khuyến mãi" : null;
    $error['qty']          = empty($qty) ? "Vui lòng nhập số lượng" : null;
    $error['value']        = empty($value) ? "Vui lòng nhập giá trị" : null;
    $error['ngaybatdau']         = empty($ngaybatdau) ? "Vui lòng nhập ngày bắt đầu" : null;
    $error['ngayketthuc']    = empty($ngayketthuc) ? "Vui lòng nhập ngày kết thúc" : null;

    if (empty($error['makhuyenmai']) && empty($error['qty']) && empty($error['value']) && empty($error['ngaybatdau']) && empty($error['ngayketthuc'])) {
        $sql = "INSERT INTO makhuyenmai(maKM,qty,value,ngaybatdau,ngayketthuc) VALUES('{$makhuyenmai}','{$qty}','{$value}','{$ngaybatdau}','{$ngayketthuc}')";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/giftcode/?msg=add');
        }else {
            header('Location:/admin/giftcode/?msg=error');
        }
    }


}
if (isset($_POST['cancel'])) {
    header('Location:/admin/products/');
}

//header
include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php';
?>
    <div class="container-fluid page-body-wrapper">
<?php include_once  $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/sidebar.php' ?>
    <!-- partial -->
    <div class="main-panel">
    <div class="content-wrapper">
    <!-- Page Title Header Starts-->
    <div class="row page-title-header">
        <div class="col-12">
            <div class="page-header">
                <h4 class="page-title">Thêm mã giảm giá</h4>
            </div>
        </div>
    </div>
    <!-- Page Title Header Ends-->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" class="form-control" name="makhuyenmai" placeholder="Nhập mã giảm giá...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['makhuyenmai']) ? $error['makhuyenmai'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá trị</label>
                                    <input type="number" class="form-control" name="value" placeholder="%">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['value']) ? $error['value'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" class="form-control" name="qty" placeholder="Nhập số lượng...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['qty']) ? $error['qty'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày áp dụng</label>
                                    <input type="date" class="form-control" name="ngaybatdau" placeholder="Nhập ngày áp dụng...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['ngaybatdau']) ? $error['ngaybatdau'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hạn sử dụng</label>
                                    <input type="date" class="form-control" name="ngayketthuc" placeholder="Nhập hạn sử dụng...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['ngayketthuc']) ? $error['ngayketthuc'] : '' ?></span>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success mr-2">Thêm</button>
                                <button name="cancel" class="btn btn-pinterest">Quay lại</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php' ?>