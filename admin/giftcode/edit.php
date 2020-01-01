<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//edit giftcode
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $editObject = $database->fetch_id('makhuyenmai','id_km',$_GET['id']);
    $resultObject = mysqli_fetch_assoc($editObject);
    if (isset($_POST['submit'])) {
        $makhuyenmai    = $_POST['makhuyenmai'];
        $qty            = $_POST['qty'];
        $value    = $_POST['value'];
        $ngaybatdau      = $_POST['ngaybatdau'];
        $ngayketthuc = $_POST['ngayketthuc'];

        $sql = "Update makhuyenmai set maKM ='{$makhuyenmai}',qty='{$qty}',value='{$value}',ngaybatdau='{$ngaybatdau}',ngayketthuc='{$ngayketthuc}' where id_km={$_GET['id']}";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/giftcode/?msg=edit');
        }else {
            header('Location:/admin/giftcode/?msg=error');
        }
    }
}else {
    header('Location:/admin/products');
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
                                    <input type="text" class="form-control" name="makhuyenmai" value="<?php echo $resultObject['maKM'] ?>">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['makhuyenmai']) ? $error['makhuyenmai'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá trị</label>
                                    <input type="number" class="form-control" name="value" value="<?php echo $resultObject['value'] ?>">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['value']) ? $error['value'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" class="form-control" name="qty" value="<?php echo $resultObject['qty'] ?>">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['qty']) ? $error['qty'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày áp dụng</label>
                                    <input type="text" class="form-control" name="ngaybatdau" value="<?php echo date( "m/d/20y", strtotime($resultObject['ngaybatdau']))  ?>">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['ngaybatdau']) ? $error['ngaybatdau'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hạn sử dụng</label>
                                    <input type="text" class="form-control" name="ngayketthuc" value="<?php echo date( "m/d/20y", strtotime($resultObject['ngayketthuc'])) ?>">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['ngayketthuc']) ? $error['ngayketthuc'] : '' ?></span>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success mr-2">Cập nhập</button>
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