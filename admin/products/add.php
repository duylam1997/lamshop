<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//add categories
if (isset($_POST['submit'])) {
    //validate php
    $sanpham    = $_POST['sanpham'];
    $hinhanh    = $_FILES['hinhanh'];
    $mota       = $_POST['mota'];
    $chitiet    = $_POST['chitiet'];
    $gia        = $_POST['gia'];
    $soluong    = $_POST['soluong'];
    $id_danhmuc = $_POST['id_danhmuc'];

    $error = [];
    $error['sanpham']    = empty($sanpham) ? "Vui lòng nhập tên sản phẩm" : null;
    $error['hinhanh']    = empty($hinhanh) ? "Vui lòng chọn hình ảnh" : null;
    $error['mota']       = empty($mota) ? "Vui lòng nhập mô tả" : null;
    $error['chitiet']    = empty($chitiet) ? "Vui lòng nhập chi tiết" : null;
    $error['gia']        = empty($gia) ? "Vui lòng nhập giá" : null;
    $error['soluong']    = empty($soluong) ? "Vui lòng nhập số lượng" : null;
    $error['id_danhmuc'] = $id_danhmuc==0 ? "Vui lòng chọn danh muc" : null;
   if (empty($error['sanpham']) && empty($error['hinhanh']) && empty($error['mota']) && empty($error['chitiet']) && empty($error['gia']) && empty($error['soluong']) && empty($error['id_danhmuc'])) {
       $namepic = $database->namePic($hinhanh);
       $sql = "INSERT INTO sanpham(sanpham,hinhanh,mota,chitiet,gia,soluong,id_danhmuc) VALUES('{$sanpham}','{$namepic}','{$mota}','{$chitiet}','{$gia}','{$soluong}','{$id_danhmuc}')";
       $result = $database->fetch_sql($sql);
       if ($result) {
           $upload = $database->uploadPic($hinhanh,'file',$namepic);
           header('Location:/admin/products/?msg=add');
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
                <h4 class="page-title">Thêm sản phẩm</h4>
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
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="sanpham" placeholder="Nhập tên sản phẩm...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['sanpham']) ? $error['sanpham'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                    <select name="id_danhmuc" id="" class="form-control">
                                        <option value="0" selected >-- Chọn --</option>
                                        <?php
                                        $sqldanhmuc = 'Select * from danhmuc';
                                        $danhmuccha = $database->fetch_sql($sqldanhmuc);
                                        foreach ($danhmuccha as $value) {
                                            ?>
                                            <option value="<?php echo $value['id_danhmuc'] ?>"><?php echo $value['tendanhmuc']?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['id_danhmuc']) ? $error['id_danhmuc'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="hinhanh" >
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['hinhanh']) ? $error['hinhanh'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="number" class="form-control" name="gia" placeholder="Nhập giá sản phẩm...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['gia']) ? $error['gia'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" class="form-control" name="soluong" placeholder="Nhập số lượng...">
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['soluong']) ? $error['soluong'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mô tả</label>
                                    <textarea name="mota" id="" class="form-control" cols="30" rows="5"></textarea>
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['mota']) ? $error['mota'] : '' ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chi tiết</label>
                                    <textarea name="chitiet" id="ckeditor" class="ckeditor form-control" cols="30" rows="10"></textarea>
                                    <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['chitiet']) ? $error['chitiet'] : '' ?></span>
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