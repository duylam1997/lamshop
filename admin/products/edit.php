<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $editObject = $database->fetch_id('sanpham','id_sanpham',$_GET['id']);
    $resultObject = mysqli_fetch_assoc($editObject);
    if (isset($_POST['submit'])) {
        $sanpham    = $_POST['sanpham'];
        $hinhanh    = $resultObject['hinhanh'];
        $mota       = $_POST['mota'];
        $chitiet    = $_POST['chitiet'];
        $gia        = $_POST['gia'];
        $soluong    = $_POST['soluong'];
        $id_danhmuc = $_POST['id_danhmuc'];
        if (!empty($_FILES['hinhanh']['tmp_name'])) {
            $hinhanh =  $database->namePic($_FILES['hinhanh']);
            $upload = $database->uploadPic($_FILES['hinhanh'],'file',$hinhanh);
        }
        $sql = "Update sanpham set sanpham ='{$sanpham}',hinhanh='{$hinhanh}',mota='{$mota}',chitiet='{$chitiet}',gia='{$gia}',soluong='{$soluong}',id_danhmuc=$id_danhmuc";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/products/?msg=add');
        }else {
            header('Location:/admin/products/?msg=error');
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
                <h4 class="page-title">Sửa sản phẩm</h4>
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
                                    <input type="text" class="form-control" name="sanpham" value="<?php echo $resultObject['sanpham']?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                    <select name="id_danhmuc" id="" class="form-control">
                                        <option value="0" selected >-- Chọn --</option>
                                        <?php
                                        $sqldanhmuc = 'Select * from danhmuc';
                                        $danhmuccha = $database->fetch_sql($sqldanhmuc);
                                        foreach ($danhmuccha as $value) {
                                            $active = '';
                                            if ($value['id_danhmuc']==$resultObject['id_danhmuc']) {
                                                $active = 'selected=""';
                                            }
                                            ?>
                                            <option <?php echo $active?> value="<?php echo $value['id_danhmuc'] ?>"><?php echo $value['tendanhmuc']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" class="form-control" name="hinhanh" >
                                    <img src="/file/<?php echo $resultObject['hinhanh'] ?>" style="width: 100px;height: 100px" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá</label>
                                    <input type="number" class="form-control" name="gia" value="<?php echo $resultObject['gia'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="number" class="form-control" name="soluong" value="<?php echo $resultObject['soluong'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mô tả</label>
                                    <textarea name="mota" id="" class="form-control" cols="30" rows="5"><?php echo $resultObject['mota'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chi tiết</label>
                                    <textarea name="chitiet" id="ckeditor" class="ckeditor form-control" cols="30" rows="10"><?php echo $resultObject['chitiet'] ?></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-success mr-2">Sửa</button>
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