<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//add categories
if (isset($_POST['submit'])) {
    //validate php
    $tendangnhap    = $_POST['tendangnhap'];
    $hoten      = $_POST['hoten'];
    $matkhau    = $_POST['matkhau'];
    $capdo      = $_POST['capdo'];
    $diachi     = $_POST['diachi'];
    $sodienthoai    = $_POST['sodienthoai'];
    $email         = $_POST['email'];

    $error = [];
    $error['tendangnhap']    = empty($tendangnhap) ? "Vui lòng nhập tên đăng nhập" : null;
    $error['hoten']          = empty($hoten) ? "Vui lòng nhập họ tên" : null;
    $error['matkhau']        = empty($matkhau) ? "Vui lòng nhập mật khẩu" : null;
    $error['capdo']          = $capdo==0 ? "Vui lòng chọn level" : null;
    $error['diachi']         = empty($diachi) ? "Vui lòng nhập địa chỉ" : null;
    $error['sodienthoai']    = empty($sodienthoai) ? "Vui lòng nhập số điện thoại" : null;
    $error['email']          = empty($email) ? "Vui lòng nhập email" : null;
    if (empty($error['tendangnhap']) && empty($error['hoten']) && empty($error['matkhau']) && empty($error['capdo']) && empty($error['diachi']) && empty($error['sodienthoai']) && empty($error['email'])) {
        $matkhau = md5($matkhau);
        $sql = "INSERT INTO nguoidung(nguoidung,password,hoten,email,diachi,sdt,id_level) VALUES('{$tendangnhap}','{$matkhau}','{$hoten}','{$email}','{$diachi}','{$sodienthoai}','{$capdo}')";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/users/?msg=add');
        }else {
            header('Location:/admin/products/?msg=error');
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
                <h4 class="page-title">Thêm thành viên</h4>
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
                                    <label for="exampleInputEmail1">Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="tendangnhap" placeholder="Nhập tên đăng nhập...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['tendangnhap']) ? $error['tendangnhap'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ tên</label>
                                    <input type="text" class="form-control" name="hoten" placeholder="Nhập họ tên...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['hoten']) ? $error['hoten'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="text" class="form-control" name="matkhau" placeholder="Nhập mật khẩu...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['matkhau']) ? $error['matkhau'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cấp độ</label>
                                    <select name="capdo" id="" class="form-control">
                                        <option value="0" selected >-- Chọn --</option>
                                        <?php
                                        $sqldanhmuc = 'Select * from level';
                                        $danhmuccha = $database->fetch_sql($sqldanhmuc);
                                        foreach ($danhmuccha as $value) {
                                            ?>
                                            <option value="<?php echo $value['id_level'] ?>"><?php echo $value['level']?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['capdo']) ? $error['capdo'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi" placeholder="Nhập địa chỉ...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['diachi']) ? $error['diachi'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="number" class="form-control" name="sodienthoai" placeholder="Nhập số điện thoại...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['sodienthoai']) ? $error['sodienthoai'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Nhập email...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['email']) ? $error['email'] : '' ?></span>
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