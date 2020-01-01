<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//edit user
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $editObject = $database->fetch_id('nguoidung','id_nguoidung',$_GET['id']);
    $resultObject = mysqli_fetch_assoc($editObject);
    if (isset($_POST['submit'])) {
        $nguoidung  = $_POST['nguoidung'];
        $hoten    = $resultObject['hoten'];
        $capdo    = $_POST['capdo'];
        $diachi        = $_POST['diachi'];
        $sdt    = $_POST['sodienthoai'];
        $email = $_POST['email'];
        if (!empty($_POST['matkhau'])) {
            $password = md5($_POST['matkhau']);
        }else {
            $password = $resultObject['password'];
        }
        $sql = "Update nguoidung set nguoidung ='{$nguoidung}',password='{$password}',hoten='{$hoten}',email='{$email}',diachi='{$diachi}',sdt='{$sdt}',id_level={$capdo} where id_nguoidung={$_GET['id']}";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/users/?msg=edit');
        }else {
            header('Location:/admin/ussers/?msg=error');
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
                                    <input type="text" class="form-control" name="nguoidung" value="<?php echo $resultObject['nguoidung'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Họ tên</label>
                                    <input type="text" class="form-control" name="hoten" value="<?php echo $resultObject['hoten'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input type="password" class="form-control" name="matkhau" value="<?php echo $resultObject['password'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Cấp độ</label>
                                    <select name="capdo" id="" class="form-control">
                                        <option value="0" selected >-- Chọn --</option>
                                        <?php
                                        $sqldanhmuc = 'Select * from level';
                                        $danhmuccha = $database->fetch_sql($sqldanhmuc);
                                        foreach ($danhmuccha as $value) {
                                            $active = '';
                                            if ($value['id_level']==$resultObject['id_level']) {
                                                $active = 'selected=""';
                                            }
                                            ?>
                                            <option <?php echo $active?> value="<?php echo $value['id_level'] ?>"><?php echo $value['level']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" class="form-control" name="diachi" value="<?php echo $resultObject['diachi'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="number" class="form-control" name="sodienthoai" value="<?php echo $resultObject['sdt'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $resultObject['email'] ?>">
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