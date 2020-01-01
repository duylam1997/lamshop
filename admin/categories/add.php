<?php
include $_SERVER['DOCUMENT_ROOT'].'/functions/database.php';
$database = new database();

//add categories
if (isset($_POST['submit'])) {
    $tendanhmuc = $_POST['tendanhmuc'];
    $id_dacap = $_POST['id_dacap'];
    $error = [];
    $error['tendanhmuc'] = empty($tendanhmuc) ? "Vui lòng nhập tên danh muc" : null;
    if (empty($error['tendanhmuc'])) {
        $sql = "Insert into danhmuc(tendanhmuc,trangthai,id_dacap) values('{$tendanhmuc}',0,{$id_dacap})";
        $result = $database->fetch_sql($sql);
        if ($result) {
            header('Location:/admin/categories/?msg=add');
        }
    }
}
if (isset($_POST['cancel'])) {
    echo '<script>alert("Bạn muốn hủy hoạt động này??");window.location="/admin/categories/index.php"</script>';
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
                <h4 class="page-title">Thêm danh mục</h4>
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
                        <form class="forms-sample" method="post">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh muc</label>
                                <input type="text" class="form-control" name="tendanhmuc" id="exampleInputEmail1" placeholder="Nhập tên danh mục...">
                                <span class="alert-danger" style="font-size: 14px"><?php echo !empty($error['tendanhmuc']) ? $error['tendanhmuc'] : '' ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục con</label>
                                <select name="id_dacap" id="" class="form-control">
                                    <option value="0" selected >-- Không --</option>
                                    <?php
                                        $sqldanhmuc = 'Select * from danhmuc';
                                        $danhmuccha = $database->fetch_sql($sqldanhmuc);
                                        foreach ($danhmuccha as $value) {
                                    ?>
                                        <option value="<?php echo $value['id_danhmuc'] ?>"><?php echo $value['tendanhmuc']?></option>
                                    <?php } ?>
                                </select>
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